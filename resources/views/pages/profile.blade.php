@extends('layouts.app')

@section('content')
<nav class="grey darken-4" style="margin-bottom:50px;">
  <a href="{{ route('blogs') }}" class="brand-logo center">{{ Auth::user()->username }}</a>
</nav>

<div class="row container">
	<div class="col l4 hide-on-med-and-down">
	  <ul class="collection">
		<li class="collection-item">
		  BLogs<a href="" class="secondary-content"><span class="badge new blue">{{ Auth::user()->blogs->count() }}</span></a>
		</li>
		<li class="collection-item">
		  Pinned Blogs<a href="" class="secondary-content"><span class="badge new blue">{{ Auth::user()->comments->count() }}</span></a>
		</li>
	  </ul>
	</div>
	<div class="col l8 m10 offset-m1 s12">
		<ul class="collection with-header">
			<li class="collection-item center">
			  <img src="{{ asset('images/no-image.jpg') }}" style="width:50%;border-radius:50%">
			</li>
			<li class="collection-header center">
			  <h4>{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</h4>
			  <span>{{ Auth::user()->email }}</span>
			</li>
			<li class="collection-item">
			  <a href="{{ route('setting') }}" class="btn btn-flat blue lighten-1 white-text waves-effect waves-light" style="width:49%">
				account setting
			  </a>
			  <a class="waves-effect waves-light lighten-1 btn btn-flat blue modal-trigger" href="#create-modal" style="width:49%">
				Create blog
			  </a>
			</li>
			<li class="collection-item">
			  <h5><i class="fa fa-book"></i> Blogs</h5>
			</li>
			<div class="blog-collection-container">
			  <!-- APPEND BLOGS HERE -->
			</div>
			</li>
			  <button class="load-more-btn btn btn-flat waves-effect waves-light grey darken-4 white-text" style="width:100%">
				Load more blogs
			  </button>
			</li>
		</ul>
	</div>
</div>

<!-- ===================CREATE MODAL FORM===================== -->
<div class="create-post-container center">
	<div id="create-modal" class="modal modal-fixed-footer">
		<form id="create-blog-table-form" autocomplete="off">
			{{ @csrf_field() }}
			<div class="modal-content">
				<ul class="collection with-header">
					<li class="collection-header"><h3>Create post</h3></li>
					<li class="collection-item">
						<div class="input-field col s6">
							<input id="create-title" type="text" name="title" placeholder="Enter blog title...">
							<label for="title"><i class="fa fa-pencil"></i> Blog title</label>
						</div>
					</li>
					<li class="collection-item">
						<div class="input-field col s12">
							<label for="title"><i class="fa fa-pencil"></i> Blog Content</label>
							<textarea id="create-content" class="materialize-textarea" name="content" placeholder="Enter blog content..."></textarea>
						</div>
					</li>
					<li class="collection-item">
						<div class="file-field input-field">
							<div class="btn btn-flat blue white-text waves-light waves-effect">
								<span><i class="fa fa-image"></i></span>
								<input type="file" name="image">
							</div>
							<div class="file-path-wrapper">
								<input class="file-path validate" type="text" placeholder="Add image to your blog">
							</div>
						</div>
					</li>
				</ul>
			</div>
			<div class="modal-footer">
				<button class="btn-flat red lighten-1 waves-effect waves-light white-text modal-close" type="button">
					Cancel
				</button>
				<button class="btn-flat blue lighten-1 waves-effect waves-light white-text" type="submit">
					Submit
				</button>
			</div>	
		</form>
  </div>	
</div>
<!-- ===================CREATE MODAL FORM===================== -->

@endsection

@section('scripts')
  <script src="{{ asset('js/blogtable.js') }}"></script>
  <script src="{{ asset('js/profile.js') }}"></script>
@endsection