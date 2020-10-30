<?php

namespace rishab\actvity;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

use rishab\actvity\ActivityLog;

class activity extends Eloquent
{

    

    public static function add($data)
    {
        $data['status'] = 'add';
        ActivityLog::add($data);
    }

    public static function remove($data)
    {
        $data['status'] = 'remove';
        ActivityLog::add($data);
    }

    public static function modified($data)
    {
        $data['status'] = 'modified';
        ActivityLog::add($data);

    }

    
}
