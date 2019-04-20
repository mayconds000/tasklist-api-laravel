<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'tasks'], function () {
    Route::get('', 'TaskController@get');
    Route::post('', 'TaskController@store');
    Route::patch('{task}', 'TaskController@update');
    Route::delete('{task}', 'TaskController@delete');
});