<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public function books() {

        # relationship to book
        # each author has many books
        return $this->hasMany('\App\Book');
    }

    public static function authorsForDropdown() {

        # Get all authors
        $authors = \App\Author::orderBy('last_name','asc')->get();
        
        # Build array for authors dropdown
        $authors_for_dropdown = [];

        # key = author_id
        # values = last_name, first_name

        foreach ($authors as $author) {

            $authors_for_dropdown[$author->id] = $author->last_name.', '.$author->first_name;
        }

        return $authors_for_dropdown;

    }
}
