@extends('layouts.app')

@section('content')
<div class="row blog">
  <div class="col l4 offset-l1 hide-on-med-and-down">

    <form class="search-blog-form">
      <div class="input-field">
        <i class="fa fa-search prefix"></i>
        <input id="icon_prefix" type="text" class="validate" placeholder="Seach Blog">
      </div> 
    </form>

    <ul class="collection">
      <li class="collection-header">
        <p>Pinned blogs</p>
      </li>
      <li class="collection-item avatar">
        <a href="#">
          <a href="#!" class="secondary-content"><i class="fa fa-bookmark"></i></a>
          <img src="{{asset('images/no-image.jpg')}}" alt="" class="circle">
          <p class="top-blog-title">Bakit natin ito ginagamit?</p>
          <p>
            By Mashu Case Files-2nd Archives <br>
            Posted 3 days ago
          </p>  
        </a>
      </li>
    </ul>

    <ul class="collection">
      <li class="collection-header">
        <p>Blog members</p>
      </li>
      <li class="collection-item avatar">
        <a href="#">
          <a href="#!" class="secondary-content"><i class="fa fa-trophy"></i></a>
          <img src="{{asset('images/no-image.jpg')}}" alt="" class="circle">
          <p class="top-blog-title">Mashu Case Files-2nd Archives</p>
          <p>
            300 blogs
          </p>  
        </a>
      </li>
    </ul>
  </div>

  <div class="col l6 s12 m12">
    <h4 class="blog-header">{{$blog->title}}</h4><hr>
    <p>{{$blog->user->username}} | {{$blog->created_at}}</p>
    <div class="v-blog-container">
      @if($blog->image != 'no-image.jpg')
      <img src="/storage/images/blog_images/{{$blog->image}}" class="v-blog-image">
      @endif
      <p class="v-blog-content">{{$blog->content}}</p>
    </div>
    @auth
      @if(Auth::user()->id === $blog->user->id)
        <button class="btn btn-flat green darken-3 white-text modal-trigger" onclick="editPost('{{$blog->id}}')"  href="#edit-blog-modal">
          <i class="fa fa-pencil"></i>
        </button>
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
      @endif
    @endauth

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
        @foreach($blog->comments()->orderBy('created_at','desc')->get() as $comment)
          <div class="col s12" id="comment-c-{{$comment->id}}">
            <div class="col s2 v-comment-profile">
              <img src="{{asset('images/no-image.jpg')}}">
            </div>
            <div class="card col s10">
              <div class="card-content v-comment-card">
                <p class="card-title v-comment-name">{{$comment->user->username}}</p>
                <p>{{$comment->comment}}</p>
              </div>
            </div>  
            @auth
              @if($comment->belongsToMe(auth::user()->id))
              <button class="btn btn-flat red white-text" onclick="deleteComment('{{$comment->id}}')">Delete</button>
              @endif
            @endauth
          </div>
        @endforeach  
      </div>
      
    </div>
  </div>
</div><!-- row -->
@endsection

@section('scripts')
  <script type="text/javascript" src="{{asset('js/create-comment.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/create-blog.js')}}"></script>
@endsection