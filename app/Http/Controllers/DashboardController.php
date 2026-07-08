<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function index(): View
    {
        $users = \App\Models\User::all();
        return view('dashboard', compact('users'));
    }
}
