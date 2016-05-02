<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author_id = \App\Author::where('last_name','=','Fitzgerald')->pluck('id')->first();
        DB::table('books')->insert([
           'created_at' => Carbon\Carbon::now()->toDateTimeString(),
           'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
           'title' => 'The Great Gatsby',
           # 'author' => 'F. Scott Fitzgerald',
           'author_id' => $author_id,
           'published' => 1925,
           'cover' => 'http://img2.imagesbn.com/p/9780743273565_p0_v4_s114x166.JPG',
           'purchase_link' => 'http://www.barnesandnoble.com/w/the-great-gatsby-francis-scott-fitzgerald/1116668135?ean=9780743273565',
       ]);

       $author_id = \App\Author::where('last_name','=','Plath')->pluck('id')->first();
       DB::table('books')->insert([
           'created_at' => Carbon\Carbon::now()->toDateTimeString(),
           'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
           'title' => 'The Bell Jar',
           # 'author' => 'Sylvia Plath',
           'author_id' => $author_id,
           'published' => 1963,
           'cover' => 'http://img1.imagesbn.com/p/9780061148514_p0_v2_s114x166.JPG',
           'purchase_link' => 'http://www.barnesandnoble.com/w/bell-jar-sylvia-plath/1100550703?ean=9780061148514',
       ]);

       $author_id = \App\Author::where('last_name','=','Angelou')->pluck('id')->first();
       DB::table('books')->insert([
           'created_at' => Carbon\Carbon::now()->toDateTimeString(),
           'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
           'title' => 'I Know Why the Caged Bird Sings',
           # 'author' => 'Maya Angelou',
           'author_id' => $author_id,
           'published' => 1969,
           'cover' => 'http://img1.imagesbn.com/p/9780345514400_p0_v1_s114x166.JPG',
           'purchase_link' => 'http://www.barnesandnoble.com/w/i-know-why-the-caged-bird-sings-maya-angelou/1100392955?ean=9780345514400',
       ]);

       $author_id = \App\Author::where('last_name','=','Herbert')->pluck('id')->first();
       DB::table('books')->insert([
           'created_at' => Carbon\Carbon::now()->toDateTimeString(),
           'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
           'title' => 'Dune',
           # 'author' => 'Frank Herbert',
           'author_id' => $author_id,
           'published' => 1965,
           'cover' => 'http://www.amazon.com/Dune-Frank-Herbert/dp/0441172717/ref=sr_1_1?s=books&ie=UTF8&qid=1462138619&sr=1-1&keywords=dune+by+frank+herbert',
           'purchase_link' => 'http://www.barnesandnoble.com/w/dune-frank-herbert/1100608835?ean=9780441172719',
       ]);
    }
}
