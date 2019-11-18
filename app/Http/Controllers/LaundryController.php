<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DateTime;

class LaundryController extends Controller
{
    public function index()
    {
        $laundries = DB::table('laundries')
            ->select('id','username as title','start','end')
            ->get();

        $user_laundries = DB::table('laundries')
            ->select('id','username','start','end')
            ->where('username','=','agofekete')
            ->whereRaw('DATE(start) >= DATE(NOW())')
            ->orderByRaw('3')
            ->get();
               
        return view('laundries', compact('laundries','user_laundries'));
    }

    public function insert()
    {
        $username = request('username');
        $start_time = new DateTime(request('start_time'));
        $end_time = new DateTime(request('end_time'));
        $comment = request('comment');
        
        $overlap = DB::table('laundries')
            ->select('id')
            ->where('start', '<', $end_time)
            ->where('end', '>', $start_time)
            ->count();

        if($overlap != 0) {
            return response()->json(['error' => 'Ennek az idősávnak bizonyos részére már foglalt a mosógép.'], 404);
        } else if(!($start_time < $end_time)) { 
            return response()->json(['error' => 'Valami nem stimmel az időpontokkal!'], 404);
        } else {
            DB::table('laundries')->insert([
            'username' => $username, 'start' => $start_time, 'end' => $end_time, 'comment' => $comment
            ]);

            return response()->json(['success' => 'true']);
        }
    }
}
