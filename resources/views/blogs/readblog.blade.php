@extends('layouts.app')

@section('content')
<div class="row blog">
  <div class="col l4 offset-l1 hide-on-med-and-down">
    <ul class="collection">
      <li class="collection-header">
        <p>Blog members</p>
      </li>
      @foreach($users as $user)
      <li class="collection-item avatar">
        <a href="#">
          <a href="#!" class="secondary-content"><i class="fa fa-trophy"></i></a>
          <img src="/storage/images/profiles/{{$user->image}}" alt="" class="circle">
          <p class="top-blog-title">{{$user->username}}</p>
          <p>
            {{$user->blogs()->count()}} blog/s
          </p>  
        </a>
      </li>
      @endforeach
    </ul>
  </div>

  <div class="col l6 s12 m12">
    <h4 class="blog-header">{{$blog->title}}</h4><hr>
    @auth
      @if(Auth::user()->role == 'admin')
        <div class="pin-container">
          @if($blog->pinned == 'false')
            <a class="chip btn btn-flat green darken-1 waves-effect waves-light white-text" onclick="pinBlog('{{$blog->id}}')" id="pin-btn">
              <i class="fa fa-thumb-tack"></i>
            </a>  
          @else
            <a class="chip btn btn-flat red darken-1 waves-effect waves-light white-text" onclick="unpinBlog('{{$blog->id}}')" id="pin-btn">
              <i class="fa fa-thumb-tack"></i>
            </a>  
          @endif  
        </div>
      @endif
    @endauth
    <p>{{$blog->user->username}} | {{$blog->created_at}}</p>
    <div class="v-blog-container">
      @if($blog->image != 'no-image.jpg')
      <img src="/storage/images/blog_images/{{$blog->image}}" class="v-blog-image">
      @endif
      <p class="v-blog-content">{!!$blog->content!!}</p>
    </div>

    <div class="v-blog-comments row">
      @auth
        <div class="v-comment-form">
          <form id="add-comment-form">
            {{@csrf_field()}}
            <input type="hidden" name="blog_id" value="{{$blog->id}}">
            <div class="input-field">
              <label>Add Comment</label>
              <input type="text" name="comment" id="comment">
            </div>
          </form>
        </div>
      @endauth
      
      <div id="comments-container">
        @foreach($blog->comments()->orderBy('created_at','desc')->limit(5)->get() as $comment)
          <div class="card" id="comment-c-{{$comment->id}}">
            <div class="col s2 v-comment-profile">
              <img src="{{asset('images/no-image.jpg')}}">
            </div>
            <div class="card-content">
              <p class="card-title v-comment-name">{{$comment->user->username}}</p>
              <p>{{$comment->comment}}</p>
            </div>
            @auth
              @if($comment->belongsToMe(Auth::user()->id))
                <div class="card-action">
                  <button class="btn-flat btn white-text waves-effect waves-light red" onclick="deleteComment('{{$comment->id}}')">
                    <i class="fa fa-trash"></i>
                  </button>
                </div>
              @endif
            @endauth
          </div>
        @endforeach 

        @if($blog->comments->count() > 5)
          <div class="center">
            <button class="btn-flat btn white-text waves-effect waves-light green" id="view-more-comment-btn">
              View more comment
            </button>  
          </div>
        @endif
      </div>
      
    </div>
  </div>
</div><!-- row -->
@endsection

@section('scripts')
  <script type="text/javascript" src="{{asset('js/create-comment.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/create-blog.js')}}"></script>
@endsection