<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private function getCart()
    {
        if (auth()->check()) {
            return Cart::firstOrCreate(['user_id' => auth()->id()]);
        }

        $sessionId = session()->getId();
        return Cart::firstOrCreate(['session_id' => $sessionId]);
    }

    public function index()
    {
        $cart = $this->getCart();
        $cart->load('items.product.category');
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, Product $product)
    {
        if ($product->status === 'sold' || $product->stock <= 0) {
            return back()->with('error', 'Lo sentimos, esta pieza única ya ha sido vendida.');
        }

        $cart = $this->getCart();

        $cartItem = $cart->items()->where('product_id', $product->id)->first();

        if ($cartItem) {
            if ($product->type === 'unique') {
                return back()->with('error', 'Esta es una pieza única y ya está en tu carrito (máx 1 unidad).');
            }
            $cartItem->increment('quantity');
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => 1,
                'price_at_add' => $product->price,
            ]);
        }

        return redirect()->route('cart.index')->with('success', '¡Producto añadido al carrito con éxito!');
    }

    public function update(Request $request, CartItem $item)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        if ($item->product->type === 'unique' && $request->quantity > 1) {
            return back()->with('error', 'Las piezas únicas solo permiten 1 unidad.');
        }

        $item->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Cantidad actualizada.');
    }

    public function remove(CartItem $item)
    {
        $item->delete();
        return back()->with('success', 'Producto eliminado del carrito.');
    }
}
