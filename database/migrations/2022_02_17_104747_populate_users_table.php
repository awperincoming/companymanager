<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PopulateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('users')->insert([
            ['name' => 'David',     'lastname' => 'Brown',          'email' => 'davidbrown@gmail.com',          'password' => Hash::make('password'), 'image'   => '', 'role' => 'Manager',      'managers' => json_encode('')],
            ['name' => 'Olive',     'lastname' => 'Yew',            'email' => 'oliveyew@gmail.com',            'password' => Hash::make('password'), 'image'   => '', 'role' => 'Manager',      'managers' => json_encode('')],
            ['name' => 'Aida',      'lastname' => 'Bugg',           'email' => 'aidabugg@gmail.com',            'password' => Hash::make('password'), 'image'   => '', 'role' => 'Manager',      'managers' => json_encode('')],
            ['name' => 'Maureen',   'lastname' => 'Biologist',      'email' => 'maureenbiologist@gmail.com',    'password' => Hash::make('password'), 'image'   => '', 'role' => 'Manager',      'managers' => json_encode('')],
            ['name' => 'Maureen',   'lastname' => 'Biologist',      'email' => 'maureenbiologist@gmail.com',    'password' => Hash::make('password'), 'image'   => '', 'role' => 'Manager',      'managers' => json_encode('')],
        ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
