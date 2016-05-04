<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //table must be "books"
    protected $fillable = ['title', 'author','published','cover','purchase_link','user_id'];

    public function author() {

        # each book belongs to 1 author
        return $this->belongsTo('\App\Author');
    }

    public function tags() {
        # force update to timestamps
        return $this->belongsToMany('\App\Tag')->withTimestamps();
    }

    public function user() {
        # like author model above - each book has one user_id
        return $this->belongsTo('\App\User');

    }

    public static function getAllBooksWithAuthors() {

        return \App\Book::with('author')->where('user_id', '=', \Auth::id())->orderBy('id','desc')->get();

        // return \App\Book::with('author')->orderBy('id','desc')->get();
    }
}
