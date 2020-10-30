<?php

namespace rishab\actvity;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

use rishab\actvity\ActivityLog;

class activity extends Eloquent
{

    

    public static function add($msz, $model)
    {
        $data['msz'] = $msz;
        $data['model'] = $model;
        $data['class'] = 'add';
        ActivityLog::add($data);
    }

    // public static function delete($msz, $model)
    // {
    //     $data['msz'] = $msz;
    //     $data['model'] = $model;
    //     $data['class'] = 'delete';
    //     ActivityLog::add($data);
    // }

    // public static function update($msz, $model)
    // {
    //     $data['msz'] = $msz;
    //     $data['model'] = $model;
    //     $data['class'] = 'update';
    //     ActivityLog::add($data);
    // }
}
