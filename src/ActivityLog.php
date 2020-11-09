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
        'msz', 'model', 'status', 'ip_address', 'timezone', 'url', 'response', 'ip_country', 'ip_city', 'ip_region', 'ip_lat', 'ip_long','created_by','dateTime'
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
            'created_by' => @$data['created_by'], 
            'dateTime' => strtotime(date('d-M-Y')),
        ]);
    }

    static function getIpdetails($ip)
    {
        $key = env('SNOOPI_KEY');
        try {
            $json  = file_get_contents('https://api.snoopi.io/' . $ip . '?apikey=' . $key . '');
            $xml = json_decode($json, true);
        } catch (\Exception $ex) {
            $xml = new \stdClass();
        }
        $activity['ip_country'] = empty($xml) ?   $xml['CountryName'] : null;
        $activity['ip_city'] = empty($xml) ?   $xml['City'] : null;
        $activity['ip_region'] = empty($xml) ?   $xml['State'] : null;
        $activity['ip_lat'] = empty($xml) ?   $xml['Latitude'] : null;
        $activity['ip_long'] = empty($xml) ?   $xml['Longitude'] : null;
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

    public function getModelAttribute($value)
    {
        return ucfirst($value);
    }

    public function getCreatedByAttribute($value)
    {
        if($value)
        {
            return ucfirst($value);
        }
        return '---';
    }
    
}
