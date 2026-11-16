<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Review;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with('category')->where('featured', true)->take(4)->get();
        $categories = Category::take(4)->get();
        $reviews = Review::with('user', 'product')->where('is_approved', true)->take(3)->get();

        return view('home', compact('featuredProducts', 'categories', 'reviews'));
    }

    public function process()
    {
        return view('pages.process');
    }

    public function care()
    {
        return view('pages.care');
    }

    public function faq()
    {
        $faqs = \App\Models\Faq::orderBy('sort_order')->get();
        return view('pages.faq', compact('faqs'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function storeContact(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        \App\Models\ContactMessage::create($validated);

        return back()->with('success', '¡Mensaje enviado con éxito! Nos pondremos en contacto contigo muy pronto.');
    }

    public function terms()
    {
        return view('pages.terms');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }
}
