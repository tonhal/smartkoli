<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    public function delete() 
    {
        DB::table('laundries')
            ->where('user_id', auth()->id())
            ->delete();

        DB::table('guests')
            ->where('user_id', auth()->id())
            ->delete();

        DB::table('files')
            ->where('user_id', auth()->id())
            ->delete();
        
        DB::table('users')
            ->where('id', auth()->id())
            ->delete();

        return view('auth.login');
    }
}
