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
        'user', 'model', 'status', 'ip_address','timezone'
    ];

    public static function add($data)
    {
        ActivityLog::create([
            'user' => $data['msz'],
            'model' => $data['model'],
            'status' => $data['class'],
            'ip_address' => self::get_client_ip(),
            'timezone' => date_default_timezone_get(),
        ]);
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
                return '<span class="badge badge-primary">Insert</span>';
                break;

            case 'delete':
                return '<span class="badge badge-primary">Deleted</span>';
                break;

            case 'update':
                return '<span class="badge badge-primary">updated</span>';
                break;

            default:
                # code...
                break;
        }
    }
}
