@extends('common.layout')
@section('content')
<div>
  <script type="text/javascript">
    function clearFields() {
      document.getElementById("title").value = ""
      document.getElementById("description").value = ""
      document.getElementById("status").checked = ""
    }
  </script>
  <h2>Edit Post</h2>
  <form action="{{ route('posts#update',$post->id) }}" class="form" method="POST">
    @csrf
    <div class="form-group row">
      <div class="col-sm-10">
        <input type="hidden" name="id" class="text-input form-control" placeholder="Title" value="{{$post->id}}">
      </div>
    </div>
    <div class="form-group row {{ $errors->has('title') ? ' has-error' : '' }}">
      <label for="title" class="col-sm-2 col-form-label">Title</label>
      <div class="col-sm-10">
        <input type="text" name="title" class="text-input form-control" id="title" placeholder="Title" value="{{$post->title}}">
        <small class="text-danger">{{ $errors->first('title') }}</small>
      </div>
    </div>
    <div class="form-group row {{ $errors->has('description') ? ' has-error' : '' }}">
      <label for="description" class="col-sm-2 col-form-label">Description</label>
      <div class="col-sm-10">
        <textarea name="description" class="form-control" id="description" placeholder="Description">{{$post->description}}</textarea>
        <small class="text-danger">{{ $errors->first('description') }}</small>
      </div>
    </div>
    <div class="form-group row">
      <label for="description" class="col-sm-2 col-form-label">Status</label>
      <div class="col-sm-10">
        <label class="switch">
          <input type="checkbox" id="status" name="status" {{$post->status=='1'?'checked':''}}>
          <span class="slider round"></span>
        </label>
      </div>
    </div>
    <div class="form-group">
      <input type="submit" name="submit" class="btn btn-info btn-md" value="Confirm">
      <button type="button" class="btn btn-primary" onclick="clearFields()">Clear</button>
    </div>
  </form>
  @endsection