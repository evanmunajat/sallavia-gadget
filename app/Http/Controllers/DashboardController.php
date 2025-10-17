<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;

class DashboardController extends Controller
{
    public function index()
    {
        // Total pengunjung (sementara 0 kalau belum ada data)
        $totalVisitors = Visit::count();

        return view('dashboard.dashboard', compact('totalVisitors'));
    }
}
