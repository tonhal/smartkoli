<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class GuestController extends Controller
{
    public function index()
    {
        $guests = DB::table('guests')
            ->join('users', 'guests.user_id', '=', 'users.id')
            ->select(DB::raw("guests.id,
                CASE
                    WHEN guests.guestroom = 1 THEN 'VSZ'
                    WHEN guests.guestroom = 0 THEN 'OWN'
                END as title,
                users.name as description,
                guests.time as start,
                DATE_ADD(guests.time, INTERVAL 1 HOUR) as end
                "))
            ->get();

        return view('guests', compact('guests'));
    }
    
}
