<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller {

    /**
    * Responds to requests to GET /books
    */
    public function getIndex() {

        // # query dbase to list all books
        // # eager load author
        // $books = \App\Book::with('author')->orderBy('id','desc')->get();

        # logic moved to Book model
        $books = \App\Book::getAllBooksWithAuthors();

        # pass collection to view
        return view('books.index')->with('books',$books);
    }

    /**
     * Responds to requests to GET /books/show/{id}
     */
    public function getShow($id = null) {

        # book collection
        // $book = \App\Book::findOrFail($id);

        $book = \App\Book::find($id);

        # if book id not found
        if(is_null($book)) {
            \Session::flash('message','Book not found');
            return redirect('/books');
        }

        # create instance from new class
        $googleBooks = new \App\Libraries\GoogleBooks();

        # concatenate book author
        $author_name = $book->author->first_name.' ' .$book->author->last_name;

        $otherBooksByThisAuthor = $googleBooks->getOtherBooksByAuthor($author_name);

        # test GoogleBooks class working
        // dump($otherBooksByThisAuthor);

        return view('books.show',[
            'book' => $book,
            'otherBooksByThisAuthor' => $otherBooksByThisAuthor
        ]);

    }

    /**
     * Responds to requests to GET /books/create
     */
    public function getCreate() {

        // if(!\Auth::check()) {
        //     \Session::flash('message', 'You need to log in to create a new book.');
        //     return redirect('/');
        // }

        $authors_for_dropdown = \App\Author::authorsForDropdown();
        $tags_for_checkboxes = \App\Tag::getTagsForCheckboxes();

        return view('books.create')->with([
            'authors_for_dropdown' => $authors_for_dropdown,
            'tags_for_checkboxes' => $tags_for_checkboxes,
        ]);
    }

    /**
     * Responds to requests to POST /books/create
     */
     public function postCreate(Request $request) {
        //  dd($request);

        $messages = [
            'not_in' => 'You have to choose an author.',
        ];

         $this->validate($request,[
             'title' => 'required|min:3',
             'author_id' => 'not_in:0',
             'published' => 'required|min:4|max:4',
             'cover' => 'required|url',
             'purchase_link' => 'required|url'
         ], $messages);

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

        # append user_id to assign new book to that user
        $data['user_id'] = \Auth::id();

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

         # L12 add eager loading for tags
         $book = \App\Book::with('tags')->find($id);


         $authors_for_dropdown = \App\Author::authorsForDropdown();

         $tags_for_checkboxes = \App\Tag::getTagsForCheckboxes();

         $tags_for_this_book = [];
         foreach ($book->tags as $tag) {
             $tags_for_this_book[] = $tag->id;
         }

        //  dump($tags_for_this_book);

        //  dump($tags_for_checkboxes);

        //  # Get all authors
        //  $authors = \App\Author::orderBy('last_name','asc')->get();
        //
        //  # Build array for authors dropdown
        //  $authors_for_dropdown = [];
        //
        //  # key = author_id
        //  # values = last_name, first_name
        //
        //  foreach ($authors as $author) {
        //
        //      $authors_for_dropdown[$author->id] = $author->last_name.', '.$author->first_name;
        //  }
        //  # dump($authors->toArray());
        //
        //  # test authors in array
        // //  dump ($authors_for_dropdown);

         # pass authors_for_dropdown to view
         return view('books.edit')
            ->with('book', $book)
            ->with('authors_for_dropdown', $authors_for_dropdown)
            ->with('tags_for_checkboxes', $tags_for_checkboxes)
            ->with('tags_for_this_book', $tags_for_this_book);

     }

     public function postEdit(Request $request) {

         $book = \App\Book::find($request->id);

         # dump($request->tags);

         $book->title = $request->title;
         $book->author_id = $request->author_id;
         $book->cover = $request->cover;
         $book->published = $request->published;
         $book->purchase_link = $request->purchase_link;

         # pass empty array if all tags unchecked, deletes relationships
         if ($request->tags) {
             $tags = $request->tags;
         }
         else {
             $tags = [];
         }

         $book->tags()->sync($tags);

        # breaks if no tags checked
        //  $book->tags()->sync($request->tags);

         $book->save();

         \Session::flash('message', 'Your changes were saved.');
         return redirect('book/edit/'.$request->id);

     }

     public function getConfirmDelete($id = null) {

         $book = \App\Book::find($id);

         return view('books.delete')->with('book', $book);

     }

     public function getDelete($id = null) {

         # Get the book to be deleted
       $book = \App\Book::find($id);

       if(is_null($book)) {
           \Session::flash('message','Book not found.');
           return redirect('/books');
       }

       # First remove any tags associated with this book
       if($book->tags()) {
           $book->tags()->detach();
       }

       # Then delete the book
       $book->delete();

       # Done
       \Session::flash('message',$book->title.' was deleted.');
       return redirect('/books');

    }

} #eoc
