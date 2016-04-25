<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    public function run()
    {
        $data = ['novel','fiction','classic','wealth','women','autobiography','nonfiction'];

        foreach($data as $tagName) {
            # create instance of model - need Tag.php
            $tag = new \App\Tag();
            $tag->name = $tagName;
            $tag->save();
        }
    }
}
