<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DateTime;

class PageController extends Controller
{

    public function ShoppingPage() {

        return view('pages.shopping');

    }

    /**
     * ADMIN
     */

    public function AdminDashboard() {

        abort_unless(auth()->user()->isadmin == 1, 403);

        return view('pages.admin.dashboard');
    }

    public function AdminSandbox() {

        abort_unless(auth()->user()->isadmin == 1, 403);

        return view('sandbox');
    }
    
}
