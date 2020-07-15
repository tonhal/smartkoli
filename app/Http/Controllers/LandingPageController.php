<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DateTime;
use App\File;

class LandingPageController extends Controller
{
    public function LandingPage() {

        // EGÉR
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

        // MOSÁS
        $current_laundry = DB::table('laundries')
            ->join('users','users.id','=','laundries.user_id')
            ->select('users.name as name', DB::raw("DATE_FORMAT(start,'%H:%i') as start, DATE_FORMAT(end,'%H:%i') as end"))
            ->where('start', '<', now())
            ->where('end', '>', now())
            ->first();

        if($current_laundry === null) {
            $current_laundry = False;
        }

        // VENDÉGEK
        $today = new DateTime(now());
        $today = $today->format('Y-m-d');

        $current_guestroom = DB::table('guests')
            ->join('users','users.id','=','guests.user_id')
            ->select('users.name as name')
            ->whereRaw("DATE(arrival) = ?", [$today])
            ->where("guests.guestroom", 1)
            ->first();

        if($current_guestroom === null) {
            $current_guestroom = False;
        }

        // FILE
        $file_count = File::count();
        
        return view('pages.landing', compact('days_since_last_mouse', 'current_laundry','current_guestroom','file_count'));
    }

    public function MouseSeen() {

        DB::table('datetimes')
            ->updateOrInsert(
                ['name' => 'mouse'],
                ['datetime' => now()]);

        return redirect('/');
    }
}
