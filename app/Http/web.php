<?php

/*
|--------------------------------------------------------------------------
| Module Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for the module.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::group(['middleware' => ['web']], function () {
    Route::group(['prefix' => config("fileconfig.prefix")], function () {
        Route::group(['namespace' => '\Guo\File\Http\Controllers'], function () {
//            Route::get('filelist', 'HomeController@filelist');
//            Route::get('dirlist', 'HomeController@dirlist');
//            Route::get('getlog', 'HomeController@getlog');
//            Route::get('file', 'HomeController@getcontent');
//            Route::get('delfile', 'HomeController@delfile');
            Route::get('file/lists', 'FileController@lists');
            Route::get('file/delete', 'FileController@delete');
            Route::get('file/select', 'FileController@select');
            Route::post('file/update', 'FileController@update');
            Route::get('getlog', 'FileController@getlog');

        });
    });
});

