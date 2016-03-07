<?php

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        #return view('welcome');
        return 'Welcome to my first Laravel site.';
    });

    Route::get('/books', function () {
        #return view('welcome');
        return 'Here is the list of my books';
    });

    // Route::match(['post'],'/book/create', function () {
    //     return 'Add the book';
    // });

    Route::get('/book/create', function () {

        $view  = '<form method="POST" action="book/create">';
        $view .= csrf_field();
        $view .= 'Book title: <input type="text" name="title">';
        $view .= '<input type="submit">';
        $view .= '</form>';

        return $view;
    });

    Route::post('/book/create', function () {
        return 'Add the book: '.$_POST['title'];
    });

    Route::get('/book/{title}', function ($title) {
        #return view('welcome');
        return 'Show an individual book: ' .$title;
    });

});
?>
