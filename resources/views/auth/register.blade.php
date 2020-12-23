@extends('layouts.app')

@section('content')

<div class="register-form row">
  <div class="col l4 offset-l4 m8 offset-m2 s10 offset-s1">
    <div class="card horizontal">
      <div class="card-stacked">
        <h2 class="header center">Register</h2>
        <form action="/register" method="POST">
        	{{csrf_field()}}
	        <div class="card-content">
	          <div class="input-field">
	            <input id="firstname" type="text" name="firstname" class="validate">
	            <label for="firstname">Firstname</label>
	          </div>
	          <div class="input-field">
	            <input id="lastname" type="text" name="lastname" class="validate">
	            <label for="lastname">Lastname</label>
	          </div>
	          <!-- <span class="error-msg">Username already taken</span> -->
	          <div class="input-field">
	            <input id="username" type="text" name="username" class="validate">
	            <label for="username">Username</label>
	          </div>
	          <div class="input-field">
	            <input id="email" type="email" name="email" class="validate">
	            <label for="email">Email</label>
	          </div>
	          <div class="input-field">
	            <input id="password" type="password" name="password" class="validate">
	            <label for="password">Password</label>
	          </div>
	          <div class="input-field">
	            <input id="password_confirmation" type="password" name="password_confirmation" class="validate">
	            <label for="password_confirmation">Confirm Password</label>
	          </div>
	        </div>
	        <div class="card-action">
	          <button class="btn-flat green darken-1 login-btn waves-effect waves-light" type="submit">
	            Register
	          </button>
	        </div>	
        </form>
      </div>
    </div>
  </div>
</div>

@endsection