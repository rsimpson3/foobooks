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
               value='{{ old('title', 'The Lorax') }}'
           >
           <div class='error'>{{ $errors->first('title') }}</div>
        </div>

        <div class='form-group'>
           <label>Author:</label>
           <input
               type='text'
               id='author'
               name='author'
               value='{{ old('author', 'Dr. Seuss') }}'
           >
           <div class='error'>{{ $errors->first('author') }}</div>
        </div>

        <div class='form-group'>
           <label>Published Year (YYYY):</label>
           <input
               type='text'
               id='published'
               name='published'
               value='{{ old('published','1971') }}'
           >
           <div class='error'>{{ $errors->first('published') }}</div>
        </div>

        <div class='form-group'>
           <label>URL of cover image:</label>
           <input
               type='text'
               id='cover'
               name='cover'
               value='{{ old('cover','http://prodimage.images-bn.com/pimages/9780394823379_p0_v3_s192x300.jpg') }}'
           >
           <div class='error'>{{ $errors->first('cover') }}</div>
        </div>

        <div class='form-group'>
           <label>URL of purchase link:</label>
           <input
               type='text'
               id='purchase_link'
               name='purchase_link'
               value='{{ old('purchase_link','http://www.barnesandnoble.com/w/lorax-dr-seuss/1101109833') }}'
           >
           <div class='error'>{{ $errors->first('purchase_link') }}</div>
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
