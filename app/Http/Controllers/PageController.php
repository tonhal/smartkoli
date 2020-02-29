<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function AdminAnnouncements() {

        abort_unless(auth()->user()->isadmin == 1, 403);

        return view('announcements');
    }
}
