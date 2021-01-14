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
	        	@error('firstname')
	        	<div class="chip red darken-1 white-text">
					    {{ $message }}
					  </div>
	        	@enderror
	          <div class="input-field">
	            <input id="firstname" type="text" name="firstname" class="validate" value="{{ old('firstname') }}">
	            <label for="firstname">Firstname</label>
	          </div>
	          @error('lastname')
	        	<div class="chip red darken-1 white-text">
					    {{ $message }}
					  </div>
	        	@enderror
	          <div class="input-field">
	            <input id="lastname" type="text" name="lastname" class="validate" value="{{ old('lastname') }}">
	            <label for="lastname">Lastname</label>
	          </div>
	          @error('username')
	        	<div class="chip red darken-1 white-text">
					    {{ $message }}
					  </div>
	        	@enderror
	          <div class="input-field">
	            <input id="username" type="text" name="username" class="validate" value="{{ old('username') }}">
	            <label for="username">Username</label>
	          </div>
	          @error('email')
	        	<div class="chip red darken-1 white-text">
					    {{ $message }}
					  </div>
	        	@enderror
	          <div class="input-field">
	            <input id="email" type="email" name="email" class="validate" value="{{ old('email') }}">
	            <label for="email">Email</label>
	          </div>
	          @error('password')
	        	<div class="chip red darken-1 white-text">
					    {{ $message }}
					  </div>
	        	@enderror
	          <div class="input-field">
	            <input id="password" type="password" name="password" class="validate">
	            <label for="password">Password</label>
	          </div>
	          @error('password_confirmation')
	        	<div class="chip red darken-1 white-text">
					    {{ $message }}
					  </div>
	        	@enderror
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