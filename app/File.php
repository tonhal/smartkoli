<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['uuid', 'user_id', 'title', 'filename'];
}
