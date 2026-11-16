<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Por favor inicia sesión para completar tu compra.');
        }

        $cart = Cart::where('user_id', auth()->id())->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío.');
        }

        $addresses = auth()->user()->addresses;

        return view('checkout.index', compact('cart', 'addresses'));
    }

    public function process(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'line1' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'phone' => 'required|string|max:20',
            'card_name' => 'required|string|max:255',
            'card_number' => 'required|string|size:19', // e.g. 4532 •••• •••• 8888
        ]);

        $cart = Cart::where('user_id', auth()->id())->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío.');
        }

        // Database transaction for atomic inventory check & order creation
        try {
            $order = DB::transaction(function () use ($cart, $validated) {
                $subtotal = 0;
                foreach ($cart->items as $item) {
                    if ($item->product->status === 'sold' || $item->product->stock <= 0) {
                        throw new \Exception("La pieza '{$item->product->name}' ya no está disponible.");
                    }
                    $subtotal += $item->price_at_add * $item->quantity;
                }

                $shippingCost = $subtotal > 300 ? 0 : 25.00; // Free shipping > 300
                $total = $subtotal + $shippingCost;

                $order = Order::create([
                    'user_id' => auth()->id(),
                    'status' => 'paid', // Demo simulated immediate payment approval
                    'subtotal' => $subtotal,
                    'shipping_cost' => $shippingCost,
                    'total' => $total,
                    'delivery_address' => [
                        'line1' => $validated['line1'],
                        'city' => $validated['city'],
                        'postal_code' => $validated['postal_code'],
                        'phone' => $validated['phone'],
                    ],
                    'ip_address' => request()->ip(),
                ]);

                foreach ($cart->items as $item) {
                    $order->items()->create([
                        'product_id' => $item->product_id,
                        'product_name_snapshot' => $item->product->name,
                        'quantity' => $item->quantity,
                        'price_snapshot' => $item->price_at_add,
                    ]);

                    // If unique piece, mark as sold atomically
                    if ($item->product->type === 'unique') {
                        $item->product->update([
                            'status' => 'sold',
                            'stock' => 0,
                        ]);
                    } else {
                        $item->product->decrement('stock', $item->quantity);
                        if ($item->product->stock <= 0) {
                            $item->product->update(['status' => 'sold']);
                        }
                    }
                }

                // Create payment record
                Payment::create([
                    'order_id' => $order->id,
                    'gateway' => 'demo_gateway',
                    'status' => 'approved',
                    'reference' => 'DEMO-TX-' . strtoupper(uniqid()),
                    'details' => json_encode(['card_holder' => $validated['card_name'], 'last4' => substr(str_replace(' ', '', $validated['card_number']), -4)]),
                ]);

                // Clear cart
                $cart->items()->delete();
                $cart->delete();

                return $order;
            });

            return redirect()->route('checkout.success', $order)->with('success', '¡Compra realizada con éxito! Gracias por confiar en NachoResina.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al procesar la compra: ' . $e->getMessage());
        }
    }

    public function success(Order $order)
    {
        if ($order->user_id !== auth()->id() && !auth()->user()->is_admin) {
            abort(403);
        }
        $order->load('items', 'payment');
        return view('checkout.success', compact('order'));
    }
}
