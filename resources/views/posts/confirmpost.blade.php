@extends('posts.layout')
@section('content')
<div>
  <h2>Create Post</h2>
  <form class="confirm" id="confirm" action="{{ route('posts#store') }}" method="POST">
    @csrf
    <div class="form-group row">
      <label for="title" class="col-sm-2 col-form-label">Title</label>
      <div class="col-sm-10">
        <input type="text" name="title" readonly class="form-control-plaintext" value="{{$confirmposts->title}}">
      </div>
    </div>
    <div class="form-group row">
      <label for="description" class="col-sm-2 col-form-label">Description</label>
      <div class="col-sm-10">
        <input type="text" name="description" readonly class="form-control-plaintext" value="{{$confirmposts->description}}">
      </div>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-primary">Create</button>
      <button type="button" class="btn btn-primary" onclick="window.location='{{ url("posts/create") }}'">Cancel</button>
    </div>
  </form>
  @endsection