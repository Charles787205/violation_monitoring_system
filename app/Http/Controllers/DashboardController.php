<?php

namespace App\Http\Controllers;

use App\Models\OwnerDetail;
use App\Models\Violation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $numberOfOwners = OwnerDetail::count();
        $pendingViolations = Violation::where('status', 'pending')->count();
        $totalPayments = Violation::sum('amount');

        return view('dashboard', [
            'numberOfOwners' => $numberOfOwners,
            'pendingViolations' => $pendingViolations,
            'totalPayments' => $totalPayments,
        ]);
    }
}