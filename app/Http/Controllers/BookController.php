<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller {

    /**
    * Responds to requests to GET /books
    */
    public function getIndex() {

        # query dbase to list all books
        $books = \App\Book::orderBy('id','desc')->get();

        # pass collection to view
        return view('books.index')->with('books',$books);
    }

    /**
     * Responds to requests to GET /books/show/{id}
     */
    public function getShow($title = null) {
        return view('books.show')->with('title',$title);
        #return 'Show an individual book: ' .$title;
    }

    /**
     * Responds to requests to GET /books/create
     */
    public function getCreate() {
        return view('books.create');
    }

    /**
     * Responds to requests to POST /books/create
     */
     public function postCreate(Request $request) {
        //  dd($request);
         $this->validate($request,[
             'title' => 'required|min:3',
             'author' => 'required',
             'published' => 'required|min:4|max:4',
             'cover' => 'required|url',
             'purchase_link' => 'required|url',
         ]);

         # Add the book to the dbase
        //  $book = new \App\Book();
        //  $book->title = $request->title;
        //  $book->author = $request->author;
        //  $book->published = $request->published;
        //  $book->cover = $request->cover;
        //  $book->purchase_link = $request->purchase_link;
        //  $book->save();

        # Mass Assignment 1
        $data = $request->only('title','author','published','cover','purchase_link');
        $book = new \App\Book($data);
        $book->save();

        # Mass Assignment 2
        // \App\Book::create($data);

         \Session::flash('message','Your book was added');

         # don't leave user on post route
        //  return 'Add the book: '.$request->title;

        return redirect('/books');

     }

     public function getEdit($id) {

         $book = \App\Book::find($id);

         return view('books.edit')->with('book', $book);

     }

     public function postEdit(Request $request) {

         $book = \App\Book::find($request->id);

         $book->title = $request->title;
         $book->author = $request->author;
         $book->cover = $request->cover;
         $book->published = $request->published;
         $book->purchase_link = $request->purchase_link;

         $book->save();

         \Session::flash('message', 'Your changes were saved.');
         return redirect('book/edit/'.$request->id);

     }

} #eoc
