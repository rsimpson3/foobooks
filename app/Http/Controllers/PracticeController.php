<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use App\Http\Requests;

class PracticeController extends Controller
{

    # Delete
    public function getEx7() {
        # First get a book to delete
        $book = \App\Book::where('author', 'LIKE', '%Scott%')->first();

        # If we found the book, delete it
        if($book) {

            # Goodbye!
            $book->delete();

            return "Deletion complete; check the database to see if it worked...";

        }
        else {
            return "Can't delete - Book not found.";
        }
        
    }

    # updated
    public function getEx6() {
        # First get a book to update
        $book = \App\Book::where('author', 'LIKE', '%Scott%')->first();

        # If we found the book, update it
        if($book) {

            # Give it a different title
            $book->title = 'The Really Great Gatsby';

            # Save the changes
            $book->save();

            echo "Update complete; check the database to see if your update worked...";
        }
        else {
            echo "Book not found, can't update.";
        }

    }

    # Read
    public function getEx5() {

        # using book model
        $books = \App\Book::all();
        foreach($books as $book) {
            echo $book->title. '<br>';
        }

    }

    # Insert - Eloquent Model invoked
    public function getEx4() {

        # Create - Instantiate a new Book Model object
        $book = new \App\Book();

        # Set the parameters
        # Note how each parameter corresponds to a field in the table
        $book->title = 'Harry Potter';
        $book->author = 'J.K. Rowling';
        $book->published = 1997;
        $book->cover = 'http://prodimage.images-bn.com/pimages/9780590353427_p0_v1_s484x700.jpg';
        $book->purchase_link = 'http://www.barnesandnoble.com/w/harry-potter-and-the-sorcerers-stone-j-k-rowling/1100036321?ean=9780590353427';

        # Invoke the Eloquent save() method
        # This will generate a new row in the `books` table, with the above data
        $book->save();

        echo 'Added: '.$book->title;

    }

    # Read
    public function getEx3() {

        // Use the QueryBuilder to get all the books where author is like "%Scott%"
        $books = \DB::table('books')->where('author', 'LIKE', '%Scott%')->get();

        // Output the results
        foreach($books as $book) {
            echo $book->title.'<br>';
        }

    }

    # Create
    public function getEx2() {

        // Use the QueryBuilder to insert a new row into the books table
        // i.e. create a new book
        \DB::table('books')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'title' => 'The Great Gatsby',
            'author' => 'F. Scott Fitzgerald',
            'published' => 1925,
            'cover' => 'http://img2.imagesbn.com/p/9780743273565_p0_v4_s114x166.JPG',
            'purchase_link' => 'http://www.barnesandnoble.com/w/the-great-gatsby-francis-scott-fitzgerald/1116668135?ean=9780743273565',
        ]);

        return 'Added book.';

    }

    # Read
    public function getEx1() {

        /// Use the QueryBuilder to get all the books
        $books = \DB::table('books')->get();

        // Output the results
        foreach ($books as $book) {
            echo $book->title;
        }
    }
}
