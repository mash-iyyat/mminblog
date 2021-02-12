@extends('layouts.app')

@section('content')
<nav class="grey darken-4" style="margin-bottom:50px;">
  <a class="brand-logo center">Settings</a>
</nav>

<div class="row">
  <div class="col l4 offset-l4 m8 offset-m2 s10 offset-s1">
    <ul class="collection">
      <li class="collection-item">
        <div class="file-field input-field">
          <div class="btn btn-flat waves-effect waves-light blue lighten-1 white-text">
            <span><i class="fa fa-image"></i></span>
            <input type="file">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text" placeholder="Choose image from your computer..." disabled>
          </div>
        </div>
      </li>
      <li class="collection-item">
        <button class="max-width btn btn-flat blue lighten-1 waves-effect waves-light white-text" id="reset-password-btn">
          Password reset
        </button>
      </li>
      <form id="update-account-form">
        {{ @csrf_field() }}
        <li class="collection-item">
          <div class="input-field">
            <input type="text" name="firstname" id="firstname" value="{{Auth::user()->firstname}}">
            <label for="firstname" class="active"><i class="fa fa-pencil"></i> Firstname</label>
          </div>
        </li>
        <li class="collection-item">
          <div class="input-field">
            <input type="text" name="lastname" id="lastname" value="{{Auth::user()->lastname}}">
            <label for="lastname" class="active"><i class="fa fa-pencil"></i> Lastname</label>
          </div>
        </li>
        <li class="collection-item">
          <div class="input-field">
            <input type="text" name="username" id="username" value="{{Auth::user()->username}}">
            <label for="username" class="active"><i class="fa fa-pencil"></i> Username</label>
          </div>
        </li>
        <li class="collection-item">
          <div class="input-field">
            <input type="email" name="email" id="email" value="{{Auth::user()->email}}">
            <label for="email" class="active"><i class="fa fa-pencil"></i> Email</label>
          </div>
        </li>
        <li class="collection-item">
          <button class="btn btn-flat blue lighten-1 waves-effect waves-light white-text" style="width:100%">
            Save changes
          </button>
        </li>
      </form>
    </ul>  
  </div>
</div>
<!-- =====================ROW================ -->

@endsection

@section('scripts')
	<script type="text/javascript" src="{{asset('js/update-account.js')}}"></script>
@endsection