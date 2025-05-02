<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Violation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function myVehicles()
    {
        $vehicles = Vehicle::where('user_id', Auth::id())->get();
        return view('client.my_vehicles', compact('vehicles'));
    }

    public function myViolations()
    {
        $violations = Violation::whereIn('license_plate', function ($query) {
            $query->select('license_plate')
                ->from('vehicles')
                ->where('user_id', Auth::id());
        })->get();

        return view('client.my_violations', compact('violations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'license_plate' => 'required|string|unique:vehicles',
            'make' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
        ]);

        $validated['user_id'] = Auth::id();

        Vehicle::create($validated);

        return redirect()->route('client.my_vehicles')->with('success', 'Vehicle added successfully.');
    }

    public function createVehicle()
    {
        return view('client.create_vehicle');
    }
}