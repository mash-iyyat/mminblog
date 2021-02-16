@extends('layouts.app')

@section('content')
<nav class="grey darken-4" style="margin-bottom:50px;">
  <a href="{{ route('blogs') }}" class="brand-logo center">{{ Auth::user()->username }}</a>
</nav>

<div class="row container">
	<div class="col l8 m10 offset-l2 offset-m1 s12">
		<ul class="collection with-header">
		  <li class="collection-header">
            <h4>Notifications</h4>
          </li>
          <div class="notifications-container">
            <!-- ============ APPEND HERE ============== -->
          </div>
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
								<input class="file-path validate" type="text" placeholder="Add image to your blog" disalbed="disabled">
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
  <script src="/js/notifications.js"></script>
@endsection