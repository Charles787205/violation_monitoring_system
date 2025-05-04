<?php

namespace App\Http\Controllers;

use App\Models\OwnerDetail;
use App\Models\Violation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $numberOfOwners = OwnerDetail::count();
        $pendingViolations = Violation::where('status', 'pending')->count();
        $totalPayments = Violation::sum('amount');
        if(auth()->user()->is_admin) {
            $totalPayments = Violation::where('user_id', auth()->user()->id)->sum('amount');
           
            $totalVehicles = Vehicle::where('user_id', auth()->user()->id)->count();
            $pendingViolations = Violation::whereHas('vehicle', function ($query) {
                $query->whereColumn('plate_number', 'owner_details.plate_number');
            })->where('user_id', auth()->user()->id)->count();

        }
        $view = auth()->user()->is_admin ? 'dashboard' : 'client/dashboard';

        return view($view, [
            'numberOfOwners' => $numberOfOwners,
            'activeViolations' => $pendingViolations,
            'totalPayments' => $totalPayments,
            'totalVehicles' => $totalVehicles ?? 0,
            'totalViolations' => Violation::all(),
        ]);
    }
}