<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $users = ARRAY();
        $users = User::paginate(15);
        return view('dashboard', compact('users'));
    }
}
