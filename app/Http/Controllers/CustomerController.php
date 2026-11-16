<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function profile()
    {
        $user = auth()->user();
        return view('customer.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update($validated);

        return back()->with('success', 'Perfil actualizado con éxito.');
    }

    public function orders()
    {
        $orders = auth()->user()->orders()->with('items')->latest()->paginate(10);
        return view('customer.orders', compact('orders'));
    }

    public function customRequests()
    {
        $requests = \App\Models\CustomRequest::where('user_id', auth()->id())->latest()->paginate(10);
        return view('customer.custom_requests', compact('requests'));
    }

    public function addresses()
    {
        $addresses = auth()->user()->addresses;
        return view('customer.addresses', compact('addresses'));
    }

    public function storeAddress(Request $request)
    {
        $validated = $request->validate([
            'line1' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'phone' => 'required|string|max:20',
        ]);

        auth()->user()->addresses()->create($validated);

        return back()->with('success', 'Dirección añadida con éxito.');
    }
}
