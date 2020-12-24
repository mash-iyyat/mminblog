@extends('layouts.app')

@section('content')
<div class="card blog-header">
  <div class="container">
    <h1>{{Auth::user()->username}}</h1>
  </div>
</div>

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
       
  <div class="row">
  	<div class="col l4 offset-l1 hide-on-med-and-down">
  		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
  		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
  		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
  		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
  		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
  		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
  	</div>
  	<div class="col l6 s12 m12">
  		<div class="center">
  		  <a class="btn-flat btn green white-text waves-effect modal-trigger" href="#create-blog-modal">
  		    Create Blog
  		  </a>
  		</div>
  		<div id="blog-container">
  			<div class="newPost"></div>
	  		@foreach(Auth::user()->blogs()->orderBy('created_at','DESC')->paginate(5) as $blog)
	  			<div class="col">
		  			<a href="blog/view={{$blog->id}}" class="blog-cards">
			        <div class="card">
			          @if($blog->image != 'no-image.jpg')
			          <div class="card-image">
			            <img src="storage/images/blog_images/{{$blog->image}}">
			          </div>
			          @endif
			          <div class="card-content">
			            <p>{{$blog->user->username}}</p>
			            <p class="posted-at">{{$blog->created_at}}</p>
			            <p class="card-blog-title">{{$blog->title}}</p>
			            <p class="blog-content">{{$blog->content}}</p>
			          </div>
			        </div>  
			      </a>	
	  			</div>
				@endforeach		
  		</div>
			<div class="center">
  		  <a class="btn-flat btn green white-text waves-effect" id="view-more-profile-btn">
  		    View more
  		  </a>
  		</div>
  	</div>
  </div>
@endsection


@section('scripts')

<script src="{{asset('js/create-blog.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/viewmore.js') }}"></script>

@endsection