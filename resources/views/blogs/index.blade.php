@extends('layouts.app')

@section('content')
<nav class="grey darken-4">
  <a href="{{ route('blogs') }}" class="brand-logo center">Blogs</a>
</nav>
<div class="row blog container">
  <div class="col l5 hide-on-med-and-down">
    <form autocomplete="off">
      <div class="input-field">
        <label><i class="fa fa-search"></i> Search Blog</label>
        <input type="text" placeholder="Enter blog title..." name="blog">
      </div>
    </form>
    <ul class="collection with-header">
      <li class="collection-header"><h5>Pinned blogs</h5></li>
      <a href="" class="collection-item"><i class="fa fa-chevron-right"></i> Sample blogs</a>
      <a href="" class="collection-item"><i class="fa fa-chevron-right"></i> Sample blogs</a>
      <a href="" class="collection-item"><i class="fa fa-chevron-right"></i> Sample blogs</a>
      <a href="" class="collection-item"><i class="fa fa-chevron-right"></i> Sample blogs</a>
      <a href="" class="collection-item"><i class="fa fa-chevron-right"></i> Sample blogs</a>
    </ul>
  </div>
  <div class="col l7 m12 s12">
    <div class="blog-container">
      
    </div>

    <div class="center">
      <button class="btn-flat btn blue white-text waves-effect" id="view-more-btn" style="width: 80%">
        Load more
      </button>
    </div>
    
  </div>
</div><!-- row -->
@endsection


@section('scripts')
  <script type="text/javascript" src="{{ asset('js/blogs.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/searchblog.js') }}"></script>
@endsection