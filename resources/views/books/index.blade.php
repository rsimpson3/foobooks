@extends('layouts.master')

@section('head')
    <link href='/css/books_index.css' rel='stylesheet'>
@stop

@section('title')
    All books
@stop

@section('content')

    <h1>All the books</h1>

    @if(sizeof($books) == 0)
        You have not added any books, you can <a href='/book/create'>add a book now to get started</a>.
    @else
        @foreach($books as $book)
        <div id='books' class='cf'>
            <section class='book'>

                    <a href='/book/show/{{$book->id}}'><h2 class='truncate'>{{ $book->title }}</h2></a>

                    <h3 class='truncate'>{{ $book->author->first_name }} {{ $book->author->last_name }}</h3>

                    <img class='cover' src='{{ $book->cover }}' alt='Cover for {{$book->title}}'>

                    <div class='tags'>
                        @foreach($book->tags as $tag)
                            <div class='tag'>{{ $tag->name }}</div>
                        @endforeach
                    </div>
            </section>
        @endforeach
        </div>
    @endif

@stop
