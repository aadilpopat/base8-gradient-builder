<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gradient;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class GradientController extends Controller
{

    use AuthorizesRequests;

    public function index()
    {
        $gradients = auth()->user()->gradients;
        return view('dashboard', compact('gradients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gradients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:linear,radial',
            'angle' => 'required|integer|min:0|max:360',
            'color_1' => 'required|string',
            'color_2' => 'required|string',
        ]);

        $validated['user_id'] = auth()->id();

        Gradient::create($validated);

        return redirect()->route('gradients.index')->with('success', 'Gradient created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gradient $gradient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gradient $gradient)
    {
        return view('gradients.edit', compact('gradient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gradient $gradient)
    {
        if ($gradient->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:linear,radial',
            'angle' => 'required|integer|min:0|max:360',
            'color_1' => 'required|string',
            'color_2' => 'required|string',
        ]);

        $gradient->update($validated);

        return redirect()->route('gradients.index')->with('success', 'Gradient updated!');
    }

    public function destroy(Gradient $gradient)
    {
        $gradient->delete();
        return redirect()->route('gradients.index')->with('success', 'Gradient deleted!');
    }
}
