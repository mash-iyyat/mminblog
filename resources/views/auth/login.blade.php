@extends('layouts.app')

@section('content')
<div class="login-form row">
  <div class="col l4 offset-l4 m8 offset-m2 s10 offset-s1">
    <div class="card horizontal">
      <div class="card-stacked">
        <h2 class="header center">Login</h2>
        <form method="POST" action="{{route('login')}}">
        	{{ @csrf_field() }}
	        <div class="card-content">
	          <div class="input-field">
	            <input id="email" type="email" name="email" class="validate">
	            <label for="email">Email</label>
	          </div>
	          <div class="input-field">
	            <input id="password" type="password" name="password" class="validate">
	            <label for="password">Password</label>
	          </div>
	          <p>
	            <input type="checkbox" id="remember_me" name="remember_me"/>
	            <label for="remember_me">Remember me</label>
	          </p>
	        </div>
	        <div class="card-action">
	          <button class="btn-flat blue darken-1 login-btn waves-effect waves-light" type="submit">
	            Login
	          </button>
	        </div>	
        </form>
        
      </div>
    </div>
  </div>
</div>
@endsection