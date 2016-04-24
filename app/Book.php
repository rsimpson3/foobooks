<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //table must be "books"
    protected $fillable = ['title', 'author','published','cover','purchase_link'];

    public function author() {

        # each book belongs to 1 author
        return $this->belongsTo('\App\Author');

    }
}
