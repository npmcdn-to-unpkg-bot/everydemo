<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['prefix'=>'/'], function () {
    Route::get('/',['as'=>'index','uses'=>'IndexController@index']);
    Route::get('/headroom.js',['as'=>'headroom','uses'=>'IndexController@headroom']);
    Route::get('/animate.css',['as'=>'animate','uses'=>'IndexController@animate']);
    Route::get('/three.js',['as'=>'threejs','uses'=>'IndexController@threejs']);
    Route::get('/video.js',['as'=>'video','uses'=>'IndexController@videojs']);
    Route::get('/resumable.js',['as'=>'resumable','uses'=>'IndexController@resumable']);
    Route::get('/canvas.js',['as'=>'canvas','uses'=>'IndexController@canvas']);
    Route::get('/howler.js',['as'=>'howler','uses'=>'IndexController@howler']);
    Route::get('/webvr.js',['as'=>'brush','uses'=>'IndexController@brush']);
});

Route::group(['prefix'=>'test/'],function() {
    Route::get('sign',['as'=>'sign','uses'=>'TestController@sign']);
    Route::post('signin',['as'=>'signin','uses'=>'TestController@signin']);
    Route::post('signup',['as'=>'signup','uses'=>'TestController@signup']);
});
