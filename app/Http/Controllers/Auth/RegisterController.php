<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed',
        ]);

        $user   = new User();
        
        $firstManager = $user->getManagerWithLeastSubordinates();
        $secondManager = $user->getManagerWithLeastSubordinates();

        // $user->notifySubordinates($firstManager,$secondManager, $request->name);

        User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'Subordinate',
            'image' => '',
            'managers' => json_encode([$firstManager,$secondManager]),
        ]);

        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('dashboard');
    }
}