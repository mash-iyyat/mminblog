@extends('layouts.app')

@section('content')

<a class="waves-effect waves-light btn modal-trigger" href="#create-blog-modal">Create Blog</a>

<div id="create-blog-modal" class="modal">
	<form id="create-blog-form">
		<div class="modal-content">
	    <h4>Create Blog</h4>
	    {{ @csrf_field() }}
	    <div class="input-field">
	      <input id="title" type="text" name="title" class="validate">
	      <label for="title">Blog title</label>
	    </div>
	    <div class="input-field">
	      <textarea id="content" class="materialize-textarea" name="content"></textarea>
	      <label for="content">Textarea</label>
	    </div>
	    <div class="file-field input-field">
	      <div class="btn">
	        <span>Image</span>
	        <input type="file" name="image">
	      </div>
	      <div class="file-path-wrapper">
	        <input class="file-path validate" type="text">
	      </div>
	    </div>
	  </div>
	  <div class="modal-footer">
	    <button class="btn-flat green darken-1 login-btn waves-effect waves-light" type="submit">
        Create Blog
      </button>
	  </div>	
	</form>
</div>
       

@endsection


@section('scripts')

<script src="{{asset('js/create-blog.js')}}"></script>

@endsection