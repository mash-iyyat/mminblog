@extends('layouts.app')

@section('content')
<div class="card blog-header">
  <div class="container">
    <h1>Blogs</h1>
  </div>
</div>
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
      @foreach($pinnedBlogs as $blog)
      <li class="collection-item avatar">
        <a>
          <a class="secondary-content"><i class="fa fa-bookmark"></i></a>
          <img src="{{asset('images/no-image.jpg')}}" alt="" class="circle">
          <a href="/blog/view={{$blog->id}}" class="top-blog-title">{{$blog->title}}</a>
          <p>
            {{$blog->user->username}} <br>
            {{$blog->created_at}}
          </p>  
        </a>
      </li>
      @endforeach
      
    </ul>

    <ul class="collection">
      <li class="collection-header">
        <p>Blog members</p>
      </li>
      @foreach($users as $user)
        <li class="collection-item avatar">
          <a href="#">
            <a href="#!" class="secondary-content"><i class="fa fa-trophy"></i></a>
            <img src="images/no-image.jpg" alt="" class="circle">
            <p class="top-blog-title">{{$user->username}}</p>
            <p>
              {{$user->blogs()->count()}} blogs
            </p>  
          </a>
        </li>
      @endforeach
    </ul>
  </div>

  <div class="col l6 s12 m12">
    <h3 class="blog-header">Recent blogs</h3>
    <div class="blog-container">
    	@foreach($blogs as $blog)
	  		<div class="col" id="blog-container-{{$blog->id}}">
          <a href="blog/view={{$blog->id}}" class="blog-cards" id="blog-card-{{$blog->id}}">
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
      <div id="appendHere">
        
      </div>
    </div>
    <button class="btn-flat btn green white-text waves-effect" id="view-more-btn">View more</button>
  </div>
</div><!-- row -->
@endsection


@section('scripts')
  <script type="text/javascript" src="{{ asset('js/viewmore.js') }}"></script>
@endsection