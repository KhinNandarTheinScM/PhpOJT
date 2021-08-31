@extends('posts.layout')
@section('content')
<div>
  <script type="text/javascript">
    function clearFields() {
      document.getElementById("title").value = ""
      document.getElementById("description").value = ""
    }
  </script>
  <h2>Create Post</h2>
  <form action="{{ route('posts#confirm') }}" class="form" method="POST">
    @csrf
    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }} row">
      <label for="title" class="col-sm-2 col-form-label">Title</label>
      <div class="col-sm-10">
        <input type="text" name="title" class="text-input form-control" id="title" placeholder="Title" value="{{old('title')}}">
        <small class="text-danger">{{ $errors->first('title') }}</small>
      </div>
    </div>
    <!-- Div Close -->
    <div class="form-group row {{ $errors->has('description') ? ' has-error' : '' }}">
      <label for="description" class="col-sm-2 col-form-label">Description</label>
      <div class="col-sm-10">
          <textarea name="description" class="form-control" id="description" placeholder="Description">{{old('description')}}</textarea>
          <small class="text-danger">{{ $errors->first('description') }}</small>
      </div>
    </div>
    <div class="form-group">
      <input type="submit" name="submit" class="btn btn-info btn-md" value="Confirm">
      <button type="button" class="btn btn-primary" onclick="clearFields()">Clear</button>
    </div>
  </form>
  @endsection