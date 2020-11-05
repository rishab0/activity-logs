<?php

namespace rishab\actvity;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class ActivityLog extends Eloquent
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'msz', 'model', 'status', 'ip_address', 'timezone', 'url', 'response', 'ip_country', 'ip_city', 'ip_region', 'ip_lat', 'ip_long',
    ];

    public static function add($data)
    {
        // return $data;
        $ip = self::get_client_ip();
        $ipDetails = self::getIpdetails($ip);
        ActivityLog::create([
            'msz' => @$data['msz'],
            'model' => @$data['model'],
            'url' => @$data['url'],
            'status' => $data['status'],
            'response' => @$data['response'],
            'ip_address' => $ip,
            'ip_country' =>   $ipDetails['ip_country'],
            'ip_city' =>   $ipDetails['ip_city'],
            'ip_region' =>   $ipDetails['ip_region'],
            'ip_lat' =>   $ipDetails['ip_lat'],
            'ip_long' =>   $ipDetails['ip_long'],
            'timezone' => date_default_timezone_get(),
        ]);
    }

    static function getIpdetails($ip)
    {
        $key = env('SNOOPI_KEY') ?: '860f6b432c6485c105d5352db55b6214';
        try {
            $json  = file_get_contents('https://api.snoopi.io/' . $ip . '?apikey=' . $key . '');
            $xml = json_decode($json, true);
        } catch (\Exception $ex) {
            $xml = new \stdClass();
        }
        $activity['ip_country'] = @$xml ?   $xml['CountryName'] : '--';
        $activity['ip_city'] = @$xml ?   $xml['City'] : '--';
        $activity['ip_region'] = @$xml ?   $xml['State'] : '--';
        $activity['ip_lat'] = @$xml ?   $xml['Latitude'] : '--';
        $activity['ip_long'] = @$xml ?   $xml['Longitude'] : '--';
        return $activity;
    }

    // Function to get the client IP address
    public static function get_client_ip()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public function getStatus()
    {
        switch ($this->status) {
            case 'add':
                return '<span class="badge badge-success">Insert</span>';
                break;

            case 'insert':
                return '<span class="badge badge-success">Insert</span>';
                break;

            case 'remove':
                return '<span class="badge badge-danger">Deleted</span>';
                break;

            case 'delete':
                return '<span class="badge badge-danger">Deleted</span>';
                break;

            case 'modified':
                return '<span class="badge badge-primary">updated</span>';
                break;

            case 'update':
                return '<span class="badge badge-primary">updated</span>';
                break;
            default:
                return '<span class="badge badge-primary">' . $this->status . '</span>';
                break;
        }
    }
}
