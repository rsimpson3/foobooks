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
}
