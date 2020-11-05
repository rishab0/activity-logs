<?php

namespace rishab\actvity\controller;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use rishab\actvity\ActivityLog;

class logController extends Controller
{
    public function view(Request $request)
    {
        $activity = ActivityLog::find($request->id);
        return view('log::view', compact('activity'));
    }


    public function logs()
    {
        $activity = ActivityLog::latest()->paginate(05);
        return view('log::log', compact('activity'));
    }
}
