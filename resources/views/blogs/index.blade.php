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
    <h3 class="blog-header">Recent blogs</h3>
    <div id="macy-container">
    	@foreach($blogs as $blog)
	  		<div class="col">
	        <a href="viewblog.html" class="blog-cards">
	          <div class="card">
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
      
      <!-- <div class="col">
        <a href="viewblog.html" class="blog-cards">
          <div class="card">
            <div class="card-image">
              <img src="images/005.png">
            </div>
            <div class="card-content">
              <p>By The Real Emiya Page</p>
              <p class="posted-at">Posted 7 weeks</p>
              <p class="card-blog-title">Saan ako makakakuha?</p>
              <p class="blog-content">Ang Lorem Ipsum ay ginagamit na modelo ng industriya ng pagpriprint at pagtytypeset.</p>
            </div>
          </div>  
        </a>
      </div>  --> 
      <button class="btn-flat btn green white-text waves-effect">View more</button>
    </div>
  </div>
</div><!-- row -->
@endsection