<?php

namespace App\Http\Controllers;

use App\Models\OwnerDetail;
use App\Models\Violation;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Initialize variables
        $numberOfOwners = 0;
        $pendingViolations = 0;
        $totalPayments = 0;
        $totalVehicles = 0;
        
        if(auth()->user()->role == 'admin') {
            // Admin sees global statistics
            $numberOfOwners = OwnerDetail::count();
            $pendingViolations = Violation::where('status', 'pending')->count();
            $totalPayments = Violation::sum('amount');
            $totalVehicles = Vehicle::count();
            $totalViolations = Violation::all();
        } else {
            // Non-admin users see only their own data
            $numberOfOwners = OwnerDetail::where('user_id', auth()->user()->id)->count();
            $totalVehicles = Vehicle::where('user_id', auth()->user()->id)->count();
            
            // Get violations for the user's vehicles
            $pendingViolations = Violation::whereHas('vehicle', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->where('status', 'pending')->count();
            
            $totalPayments = Violation::whereHas('vehicle', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->sum('amount');
            
            $totalViolations = Violation::whereHas('vehicle', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->get();
        }
        
        $view = auth()->user()->is_admin ? 'dashboard' : 'client/dashboard';

        return view($view, [
            'numberOfOwners' => $numberOfOwners,
            'activeViolations' => $pendingViolations,
            'totalPayments' => $totalPayments,
            'totalVehicles' => $totalVehicles,
            'totalViolations' => $totalViolations,
        ]);
    }
}