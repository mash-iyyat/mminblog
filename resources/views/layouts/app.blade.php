<!DOCTYPE html>
<html>
<head>
	<title>MashMin</title>
	<link rel="stylesheet" type="text/css" href="/css/materialize.min.css">
	<link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/css/app.css">
	@yield('css')
</head>
<body>
	<nav class="deep-purple lighten-1">
	  <div class="nav-wrapper container">
	    <a href="{{route('index')}}" class="brand-logo">MashMin</a>
	    <a href="#" data-activates="mobile-demo" class="button-collapse">
	    	<i class="fa fa-bars" aria-hidden="true"></i>
	    </a>
	    <ul class="right hide-on-med-and-down">
	      <li><a href="{{route('blogs')}}" class="waves-effect">Blogs</a></li>
	      <li><a href="gallery.html" class="waves-effect">Gallery</a></li>
	      @auth
	      <li><a href="{{route('profile')}}" class="waves-effect">
	      	<i class="fa fa-user"></i>
	      </a></li>
	      <li>
          <a class="dropdown-item" href="{{ route('logout') }}"
             onclick="event.preventDefault();document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
          </a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
	      @endauth

	      @guest
	      <li><a href="{{route('login')}}" class="waves-effect">Login</a></li>
	      <li><a href="{{route('register')}}" class="waves-effect">Join me?</a></li>
	      @endguest
	    </ul>
	    <ul class="side-nav" id="mobile-demo">
	      <li><a href="{{route('blogs')}}" class="waves-effect">Blogs</a></li>
	      <li><a href="gallery.html" class="waves-effect">Gallery</a></li>
	      @auth
	      <li><a href="{{route('profile')}}" class="waves-effect">{{auth()->user()->username}}</a></li>
	      <li>
          <a class="dropdown-item" href="{{ route('logout') }}"
             onclick="event.preventDefault();document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
          </a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
	      @endauth

	      @guest
	      <li><a href="{{route('login')}}" class="waves-effect">Login</a></li>
	      <li><a href="{{route('register')}}" class="waves-effect">Join me?</a></li>
	      @endguest
	  </div>
	</nav>
	@yield('content')
</body>
	<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="/js/materialize.min.js"></script>
  <script type="text/javascript" src="/js/mmin.js"></script>
  <script type="text/javascript" src="/js/sweetalert.min.js"></script>
	@yield('scripts')
</html>