<!-- connect child to master -->
@extends('layouts.master')

@section('title')
    Show book {{ $title }}
@stop

<!-- insert different css pages -->
@section ('head')
    <link href='/css/book/show.css' rel='stylesheet'>
@stop

@section('content')
    @if(isset($title))
        <h1>Show book: {{ $title }}</h1>
    @else
        <h1>No book chosen</h1>
    @endif
@stop

@section('body')
    <script src="/js/book/show.js"></script>
@stop
