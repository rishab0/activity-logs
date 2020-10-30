<?php

// Route::get('log-viewer', function();
// Route::get('log-viewer/{id}', 'Logs\LogReport\controller\logController@view');
// /var/www/html/pakage/activityLog/pakages/
Route::get('activity-log', 'rishab\actvity\controller\logController@logs');
Route::post('view-log', 'rishab\actvity\controller\logController@view');
