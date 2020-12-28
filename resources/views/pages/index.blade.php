@extends('layouts.app')

@section('content')
  <div class="section" style="margin-top: 50px;">
    <div class="row container">
      <h2 class="header">Welcome to my blogpage</h2>
      <h5 class="grey-text text-darken-3 lighten-3">Please visit my <a href="{{route('blogs')}}">blogs</a>, enjoy! :></h5>
    </div>
  </div>

  <div class="section">
    <div class="row container">
      <div class="col s4" style="text-align: justify;">
      	<h4>Read Blogs</h4>
      	<p class="grey-text text-darken-3 lighten-3">
	      	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	      	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	      	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	      </p>
      </div>
      <div class="col s4" style="text-align: justify;">
      	<h4>Create Blogs</h4>
      	<p class="grey-text text-darken-3 lighten-3">
	      	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	      	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	      	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	      </p>
      </div>
      <div class="col s4" style="text-align: justify;">
      	<h4>View my Gallery</h4>
      	<p class="grey-text text-darken-3 lighten-3">
	      	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	      	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	      	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	      </p>
      </div>
    </div>
  </div>

  <footer class="page-footer deep-purple lighten-1">
	  <div class="container">
	    <div class="row">
	      <div class="col l6 s12">
	        <h5 class="white-text">Footer Content</h5>
	        <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
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
	    © 2020 MashMinBlog
	    </div>
	  </div>
	</footer>

@endsection