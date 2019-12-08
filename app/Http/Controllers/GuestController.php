<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DateTime;

class GuestController extends Controller
{
    public function index()
    {
        $guests = DB::table('guests')
            ->join('users', 'guests.user_id', '=', 'users.id')
            ->select(DB::raw("guests.id,
                CASE
                    WHEN guests.guestroom = 1 THEN 'Vendeg'
                    WHEN guests.guestroom = 0 THEN 'Sajat'
                END as title,
                users.name as description,
                guests.arrival as start,
                DATE_ADD(guests.arrival, INTERVAL 1 HOUR) as end
                "))
            ->get();

        return view('guests', compact('guests'));
    }
    
    public function insert(Request $request)
    {
        $overlap = DB::table('guests')
            ->select('id')
            ->whereBetween('arrival', [$request->arrival, DB::raw("DATE_ADD('$request->arrival', INTERVAL '$request->nights-1' DAY)")])
            ->where('guestroom', '=', 1)
            ->exists();

        if($overlap) {
            return response()->json(['error' => 'Valamelyik kijelölt napra már foglal a vendégszoba'], 404);
        } else {

            for($day = 0; $day < $request->nights; $day++) {
                DB::table('guests')
                    ->insert(['user_id' => auth()->id(), 'arrival' => DB::raw("DATE_ADD('$request->arrival', INTERVAL '$day' DAY)"), 'capita' => $request->capita, 'guestroom' => $request->guestroom, 'comment' => $request->comment]);
            }

            return response()->json(['success' => 'true']);
        }
    }
}
