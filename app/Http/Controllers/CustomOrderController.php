<?php

namespace App\Http\Controllers;

use App\Models\CustomRequest;
use Illuminate\Http\Request;

class CustomOrderController extends Controller
{
    public function create()
    {
        return view('custom.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'dimensions' => 'required|string|max:100',
            'color_palette' => 'required|string|max:100',
            'finish' => 'required|string|max:100',
            'description' => 'required|string',
            'budget' => 'nullable|numeric|min:0',
            'reference_image' => 'nullable|image|max:4096', // 4MB max
        ]);

        $customRequest = CustomRequest::create([
            'user_id' => auth()->id() ?? null,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'dimensions' => $validated['dimensions'],
            'color_palette' => $validated['color_palette'],
            'finish' => $validated['finish'],
            'description' => $validated['description'],
            'budget' => $validated['budget'] ?? null,
            'status' => 'received',
        ]);

        if ($request->hasFile('reference_image')) {
            $path = $request->file('reference_image')->store('custom_references', 'public');
            $customRequest->images()->create(['image_path' => $path]);
        }

        return redirect()->route('custom.create')->with('success', '¡Solicitud personalizada enviada con éxito! Nuestro equipo la revisará y te enviará una cotización en menos de 48 horas.');
    }
}
