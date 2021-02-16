@extends('layouts.app')

@section('content')
<nav class="grey darken-4" style="margin-bottom:50px;">
  <a href="{{ route('blogs') }}" class="brand-logo center">Edit blog</a>
</nav>

<div class="row container">
  <div class="col l8 offset-l2">
    <form id="update-blog-form">
        {{ @csrf_field() }}
        <ul class="collection">
            <li class="collection-item">
                <div class="input-field">
                    <label for="title"><i class="fa fa-pencil"></i> Edit Blog Title</label>
                    <input type="text" name="title" id="title" value="{{ $blog->title }}">
                </div>
            </li>
            <li class="collection-item">
                <div class="input-field">
                    <textarea id="content" class="materialize-textarea" name="content" placehodler="Enter content">{{ $blog->content }}</textarea>
                    <label for="content"><i class="fa fa-pencil"></i> Edit Blog Contnet</label>
                </div>
            </li>
            <li class="collection-item">
                <div class="file-field input-field">
                    <div class="btn btn-flat blue lighten-1 waves-effect waves-light white-text">
                        <span><i class="fa fa-image"></i></span>
                        <input type="file" name="image">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Add image to blog...">
                    </div>
                </div>
            </li>
            <li class="collection-item">
                <button class="btn btn-flat blue lighten-1 waves-effect waves-light white-text" type="submit">
                    Save changes
                </button>
            </li>
        </ul>
    </form>    
  </div>
  
</div>

@endsection

@section('scripts')
  <script src="{{ asset('js/editblog.js') }}"></script>
  <script>
    const blogId = '{{ $blog->id }}';
  </script>
@endsection