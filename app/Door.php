<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Door extends Model
{
    protected $fillable = ['id', 'name'];

    public static function getAllDoors() {

        return DB::table('doors')->select('id','name')->get()->toArray();

    }

    public static function setDoorRule($new_rule, $door_id, $user_id) {

        $old_rule = DB::table('user_door')->where('user_id', $user_id)->where('door_id', $door_id)->first();

        //dd([$door_id, $old_rule, $new_rule]);

        if($new_rule) {

            if(!$old_rule) {
                DB::table('user_door')->insert([
                    'user_id' => $user_id, 
                    'door_id' => $door_id, 
                    'created_at' => now(), 
                    'updated_at' => now(),
                ]);
            }

        } else {

            if($old_rule) {
                DB::table('user_door')->where('user_id', $user_id)->where('door_id', $door_id)->delete();
            }

        }

        return True;

    }
}
