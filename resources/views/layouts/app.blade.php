<!DOCTYPE html>
<html>
<head>
	<title>MashMinBlogs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/css/materialize.min.css">
	<link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/css/app.css">
	@yield('css')
</head>
<body>
	<nav class="blue lighten-1">
	  <div class="nav-wrapper container">
	    <a href="{{route('index')}}" class="brand-logo">MashMinBlogs</a>
	    <a href="#" data-activates="mobile-demo" class="button-collapse">
	    	<i class="fa fa-bars" aria-hidden="true"></i>
	    </a>
	    <ul class="right hide-on-med-and-down">
	      <li><a href="{{route('blogs')}}" class="waves-effect">Blogs</a></li>
	      @auth
	      <li><a href="{{route('profile')}}" class="waves-effect">
	      	<i class="fa fa-user"></i>
	      </a></li>
	      <li>
          <a class="dropdown-item" onclick="logout()">
              {{ __('Logout') }}
          </a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
	      @endauth

	      @guest
	      <li><a href="{{route('login')}}" class="waves-effect">Login</a></li>
	      @endguest
	    </ul>
	    <ul class="side-nav" id="mobile-demo">
	      <li><a href="{{route('blogs')}}" class="waves-effect">Blogs</a></li>
	      @auth
	      <li><a href="{{route('profile')}}" class="waves-effect">{{auth()->user()->username}}</a></li>
	      <li>
          <a class="dropdown-item" onclick="logout()">
              {{ __('Logout') }}
          </a>
        </li>
	      @endauth

	      @guest
	      <li><a href="{{route('login')}}" class="waves-effect">Login</a></li>
	      @endguest
	  </div>
	</nav>
	@yield('content')
</body>
	<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="/js/materialize.min.js"></script>
  <script type="text/javascript" src="/js/mmin.js"></script>
  <script type="text/javascript" src="/js/sweetalert.min.js"></script>
 	<script>
 		function logout() {
 			swal({
		    title: "Are you sure ?",
		    icon: "warning",
		    buttons: true,
		    dangerMode: true
		  }).then((willLogout) => {
		  	if (willLogout) {
			  	$('#logout-form').submit();
		  	}/* if user clicks delete */
		  });
 		}
 	</script>
	@yield('scripts')
</html>