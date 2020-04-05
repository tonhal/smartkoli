<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DateTime;

class PageController extends Controller
{
    public function AdminDashboard() {

        abort_unless(auth()->user()->isadmin == 1, 403);

        return view('pages.admin.dashboard');
    }

    public function AdminSandbox() {

        abort_unless(auth()->user()->isadmin == 1, 403);

        return view('sandbox');
    }

    public function LandingPage() {

        $get_mouse_datetime = DB::table('datetimes')
            ->where('name','mouse')
            ->pluck('datetime');
        
        if(count($get_mouse_datetime) == 0) {
            $days_since_last_mouse = "?";
        } else {
            $last_mouse = new DateTime($get_mouse_datetime[0]);
            $now = now();

            $days_since_last_mouse = date_diff($now, $last_mouse)->days;
        }

        return view('pages.landing', compact('days_since_last_mouse'));
    }

    public function MouseSeen() {

        DB::table('datetimes')
            ->updateOrInsert(
                ['name' => 'mouse'],
                ['datetime' => now()]);

        return redirect('/');
    }
    
}
