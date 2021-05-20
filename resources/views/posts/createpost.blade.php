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
    <div class="form-group row">
      <label for="title" class="col-sm-2 col-form-label">Title</label>
      <div class="col-sm-10">
        <input type="text" name="title" class="text-input form-control" id="title" placeholder="Title" value="{{$title}}">
      </div>
    </div>
    <div class="form-group row">
      <label for="description" class="col-sm-2 col-form-label">Description</label>
      <div class="col-sm-10">
          <textarea name="description" class="form-control" id="description" placeholder="Description">{{$description}}</textarea>
      </div>
    </div>
    <div class="form-group">
      <input type="submit" name="submit" class="btn btn-info btn-md" value="Confirm">
      <button type="button" class="btn btn-primary" onclick="clearFields()">Clear</button>
    </div>
  </form>
  @endsection