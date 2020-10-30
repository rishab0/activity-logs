<?php

namespace rishab\actvity\controller;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use rishab\actvity\ActivityLog;

class logController extends Controller
{
    public function view($id)
    {
        $activity = ActivityLog::find($id);
        $ip = @$activity->ip_address;

        try {
            $xml = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=" . $ip);
        } catch (\Exception $ex) {
            $xml = new stdClass();
        }
        $activity['ip_country'] = empty($xml) ?  (string) $xml->geoplugin_countryName : '--';
        $activity['ip_city'] = empty($xml) ?  (string) $xml->geoplugin_city : '--';
        $activity['ip_region'] = empty($xml) ?  (string) $xml->geoplugin_region : '--';
        $activity['ip_lat'] = empty($xml) ?  (string) $xml->geoplugin_latitude : '--';
        $activity['ip_long'] = empty($xml) ?  (string) $xml->geoplugin_longitude : '--';
        return view('log::view', compact('activity'));
    }


    public function logs()
    {
        $activity = ActivityLog::latest()->get();
        return view('log::log', compact('activity'));
    }
}
