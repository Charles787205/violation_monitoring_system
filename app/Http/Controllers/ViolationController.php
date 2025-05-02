<?php

namespace App\Http\Controllers;

use App\Models\Violation;
use Illuminate\Http\Request;

class ViolationController extends Controller
{
    public function index()
    {
        $violations = Violation::paginate(10); // Paginate violations with 10 per page
        return view('violations.index', compact('violations'));
    }

    public function create()
    {
        return view('violations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'license_plate' => 'required|string',
            'violation_type' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,paid',
        ]);

        Violation::create($validated);

        return redirect()->route('violations.index')->with('success', 'Violation created successfully.');
    }

    public function edit(Violation $violation)
    {
        return view('violations.edit', compact('violation'));
    }

    public function update(Request $request, Violation $violation)
    {
        $validated = $request->validate([
            'license_plate' => 'required|string',
            'violation_type' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,paid',
        ]);

        $violation->update($validated);

        return redirect()->route('violations.index')->with('success', 'Violation updated successfully.');
    }

    public function destroy(Violation $violation)
    {
        $violation->delete();

        return redirect()->route('violations.index')->with('success', 'Violation deleted successfully.');
    }

    public function paid()
    {
        $violations = Violation::where('status', 'paid')->paginate(10);
        return view('violations.paid', compact('violations'));
    }

    public function pending()
    {
        $violations = Violation::where('status', 'pending')->paginate(10);
        return view('violations.pending', compact('violations'));
    }

    public function show(Violation $violation)
    {
        return view('violations.show', compact('violation'));
    }

    public function pay(Violation $violation)
    {
        if ($violation->status !== 'pending') {
            return redirect()->route('violations.index')->with('error', 'Only pending violations can be paid.');
        }

        $violation->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        return redirect()->route('violations.index')->with('success', 'Violation marked as paid successfully.');
    }
}