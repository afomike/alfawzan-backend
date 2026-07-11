<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        $payments = $user->payments()->latest()->take(10)->get();
        $receipts = $user->receipts()->latest()->take(5)->get();

        return view('user.dashboard', compact('payments', 'receipts'));
    }
}

