<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LaundryController extends Controller
{
    public function index()
    {
        $laundries = DB::table('laundries')
                        ->select('id','username as title','start','end')
                        ->get();
               
        return view('laundries', compact('laundries'));
    }
}
