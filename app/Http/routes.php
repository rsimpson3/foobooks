<?php

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/books', 'BookController@getIndex');
    Route::get('/book/create', 'BookController@getCreate');
    Route::post('/book/create', 'BookController@postCreate');
    Route::get('/book/show/{title?}', 'BookController@getShow');

    Route::get('/practice',function() {

        echo 'app.url: ' .config('app.url');
        echo '<br>app.env: ' .config('app.env');
        return '';
    });

    # Restrict certain routes to only be viewable in the local environments
    if(App::environment('local')) {
        Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    }
});
