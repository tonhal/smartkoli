<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Door;
use App\User;
use DB;

class ProxyController extends Controller
{
    public function index() {

        abort_unless(auth()->user()->isadmin == 1, 403);

        $doors = Door::getAllDoors();

        foreach($doors as $door) {
            $door->auth = array();
        }

        $user_auths = DB::table('users')->join('user_door','users.id','=','user_door.user_id')
            ->select('users.id','users.name','user_door.door_id')
            ->whereNotNull('users.proxy')
            ->get();

        $users_with_proxy = User::whereNotNull('proxy')->get();

        foreach($doors as $door) {
            foreach($user_auths as $user_auth) {
                if($door->id == $user_auth->door_id) {
                    array_push($door->auth, $user_auth->id);
                }
            }
        }

        return view('pages.admin.proxies', compact('doors','users_with_proxy'));
    }

    /*
     * PROXY CONTROLLERS
     */

    public function insertProxy(Request $request) {

        abort_unless(auth()->user()->isadmin == 1, 403);

        /* !!! MISSING WARNING !!!
         * HANDLE THE SITUATION WHERE THIS USER ALREADY HAS A PROXY 
         */

        $user = User::find($request->userid);
        $user->proxy = $request->proxycode;
        $user->save();

        return redirect('/admin/proxies');
    }

    public function editProxy(Request $request, $user_id) {

        $doors = Door::getAllDoors();
        
        foreach($doors as $door) {

            Door::setDoorRule(isset($request->door[$door->id]), $door->id, $user_id);
            
        }

        return redirect('/admin/proxies');   
    }

    public function deleteProxy(Request $request, $user_id) {

        abort_unless(auth()->user()->isadmin == 1, 403);

        $user = User::find($user_id);
        $user->proxy = null;
        $user->save();

        return redirect('/admin/proxies');        
    }

    /*
     * DOOR CONTROLLERS
     */

    public function insertDoor(Request $request) {

        abort_unless(auth()->user()->isadmin == 1, 403);

        $door = Door::create(['name' => $request->door_name]);

        return redirect('/admin/proxies');
    }


    public function deleteDoor(Request $request, $door_id) {

        abort_unless(auth()->user()->isadmin == 1, 403);

        Door::destroy($door_id);

        return redirect('/admin/proxies');
    }
}
