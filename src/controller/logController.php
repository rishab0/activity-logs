<?php

namespace rishab\actvity\controller;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use rishab\actvity\ActivityLog;
use Carbon\Carbon;

class logController extends Controller
{
    public function view(Request $request)
    {
        $activity = ActivityLog::find($request->id);
        return view('log::view', compact('activity'));
    }


    public function logs(Request $request)
    {
        $moduleList = ActivityLog::whereNotNull('model')->select('model')->groupBy('model')->get();
        $statusList = ActivityLog::whereNotNull('status')->select('status')->groupBy('status')->get();
        $createdByList = ActivityLog::whereNotNull('created_by')->select('created_by')->groupBy('created_by')->get();

        $module = $request->module;
        $activityS = $request->activityS;
        $created_at = $request->created_at;
        $activity_by = $request->activity_by;
        $pagination = env('LOG_PAGINATION') ?: 20;
        // return $request;
        $activity = ActivityLog::where(function ($query) use ($module, $activityS, $created_at, $activity_by) {
            if ($module) {
                $query->where('model', 'LIKE', "%{$module}%");
            }
            if ($activityS) {
                $query->where('status', 'LIKE', "%{$activityS}%");
            }
            if ($created_at) {
                $query->where('dateTime','=', strtotime($created_at));
            }
            if ($activity_by) {
                $query->where('created_by', 'LIKE', "%{$activity_by}%");
            }
        })->latest()->paginate($pagination);
        return view('log::log', compact('activity', 'moduleList', 'statusList', 'createdByList', 'module', 'activityS', 'created_at','activity_by'));
    }
}
