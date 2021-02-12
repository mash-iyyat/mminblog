@extends('layouts.app')

@section('content')
<nav class="grey darken-4">
  <a href="{{ route('blogs') }}" class="brand-logo center">Blogs</a>
</nav>
  <div class="section" style="margin-top: 50px;">
    <div class="row container center">
	  <img src="{{ asset('images/cover.png') }}" class="cover-image">
      <h2 class="header">Welcome to my blogpage</h2>
    </div>
  </div>

  <footer class="page-footer deep-purple lighten-1">
	  <div class="container">
	    <div class="row">
	      <div class="col l6 s12">
	        <h5 class="white-text">MashMinBlog</h5>
	        <p class="grey-text text-lighten-4">This website is only made for research and case study purposes</p>
	      </div>
	      <div class="col l4 offset-l2 s12">
	        <h5 class="white-text">Links</h5>
	        <ul>
	          <li><a class="grey-text text-lighten-3" href="#!">Facebook</a></li>
	          <li><a class="grey-text text-lighten-3" href="#!">Twitter</a></li>
	          <li><a class="grey-text text-lighten-3" href="#!">Github</a></li>
	          <li><a class="grey-text text-lighten-3" href="#!">Pixiv</a></li>
	        </ul>
	      </div>
	    </div>
	  </div>
	  <div class="footer-copyright grey darken-4">
	    <div class="container">
	    © 2021 MashMinBlog
	    </div>
	  </div>
	</footer>

@endsection