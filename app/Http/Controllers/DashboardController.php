<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user   = new User();

        $users   = $user->getDashboardInfo(auth()->user()->id, $request);

        return view('dashboard', [
            'users'  => $users
        ]);
    }
}
