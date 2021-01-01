@extends('layouts.app')

@section('content')
	<div class="center">
    <form id="update-account-form">
    	{{@csrf_field()}}
      <div class="row">
        <div class="input-field col s4 offset-s4">
        	<input type="text" name="firstname" id="firstname" value="{{Auth::user()->firstname}}">
          <label for="firstname" class="active">Firstname</label>
        </div>
        <div class="input-field col s4 offset-s4">
        	<input type="text" name="lastname" id="lastname" value="{{Auth::user()->lastname}}">
          <label for="lastname" class="active">Lastname</label>
        </div>
        <div class="input-field col s4 offset-s4">
        	<input type="text" name="username" id="username" value="{{Auth::user()->username}}">
          <label for="username" class="active">Username</label>
        </div>
        <div class="input-field col s4 offset-s4">
        	<input type="email" name="email" id="email" value="{{Auth::user()->email}}">
          <label for="email" class="active">Email</label>
        </div>
      </div>
      <button class="btn btn-flat green waves-effect waves-light white-text">Save</button>
      <a class="waves-effect waves-light btn modal-trigger btn btn-flat blue white-text" href="#profile">Change profile</a>
    </form>
	</div>

  

  <!-- Modal Structure -->
  <div id="profile" class="modal">
    <form id="update-profile-form">
      {{ @csrf_field() }}
      <div class="modal-content">
        <div class="image-container">
          <img src="/storage/images/profiles/{{auth()->user()->image}}" style="width: 200px;height: 200px;">
        </div>
        <div class="file-field input-field col s4 offset-s4">
          <div class="btn btn-flat blue waves-light waves-effect white-text">
            <span>Profile</span>
            <input type="file" name="image">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
          </div>
        </div>  
      </div>
      <div class="modal-footer">
        <button class="btn btn-flat green waves-effect waves-light white-text modal-action">
          Save Image
        </button>
      </div>
    </form>
  </div>
@endsection

@section('scripts')
	<script type="text/javascript" src="{{asset('js/update-account.js')}}"></script>
@endsection