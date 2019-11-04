<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LaundryController extends Controller
{
    public function index()
    {
        $laundries = DB::table('laundries')
                        ->select('username','from','to','comment')
                        ->get();

        return view('laundries', compact('laundries'));
    }
}
