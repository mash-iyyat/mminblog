@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col l4 offset-l4 m8 offset-m2 s10 offset-s1">
    <div class="card horizontal">
      <div class="card-stacked">
        <h2 class="header center">Profile</h2>
        <form id="create-blog-form">
        	{{csrf_field()}}
	        <div class="card-content">
	          <div class="input-field">
	            <input id="title" type="text" name="title" class="validate">
	            <label for="title">Blog title</label>
	          </div>
	          <div class="input-field">
		          <textarea id="content" class="materialize-textarea" name="content"></textarea>
		          <label for="content">Textarea</label>
		        </div>
	        <div class="card-action">
	          <button class="btn-flat green darken-1 login-btn waves-effect waves-light" type="submit">
	            Create Blog
	          </button>
	        </div>	
        </form>
      </div>
    </div>
  </div>
</div>

@endsection


@section('scripts')

<script src="{{asset('js/create-blog.js')}}"></script>

@endsection