<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use Webpatser\Uuid\Uuid;

class FileController extends Controller
{
    public function index()
    {
        $files = File::all();

        return view('files', compact('files'));
    }

    public function store(Request $request)
    {
        $file = $request->all();
        $file['uuid'] = (string)Uuid::generate();
        $file['user_id'] = auth()->id();

        if ($request->hasFile('filename')) {
            $file['filename'] = $request->filename->getClientOriginalName();
            $request->filename->storeAs('files', $file['filename']);
        }

        File::create($file);
        return redirect('/files');
    }
}
