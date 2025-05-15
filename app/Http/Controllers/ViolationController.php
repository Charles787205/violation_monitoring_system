<?php

namespace App\Http\Controllers;

use App\Models\Violation;
use Illuminate\Http\Request;

class ViolationController extends Controller
{
    public function index(Request $request)
    {
        $query = Violation::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('license_plate', 'like', "%{$search}%")
                  ->orWhere('violation_type', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Date range filter
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->input('date_from'));
        }
        
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->input('date_to'));
        }

        // Get the paginated result
        $violations = $query->paginate(10);
        
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

    public function paid(Request $request)
    {
        $query = Violation::where('status', 'paid');
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('license_plate', 'like', "%{$search}%")
                  ->orWhere('violation_type', 'like', "%{$search}%");
            });
        }
        
        // Date range filter
        if ($request->filled('date_from')) {
            $query->whereDate('paid_at', '>=', $request->input('date_from'));
        }
        
        if ($request->filled('date_to')) {
            $query->whereDate('paid_at', '<=', $request->input('date_to'));
        }
        
        $violations = $query->paginate(10);
        
        return view('violations.paid', compact('violations'));
    }

    public function pending(Request $request)
    {
        $query = Violation::where('status', 'pending');
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('license_plate', 'like', "%{$search}%")
                  ->orWhere('violation_type', 'like', "%{$search}%");
            });
        }
        
        // Date range filter
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->input('date_from'));
        }
        
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->input('date_to'));
        }
        
        $violations = $query->paginate(10);
        
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

    /**
     * Settle a violation with payment receipt
     */
    public function settle(Request $request, Violation $violation)
    {
        if ($violation->status !== 'pending') {
            return back()->with('error', 'Only pending violations can be settled.');
        }

        $request->validate([
            'payment_receipt' => 'required|image|max:2048', // Max 2MB
        ]);

        if ($request->hasFile('payment_receipt')) {
            // Store the uploaded receipt image
            $path = $request->file('payment_receipt')->store('receipts', 'public');
            
            // Update the violation status and store the receipt path
            $violation->markAsPaid($path);
            
            return back()->with('success', 'Your payment has been recorded and is pending verification.');
        }

        return back()->with('error', 'Payment receipt is required.');
    }
}