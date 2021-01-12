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
	    <h4>Blog</h4>
	    {{ @csrf_field() }}
	    <div class="input-field">
	      <input id="title" type="text" name="title" class="validate" data-length="50">
	      <label for="title">Blog title</label>
	    </div>
	    <div class="input-field">
	      <textarea id="content" class="materialize-textarea" name="content" data-length="500"></textarea>
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
        Submit
      </button>
	  </div>	
	</form>
</div>

<div id="edit-blog-modal" class="modal">
	<form id="edit-blog-form">
		<div class="modal-content">
	    <h4>Edit Blog</h4>
	    {{ @csrf_field() }}
	    <div class="input-field">
	      <input id="edit-title" type="text" name="title" class="validate">
	      <label for="title">Blog title</label>
	    </div>
	    <div class="input-field">
	      <textarea id="edit-content" class="materialize-textarea" name="content"></textarea>
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
        Save
      </button>
	  </div>	
	</form>
</div>

<div class="create-post-container center">
	<a class="waves-effect waves-light btn btn-flat green white-text modal-trigger" href="#create-modal">Create blog</a>

	<div id="create-modal" class="modal modal-fixed-footer">
		<form id="create-blog-table-form">
			{{ @csrf_field() }}
	  	<div class="modal-content">
	      <h4>Create blog</h4>
	      <div class="input-field col s6">
	        <input id="create-title" type="text" name="title">
	        <label for="title">Blog title</label>
	      </div>
	      <div class="input-field col s12">
	        <textarea id="create-content" class="materialize-textarea" name="content"></textarea>
	        <label for="content">Textarea</label>
	      </div>
	      <div class="file-field input-field">
		      <div class="btn btn-flat blue white-text waves-light waves-effect">
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
	        Save
	      </button>
	    </div>	
		</form>
	</div>	
</div>

<div class="container table-container">
  <table class="bordered centered" id="blog-table">
	  <thead>
	    <tr>
        <th>Title</th>
        <th>Date posted</th>
        <th>Options</th>
	    </tr>
	  </thead>

	  <tbody id="blog-tbl-body">
	  	@foreach(Auth::user()->blogs()->orderBy('created_at','DESC')->paginate(5) as $blog)
		  	<tr id="tr-{{$blog->id}}">
		      <td class="td-{{$blog->id}}">{{$blog->title}}</td>
		      <td class="td-{{$blog->id}}">{{$blog->created_at->diffForHumans()}}</td>
		      <td class="td-{{$blog->id}}">
		      	<button class="btn-flat btn waves-effect waves-light white-text red" onclick="deleteRow('{{$blog->id}}')">
		      		<i class="fa fa-trash"></i>
		      	</button>
		      	<button class="btn btn-flat green darken-3 white-text modal-trigger" onclick="editRow('{{$blog->id}}')"  href="#edit-blog-modal">
			      	<i class="fa fa-pencil"></i>
			      </button>
		      </td class="td-{{$blog->id}}">
		    </tr>
	  	@endforeach
	  </tbody>
	</table>  
	<div class="view-more-container center">
		<button class="btn btn-flat green center waves-effect waves-light white-text" id="view-more-btn">View more</button>		
	</div>
</div>
	
@endsection

@section('scripts')

<script type="text/javascript" src="{{ asset('js/blogtable.js') }}"></script>

@endsection