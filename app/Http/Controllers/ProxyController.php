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

        $doors = DB::table('doors')->select('id','name')->get()->toArray();

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

        DB::table('users')
            ->where('id', $request->userid)
            ->update(['proxy' => $request->proxycode]);

        return redirect('/admin/proxies');
    }

    /*
     * DOOR CONTROLLERS
     */

    public function deleteDoor(Request $request, $id) {

        abort_unless(auth()->user()->isadmin == 1, 403);

        DB::table('doors')
            ->where('id', $id)
            ->delete();

        return redirect('/admin/proxies');
    }
}
