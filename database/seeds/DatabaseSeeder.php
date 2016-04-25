<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TagsTableSeeder::class);
        # Authors must be created first because
        $this->call(AuthorsTableSeeder::class);
        # Books calls to Authors table for author_id
        $this->call(BooksTableSeeder::class);
        # Tags & Books need to be created first
        $this->call(BookTagTableSeeder::class);
        # required dwa users 
        $this->call(UsersTableSeeder::class);

    }
}
