<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'          => 'max:255',
            'lastname'      => 'max:255',
            'email'         => 'email|max:255',
        ]);

        $user   = new User();
        $user->updateUser($request);

        return redirect()->route('profile');
    }
    
    public function upload(Request $request){
        if($request->image){
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $filename);

            $user = User::find(auth()->user()->id);
            $user->image = $filename;
            $user->save();
        }

        return redirect('/profile');
    }
}
