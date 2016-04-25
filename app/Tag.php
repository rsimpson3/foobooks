<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function books() {
        return $this->belongsToMany('\App\Book')->withTimestamps();
    }

    public static function getTagsForCheckboxes() {

        $tags = \App\Tag::orderBy('name','asc')->get();

        $tags_for_checkboxes = [];

        foreach ($tags as $tag) {
            $tags_for_checkboxes[$tag['id']] = $tag['name'];
        }

        return $tags_for_checkboxes;
    }
}
