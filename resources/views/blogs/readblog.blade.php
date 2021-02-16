@extends('layouts.app')

@section('content')
<nav class="grey darken-4">
</nav>
<div class="row" style="margin-top:30px">
  <div class="col l6 offset-l1 m12 s12">
    <ul class="collection with-header">
      <li class="collection-header center">
        <h4>{{ $blog->title }}</h4>
        <span>Posted by {{ $blog->user->username }}</span>
      </li>
      @if($blog->image != 'no-image.jpg')
        <li>
          <img src="/storage/images/blog_images/{{ $blog->image }}" alt="" class="max-width">
        </li> 
      @endif
      <li class="collection-item" style="text-align:justify">
        <p class="blog-content">{{ $blog->content }}</p>
      </li>
      <li class="collection-item center count-container">
        
      </li>
      @auth
      <li class="collection-item">
        <form id="add-comment-form">
          {{ @csrf_field() }}
          <div class="input-field">
            <label for="comment"><i class="fa fa-comment"></i></label>
            <input type="hidden" name="blog_id" value="{{ $blog->id }}">
            <textarea type="submit" class="materialize-textarea" name="comment" placeholder="Enter your comment" id="comment"></textarea>
          </div>  
          <button class="btn btn-flat white-text waves-effect waves-light blue lighten-1 max-width" type="submit">
            Add comment
          </button>
        </form>
      </li>
      @endauth
    </ul>
  </div>
  <div class="col l5 m12 s12">
    <ul class="collection with-header">
      <li class="collection-header">
        <h4>Comments</h4>
      </li>
      <div class="comments-container">
          <!-- ========== APPEND COMMENTS HERE ============ -->
      </div>
      @if($blog->comments->count() > 5)
      <li>
        <button class="btn btn-flat white-text waves-effect waves-light blue lighten-1 max-width view-more-comment-btn">
          View more comment
        </button>
      </li>
      @endif
    </ul>
  </div>
</div><!-- row -->
@endsection

@section('scripts')
  <script type="text/javascript" src="{{asset('js/create-comment.js')}}"></script>
  <script>
    $(document).ready(() => {
      getComments('{{ $blog->id }}');
    })
  </script>
@endsection