<?php

// Route::get('log-viewer', function();
// Route::get('log-viewer/{id}', 'Logs\LogReport\controller\logController@view');
// /var/www/html/pakage/activityLog/pakages/

Route::group(env('LOG_AUTH') ?  ['middleware' => array(env('LOG_AUTH')), 'namespace' => 'rishab'] : ['namespace' => 'rishab'], function () {
    Route::any('activity-log', 'actvity\controller\logController@logs');
    Route::post('view-log', 'actvity\controller\logController@view');


    Route::get('system-log', 'actvity\controller\logController@systemLog');
    Route::get('download-log/{date}', 'actvity\controller\logController@download');
});
