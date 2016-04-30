<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use App\Http\Requests;

class PracticeController extends Controller
{

    public function getEx21() {

        # no constraint - gets all tags
        # eager loading of tags
        $books = \App\Book::with('tags')->get();

        foreach ($books as $book) {
            echo $book->title.'<br>';
            foreach($book->tags as $tag) {
                echo $tag->name.'<br>';
            }
            echo '<br>';
        }

    }

    public function getEx20(){

        $book = \App\Book::where('title', '=', 'The Great Gatsby')->first();

        # invoke tags method
        dump($book->tags);

        # no eager loading - extra query needed
        foreach($book->tags as $tag) {
            echo $tag->name.'<Br>';
        }
    }

    public function getEx19() {

        $author = new \App\Author;
        $author->first_name = 'J.K';
        $author->last_name = 'Rowling';
        $author->bio_url = 'https://en.wikipedia.org/wiki/J._K._Rowling';
        $author->birth_year = '1965';
        $author->save();
        dump($author->toArray());

        $book = new \App\Book;
        $book->title = "Harry Potter and the Philosopher's Stone";
        $book->published = 1997;
        $book->cover = 'http://prodimage.images-bn.com/pimages/9781582348254_p0_v1_s118x184.jpg';
        $book->purchase_link = 'http://www.barnesandnoble.com/w/harrius-potter-et-philosophi-lapis-j-k-rowling/1102662272?ean=9781582348254';
        $book->author()->associate($author); # <--- Associate the author with this book
        $book->save();
        dump($book->toArray());

    }

    public function getEx18() {

        # eager loading
        $books = \App\Book::with('author')->get();

        foreach ($books as $book) {

            echo $book->author->first_name.'<br>';

        }

    }

    public function getEx17() {

        $book = \App\Book::find(1);
        # dynamic properties
        dump($book->author->last_name);
    }

    public function getEx16() {
        # collection object
        $books = \App\Book::where('published', '>',1925)->get();

        return view('practice.index')->with('books',$books);

        // foreach($books as $book) {
        //     echo '<div> <img src="'.$book['cover'].'"</div>';
        // }
        // dump($books->toArray());

    }

    # Delete - Remove any books by the author “J.K. Rowling”.
    public function getEx15() {
        # First get books to delete
        $books = \App\Book::where('author', 'LIKE', 'J.K. Rowling')->get();

        # If we found the book, delete it
        if($books) {

            # Goodbye!
            foreach ($books as $book) {
               $book->delete();
            }

            return "Deletion complete; check the database to see if it worked...";

        }
        else {
            return "Can't delete - Book not found.";
        }

    }


    #Find any books by the author Bell Hooks and update the author name to be bell hooks (lowercase).
    public function getEx14() {
        # First get a book to update
        $book = \App\Book::where('author', '=', 'Bell Hooks')->first();

        # If we found the book, update it
        if($book) {

            # Change author to lowercase
            $book->author = 'bell hooks';

            # Save the changes
            $book->save();

            echo "Update complete; check the database to see if your update worked...";
        }
        else {
            echo "Book not found, can't update.";
        }

    }

    # Insert - Eloquent Model invoked
    public function getEx13() {

        # Create - Instantiate a new Book Model object
        $book = new \App\Book();

        # Set the parameters
        # Note how each parameter corresponds to a field in the table
        $book->title = 'Teaching Critical Thinking';
        $book->author = 'Bell Hooks';
        $book->published = 2010;
        $book->cover = 'http://ecx.images-amazon.com/images/I/31zPQUCIQ8L._SX332_BO1,204,203,200_.jpg';
        $book->purchase_link = 'http://www.amazon.com/Teaching-Critical-Thinking-Practical-Wisdom/dp/0415968208/ref=asap_bc?ie=UTF8';

        # Invoke the Eloquent save() method
        # This will generate a new row in the `books` table, with the above data
        $book->save();

        echo 'Added: '.$book->title;

    }

    #Retrieve all the books in descending order according to published date.
    public function getEx12() {
        $books = \App\Book::orderBy('published', 'desc')->get();

        foreach($books as $book) {
            echo $book->title. ' - '. $book->published. '<br>';
        }

    }

    #Retrieve all the books in alphabetical order by title.
    public function getEx11() {
        $books = \App\Book::orderBy('title', 'asc')->get();

        foreach($books as $book) {
            echo $book->title. '<br>';
        }

    }

    #Retrieve all the books published after 1950.
    public function getEx10() {

        $books = \App\Book::where('published', '>', '1950')->get();

        foreach($books as $book) {
            echo $book->title. '<br>';
        }

    }

    # Show the last 5 books that were added to the books table.
    public function getEx9() {

        # Sort books by descending id, select 5
        $books = \App\Book::orderBy('id', 'desc')->get()->take(5);

        foreach($books as $book) {
            echo $book->title. '<br>';
        }

    }

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
