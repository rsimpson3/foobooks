<?php

# ----------------------------------------
# Book specific Routes
# ----------------------------------------
Route::get('/', 'BookController@getIndex');
Route::get('/books', 'BookController@getIndex');

Route::get('book/edit/{id?}','BookController@getEdit');
Route::post('book/edit','BookController@postEdit');

Route::get('/book/create', 'BookController@getCreate');
Route::post('/book/create', 'BookController@postCreate');

Route::get('/book/show/{title?}', 'BookController@getShow');

Route::get('/practice',function() {

    echo 'app.url: ' .config('app.url');
    echo '<br>app.env: ' .config('app.env');
    return '';
});

# Practice Routes for testing books mysql dbase - lecture 10 Part4
Route::get('/practice/ex1', 'PracticeController@getEx1');
Route::get('/practice/ex2', 'PracticeController@getEx2');
Route::get('/practice/ex3', 'PracticeController@getEx3');
Route::get('/practice/ex4', 'PracticeController@getEx4');
Route::get('/practice/ex5', 'PracticeController@getEx5');
Route::get('/practice/ex6', 'PracticeController@getEx6');
Route::get('/practice/ex7', 'PracticeController@getEx7');
Route::get('/practice/ex7', 'PracticeController@getEx7');
Route::get('/practice/ex9', 'PracticeController@getEx9');
Route::get('/practice/ex10', 'PracticeController@getEx10');
Route::get('/practice/ex11', 'PracticeController@getEx11');
Route::get('/practice/ex12', 'PracticeController@getEx12');
Route::get('/practice/ex13', 'PracticeController@getEx13');
Route::get('/practice/ex14', 'PracticeController@getEx14');
Route::get('/practice/ex15', 'PracticeController@getEx15');
Route::get('/practice/ex16', 'PracticeController@getEx16');
Route::get('/practice/ex17', 'PracticeController@getEx17');
Route::get('/practice/ex18', 'PracticeController@getEx18');
Route::get('/practice/ex19', 'PracticeController@getEx19');
Route::get('/practice/ex20', 'PracticeController@getEx20');
Route::get('/practice/ex21', 'PracticeController@getEx21');

# Restrict certain routes to only be viewable in the local environments
if(App::environment('local')) {
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
}

Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(config('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    /*
    The following line will output your MySQL credentials.
    Uncomment it only if you're having a hard time connecting to the database and you
    need to confirm your credentials.
    When you're done debugging, comment it back out so you don't accidentally leave it
    running on your live server, making your credentials public.
    */
    // print_r(config('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    }
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});



if(App::environment('local')) {

    Route::get('/drop', function() {

        DB::statement('DROP database foobooks');
        DB::statement('CREATE database foobooks');

        return 'Dropped foobooks; created foobooks.';
    });

};
