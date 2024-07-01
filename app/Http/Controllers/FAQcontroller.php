<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use Illuminate\Http\Request;

class FAQcontroller extends Controller
{
    // Display a listing of the resource for admin
    public function index()
    {
        $FAQ = FAQ::all();
        return view('FAQ.index', compact('FAQ'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('FAQ.create');
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        FAQ::create($request->all());

        return redirect()->route('FAQ.index')
            ->with('success', 'FAQ created successfully.');
    }

    // Display the specified resource
    public function show(FAQ $FAQ)
    {
        return view('FAQ.show', compact('FAQ'));
    }

    // Show the form for editing the specified resource
    public function edit(FAQ $FAQ)
    {
        return view('FAQ.edit', compact('FAQ'));
    }

    // Update the specified resource in storage
    public function update(Request $request, FAQ $FAQ)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        $FAQ->update($request->all());

        return redirect()->route('FAQ.index')
            ->with('success', 'FAQ updated successfully.');
    }

    // Remove the specified resource from storage
    public function destroy(FAQ $FAQ)
    {
        $FAQ->delete();

        return redirect()->route('FAQ.index')
            ->with('success', 'FAQ deleted successfully.');
    }

    // Display FAQs to users
    public function publicIndex()
    {
        $FAQ = FAQ::all();
        return view('FAQ.public_index', compact('FAQ'));
    }
}

