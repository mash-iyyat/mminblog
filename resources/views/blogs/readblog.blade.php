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
          <img src="images/no-image.jpg" alt="" class="circle">
          <p class="top-blog-title">Bakit natin ito ginagamit?</p>
          <p>
            By Mashu Case Files-2nd Archives <br>
            Posted 3 days ago
          </p>  
        </a>
      </li>
      <li class="collection-item avatar">
        <a href="#">
          <a href="#!" class="secondary-content"><i class="fa fa-bookmark"></i></a>
          <img src="images/no-image.jpg" alt="" class="circle">
          <p class="top-blog-title">Bakit natin ito ginagamit?</p>
          <p>
            By Mashu Case Files-2nd Archives <br>
            Posted 3 days ago
          </p>  
        </a>
      </li>
      <li class="collection-item avatar">
        <a href="#">
          <a href="#!" class="secondary-content"><i class="fa fa-bookmark"></i></a>
          <img src="images/no-image.jpg" alt="" class="circle">
          <p class="top-blog-title">Bakit natin ito ginagamit?</p>
          <p>
            By Mashu Case Files-2nd Archives <br>
            Posted 3 days ago
          </p>  
        </a>
      </li>
      <li class="collection-item avatar">
        <a href="#">
          <a href="#!" class="secondary-content"><i class="fa fa-bookmark"></i></a>
          <img src="images/no-image.jpg" alt="" class="circle">
          <p class="top-blog-title">Bakit natin ito ginagamit?</p>
          <p>
            By Mashu Case Files-2nd Archives <br>
            Posted 3 days ago
          </p>  
        </a>
      </li>
      <li class="collection-item avatar">
        <a href="#">
          <a href="#!" class="secondary-content"><i class="fa fa-bookmark"></i></a>
          <img src="images/no-image.jpg" alt="" class="circle">
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
          <img src="images/no-image.jpg" alt="" class="circle">
          <p class="top-blog-title">Mashu Case Files-2nd Archives</p>
          <p>
            300 blogs
          </p>  
        </a>
      </li>
      <li class="collection-item avatar">
        <a href="#">
          <a href="#!" class="secondary-content"><i class="fa fa-trophy"></i></a>
          <img src="images/no-image.jpg" alt="" class="circle">
          <p class="top-blog-title">Kiyohimemes</p>
          <p>
            102 blogs
          </p>  
        </a>
      </li>
      <li class="collection-item avatar">
        <a href="#">
          <a href="#!" class="secondary-content"><i class="fa fa-trophy"></i></a>
          <img src="images/no-image.jpg" alt="" class="circle">
          <p class="top-blog-title">Lancelot Milfs Magic</p>
          <p>
            69 blogs
          </p>  
        </a>
      </li>
      <li class="collection-item avatar">
        <a href="#">
          <a href="#!" class="secondary-content"><i class="fa fa-trophy"></i></a>
          <img src="images/no-image.jpg" alt="" class="circle">
          <p class="top-blog-title">The Royal Speedwagon</p>
          <p>
            50 blogs
          </p>  
        </a>
      </li>
      <li class="collection-item avatar">
        <a href="#">
          <a href="#!" class="secondary-content"><i class="fa fa-trophy"></i></a>
          <img src="images/no-image.jpg" alt="" class="circle">
          <p class="top-blog-title">The Real Emiya</p>
          <p>
            20 blogs
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
      <div class="chip waves-effect waves-light">
        <a href=""><i class="fa fa-bookmark"></i></a>
      </div>
    </div>

    <div class="v-blog-comments row">
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
      <div id="comments-container">
        @foreach($blog->comments()->get() as $comment)
          <div class="col s12">
            <div class="col s2 v-comment-profile">
              <img src="images/no-image.jpg">
            </div>
            <div class="card col s10">
              <div class="card-content v-comment-card">
                <p class="card-title v-comment-name">{{$comment->user->username}}</p>
                <p>{{$comment->comment}}</p>
              </div>
            </div>  
          </div>
        @endforeach  
      </div>
      
    </div>
  </div>
</div><!-- row -->
@endsection

@section('scripts')
  <script type="text/javascript" src="{{asset('js/create-comment.js')}}"></script>
@endsection