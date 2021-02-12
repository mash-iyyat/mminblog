@extends('layouts.app')

@section('content')
<nav class="grey darken-4">
  <!-- <a href="{{ route('blogs') }}" class="brand-logo center"></a> -->
</nav>

<div class="login-form row">
  <div class="col l4 offset-l4 m8 offset-m2 s12">
	<ul class="collection with-header">
	  <form method="POST" action="{{route('login')}}" autocomplete="off">
	    {{ @csrf_field() }}
	    @if(session('status'))
	    <li class="collection-item center red lighten-1 white-text invalid-credentials">
		  {{ session('status') }} 
		  <a class="secondary-content white-text" onclick="$('.invalid-credentials').remove()">
		    <span><i class="fa fa-times"></i></span>
		  </a>
		</li>
		@endif
		<li class="collection-header center">
		  <h4>Login</h4>
		</li>
		<li class="collection-item">
		  <div class="input-field">
		    <input id="email" type="email" name="email" class="validate" placeholder="Enter your email">
		    <label for="email"><i class="fa fa-envelope"></i> Email</label>
		  </div>
		</li>
		<li class="collection-item">
		  <div class="input-field">
		    <input id="password" type="password" name="password" class="validate" placeholder="Enter your password">
		    <label for="password"><i class="fa fa-lock"></i> Password</label>
		  </div>
		  <p>
		    <input type="checkbox" id="test5" name="remember_me" />
			<label for="test5">Remember me</label>
		  </p>
		</li>
		<li class="collection-item">
		  <button class="btn-flat blue darken-1 login-btn waves-effect waves-light" type="submit">
		    Login
		  </button>
		</li>
	  </form>
	</ul>
  </div>
</div>
@endsection