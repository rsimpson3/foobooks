<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class BookController extends Controller {

    /**
    * Responds to requests to GET /books
    */
    public function getIndex() {
        return 'Here is the list of my books';
    }

    /**
     * Responds to requests to GET /books/show/{id}
     */
    public function getShow($id) {
        return 'Show an individual book: ' .$id;
    }

    /**
     * Responds to requests to GET /books/create
     */
    public function getCreate() {
        $view  = '<form method="POST" >';
        $view .= csrf_field();
        $view .= 'Book title: <input type="text" name="title">';
        $view .= '<input type="submit">';
        $view .= '</form>';

        return $view;
    }

    /**
     * Responds to requests to POST /books/create
     */
    public function postCreate() {
        return 'Add the book: '.$_POST['title'];
    }
} #eoc
