<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\CustomRequest;
use App\Models\ContactMessage;
use App\Models\Review;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'products_count' => Product::count(),
            'orders_count' => Order::count(),
            'revenue' => Order::where('status', 'paid')->sum('total'),
            'custom_requests_count' => CustomRequest::where('status', 'received')->count(),
        ];
        $recentOrders = Order::with('user')->latest()->take(5)->get();
        $recentRequests = CustomRequest::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'recentRequests'));
    }

    public function products()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function createProduct()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'dimensions' => 'required|string|max:100',
            'materials' => 'nullable|string|max:255',
            'type' => 'required|in:unique,limited_series,made_to_order',
            'making_time' => 'nullable|string|max:100',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:available,sold,made_to_order',
            'featured' => 'boolean',
            'image' => 'nullable|url|max:500',
            'care_instructions' => 'nullable|string',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
        $validated['featured'] = $request->boolean('featured');

        Product::create($validated);

        return redirect()->route('admin.products')->with('success', 'Producto creado con éxito.');
    }

    public function categories()
    {
        $categories = Category::withCount('products')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
            'image' => 'nullable|url',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
        Category::create($validated);

        return back()->with('success', 'Categoría creada con éxito.');
    }

    public function orders()
    {
        $orders = Order::with('user', 'items')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function customRequests()
    {
        $requests = CustomRequest::latest()->paginate(10);
        return view('admin.custom_requests.index', compact('requests'));
    }

    public function updateCustomRequest(Request $request, CustomRequest $customRequest)
    {
        $validated = $request->validate([
            'status' => 'required|string',
            'quote_price' => 'nullable|numeric|min:0',
            'quote_making_time' => 'nullable|string',
            'admin_notes' => 'nullable|string',
        ]);

        $customRequest->update($validated);

        return back()->with('success', 'Solicitud personalizada actualizada con éxito.');
    }

    public function messages()
    {
        $messages = ContactMessage::latest()->paginate(10);
        return view('admin.messages.index', compact('messages'));
    }

    public function reviews()
    {
        $reviews = Review::with('user', 'product')->latest()->paginate(10);
        return view('admin.reviews.index', compact('reviews'));
    }
}
