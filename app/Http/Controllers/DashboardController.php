<?php

namespace App\Http\Controllers;
use App\Models\Designation;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'totalDesignations' => Designation::count(),
            'totalUsers' => User::count(),
            'activeUsers' => User::active()->count(),
            'inactiveUsers' => User::inactive()->count(),
        ];

        return view('dashboard.index', compact('stats'));
    }

}
