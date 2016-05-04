@extends('layouts.master')

@section('title')
    Add a new book
@stop

@section('content')

    <h1>Add a new book</h1>

    <form method='POST' action='/book/create'>

        {{ csrf_field() }}

        <div class='form-group'>
           <label>Title:</label>
           <input
               type='text'
               id='title'
               name='title'
               value='{{ old('title') }}'
           >
           <div class='error'>{{ $errors->first('title') }}</div>
        </div>

        <div class='form-group'>
            <label for='author_id'>Author:</label>
            <select name='author_id' id='author_id'>
                @foreach($authors_for_dropdown as $author_id => $author_name)
                     <option value='{{$author_id}}'>
                         {{$author_name}}
                     </option>
                 @endforeach
            </select>
            <div class='error'>{{ $errors->first('author_id') }}</div>
        </div>

        <div class='form-group'>
           <label>Published Year (YYYY):</label>
           <input
               type='text'
               id='published'
               name='published'
               value='{{ old('published') }}'
           >
           <div class='error'>{{ $errors->first('published') }}</div>
        </div>

        <div class='form-group'>
           <label>URL of cover image:</label>
           <input
               type='text'
               id='cover'
               name='cover'
               value='{{ old('cover') }}'
           >
           <div class='error'>{{ $errors->first('cover') }}</div>
        </div>

        <div class='form-group'>
           <label>URL of purchase link:</label>
           <input
               type='text'
               id='purchase_link'
               name='purchase_link'
               value='{{ old('purchase_link') }}'
           >
           <div class='error'>{{ $errors->first('purchase_link') }}</div>
        </div>

        <div class='form-group'>
            <fieldset>
                <legend>Tags:</legend>
                @foreach($tags_for_checkboxes as $tag_id => $tag_name)
                    <label>
                        <input
                            type='checkbox'
                            value='{{ $tag_id }}'
                            name='tags[]'
                        >
                        {{$tag_name}}
                    </label>
                @endforeach
            </fieldset>
        </div>
        
        <div class='form-instructions'>
            All fields are required.
        </div>

        <button type="submit" class="btn btn-primary">Add book</button>

        {{--
        <ul class=''>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        --}}

        <div class='error'>
            @if(count($errors) > 0)
                Please correct the errors above and try again.
            @endif
        </div>

    </form>


@stop
