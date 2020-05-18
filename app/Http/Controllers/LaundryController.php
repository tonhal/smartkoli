<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DateTime;
use Validator;
use Config;

class LaundryController extends Controller
{
    public function index()
    {
        $laundries = DB::table('laundries')
            ->join('users', 'laundries.user_id', '=', 'users.id')
            ->select('laundries.id','users.name as title','laundries.start','laundries.end')
            ->get();

        $user_laundries = DB::table('laundries')
            ->select('id','user_id', DB::raw("DATE(start) as date,  
            CASE
                WHEN DATE_FORMAT(start,'%a') = 'Mon' THEN 'hétfő'
                WHEN DATE_FORMAT(start,'%a') = 'Tue' THEN 'kedd'
                WHEN DATE_FORMAT(start,'%a') = 'Wed' THEN 'szerda'
                WHEN DATE_FORMAT(start,'%a') = 'Thu' THEN 'csütörtök'
                WHEN DATE_FORMAT(start,'%a') = 'Fri' THEN 'péntek'
                WHEN DATE_FORMAT(start,'%a') = 'Sat' THEN 'szombat'
                WHEN DATE_FORMAT(start,'%a') = 'Sun' THEN 'vasárnap'
            END as day,
            DATE_FORMAT(start,'%H:%i') as start, DATE_FORMAT(end,'%H:%i') as end"))
            ->where('user_id','=', auth()->id())
            ->whereRaw('DATE(start) >= DATE(NOW())')
            ->orderByRaw('3')
            ->get();
               
        return view('pages.laundries', compact('laundries','user_laundries'));
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_time' => 'required|date_format:Y-m-d H:i:s',
            'end_time' => 'required|date_format:Y-m-d H:i:s'
        ],
        [
            'start_time.required' => 'Meg kell adnod a kezdőidőpontot.',
            'start_time.date_format' => 'Valami nem stimmel az időpont (kezdés) formátumával.',
            'end_time.required' => 'Meg kell adnod a mosás végét.',
            'end_time.date_format' => 'Valami nem stimmel az időpont (vége) formátumával.',
        ]);

        if($validator->passes()) {
            
            $start_time = new DateTime($request->start_time);
            $end_time = new DateTime($request->end_time);
        
            $overlap = DB::table('laundries')
                ->select('id')
                ->where('start', '<', $end_time)
                ->where('end', '>', $start_time)
                ->exists();

            if($overlap) {

                return response()->json(['error' => 'Ennek az idősávnak bizonyos részére már foglalt a mosógép.'], 422);

            } else if(!($start_time < $end_time)) { 

                return response()->json(['error' => 'Valami nem stimmel az időpontokkal!'], 422);

            } else {

                DB::table('laundries')->insert([
                    'user_id' => auth()->id(), 
                    'start' => $start_time, 
                    'end' => $end_time, 
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                return response()->json(['success' => 'true']);
            }
        } else {
            return response()->json(['error' => $validator->errors()->all()], 400);
        }       
    }

    public function delete(Request $request, $id) {

        DB::table('laundries')
            ->where('id', '=', $id)
            ->delete();

        return response()->json(['success' => 'true']);
    }
}
