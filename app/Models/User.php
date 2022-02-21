<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use App\Mail\NotifySubordinates;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
        'role',
        'image',
        'managers'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];

    /**
     * Finds which manager has the least amount of subordinates, increases his subordinate_count and returns manager id to be assigned
     *
     * 
     */
    public function getManagerWithLeastSubordinates(){
        $manager = DB::table('users')->where('id','<=',5)->orderBy('subordinate_count', 'asc')->first();
        $user = User::find($manager->id);
        $user->subordinate_count +=1;
        $user->save();

        return $manager->id;
    }

    public function getDashboardInfo($userid, $request){
        if($userid<=5){
            $data   = $this->getManagerInfo($userid, $request);
        }
        else{
            $data   = $this->getSubordinateInfo($userid);
        }
        
        return $data;
    }

    public function getManagerInfo($userid, $request){
        $whereClause    = 'JSON_CONTAINS(managers,' . $userid .')';

        if($request->name){
            $whereClause    = $whereClause . " AND name LIKE '%" . $request->name . "%' ";
        }
        if($request->lasname){
            $whereClause    = $whereClause . " AND lastname LIKE '%" . $request->lastname . "%' ";
        }
        if($request->email){
            $whereClause    = $whereClause . " AND email LIKE '%" . $request->email . "%' ";
        }

        $subordinates   = DB::table('users')->whereRaw($whereClause)->paginate(20);
        
        return $subordinates;
    }

    public function getSubordinateInfo($id){
        $data       = User::find($id);
        $managers   = json_decode($data->managers,true);

        $whereClause    = '';

        for ($i = 0; $i < count($managers); $i++) {
            if(count($managers) > ($i + 1)){
                $whereClause   .= ' id = ' . $managers[$i] . ' OR'; 
            }
            else{
                $whereClause   .= ' id = ' . $managers[$i];
            }
        }
        $subordinates   = User::whereRaw($whereClause)->paginate(10);
        
        return $subordinates;
    }

    public function updateUser($request){

        $old_password = auth()->user()->password;

        if( Hash::check(($request->oldpassword),$old_password)){
            $user = User::find(auth()->user()->id);
            $user->name = $request->name;
            $user->lastname = $request->lastname;
            $user->email = $request->email;

            $user->save();
            if($request->newpassword && $request->newpassword != $request->oldpassword){
                $user->password = $request->password;
                $user->save();
            }
           else {
                session()->flash('message', 'new password can not be the old password!');
                return back();
           }
        }
        else {
            session()->flash('message', 'old password doesnt matched ');
            return back();
        }
    }

    public function notifySubordinates( $firstManager, $secondManager, $name){
        $whereClause    = 'JSON_CONTAINS(managers,' . $firstManager .') OR JSON_CONTAINS(managers,' . $secondManager .')';

        $subordinates   = DB::table('users')->whereRaw($whereClause)->get();
        
        foreach($subordinates as $subordinate){
            Mail::to($subordinate->email)->send(new NotifySubordinates( $subordinate->name, $name ));
        }
    }
}
