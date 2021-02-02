@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col l8 offset-l2">
    <h4 class="blog-header">{{$blog->title}}</h4><hr>
    <div class="v-blog-container">
      @if($blog->image != 'no-image.jpg')
      <img src="/storage/images/blog_images/{{$blog->image}}" class="v-blog-image">
      @endif
      <p style="text-align: justify;">{!!$blog->content!!}</p>
    </div>

    <div class="v-blog-comments row">
      @auth
        <div class="v-comment-form">
          <form id="add-comment-form" autocomplete="off">
            {{@csrf_field()}}
            <input type="hidden" name="blog_id" value="{{$blog->id}}">
            <div class="input-field">
              <label>Add Comment</label>
              <input type="text" name="comment" id="comment">
            </div>
          </form>
        </div>
      @endauth
      <h4>Comments</h4>
      <ul class="collection with-header" id="comments-container">
        @foreach($blog->comments()->orderBy('created_at','DESC')->get() as $comment)
          <li class="collection-item avatar" id="comment-{{$comment->id}}">
            <img src="{{ asset('images/no-image.jpg') }}" alt="" class="circle">
            <span class="title"><b>{{ $comment->user->username }}</b> | {{$comment->created_at}}</span>
            <p>
              {{$comment->comment}}
            </p>
            @auth
              @if(auth()->user()->id == $comment->user->id)
                <a onclick="deleteComment('{{$comment->id}}')" class="secondary-content">
                  <i class="fa fa-trash red-text"></i>
                </a>
              @endif
            @endauth
          </li>
        @endforeach
      </ul>
    </div>
  </div>
</div><!-- row -->
@endsection

@section('scripts')
  <script type="text/javascript" src="{{asset('js/create-comment.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/create-blog.js')}}"></script>
@endsection