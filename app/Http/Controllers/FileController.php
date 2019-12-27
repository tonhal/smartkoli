<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\File;
use Webpatser\Uuid\Uuid;
use DB;

class FileController extends Controller
{
    public function index()
    {
        $files = DB::table('files')
            ->join('users', 'files.user_id', '=', 'users.id')
            ->select('files.id', 'files.uuid', 'files.user_id', 'users.name as username', 'files.filename','files.title','files.extension',
                DB::raw("
                    CASE
                        WHEN lower(files.extension) = 'pdf' THEN '-pdf'
                        WHEN lower(files.extension) IN ('ppt','pptx') THEN '-powerpoint'
                        WHEN lower(files.extension) IN ('doc','docx') THEN '-word'
                        WHEN lower(files.extension) IN ('xls','xlsx') THEN '-excel'
                        WHEN lower(files.extension) IN ('jpg','jpeg','png','gif') THEN '-image'
                        WHEN lower(files.extension) IN ('mp3','wav') THEN '-audio'
                        WHEN lower(files.extension) IN ('avi','mp4','mkv','wmv') THEN '-video'
                        WHEN lower(files.extension) IN ('rar','zip') THEN '-archive'
                        ELSE ''
                    END as faext,
                    CASE
                        WHEN lower(files.extension) = 'pdf' THEN '#c11e08'
                        WHEN lower(files.extension) IN ('ppt','pptx') THEN '#d04525'
                        WHEN lower(files.extension) IN ('doc','docx') THEN '#2b5796'
                        WHEN lower(files.extension) IN ('xls','xlsx') THEN '#1e7045'
                        WHEN lower(files.extension) IN ('jpg','jpeg','png','gif') THEN '#03a4ef'
                        WHEN lower(files.extension) IN ('mp3','wav') THEN '#03a4ef'
                        WHEN lower(files.extension) IN ('avi','mp4','mkv','wmv') THEN '#03a4ef'
                        WHEN lower(files.extension) IN ('rar','zip') THEN '#a21898'
                        ELSE '#828587'
                    END as faextcolor"))
            ->get();

        $user_isadmin = DB::table('users')
            ->where('id', auth()->id())
            ->value('isadmin');

        return view('files', compact('files', 'user_isadmin'));
    }

    public function store(Request $request)
    {
        $file = $request->all();
        $file['uuid'] = (string)Uuid::generate();
        $file['user_id'] = auth()->id();

        if ($request->hasFile('filedata')) {
            $file['filename'] = $request->filedata->getClientOriginalName();
            $file['extension'] = $request->filedata->getClientOriginalExtension();
            $request->filedata->storeAs('files', $file['filename']);
        }

        File::create($file);
        return redirect('/files');
    }

    public function download($uuid)
    {
        $file = File::where('uuid', $uuid)->firstOrFail();
        $pathToFile = storage_path('app/files/' . $file->filename);
        return response()->download($pathToFile);
    }

    public function delete(Request $request)
    {
        $user_isadmin = DB::table('users')
            ->where('id', auth()->id())
            ->value('isadmin');

        if(intval($request->userid) == auth()->id() || $user_isadmin == 1) {

            $deleteFile = File::where('uuid', $request->uuid)->delete();

            unlink(storage_path('app/files/'.$request->filename));

            return response()->json(['success' => 'true']);
        }
        else {
            return response()->json(['error' => 'Nincs jogosultságod a file törléséhez'], 403);
        }
    }
}
