@extends('common.layout')
@section('content')
<div>
  <h2>Update Post Confirmation</h2>
  <form class="confirm" id="confirm" action="{{ route('posts#confirmupdate') }}" method="POST">
    @csrf
    <div class="form-group row">
      <div class="col-sm-10">
        <input type="hidden" name="id" class="text-input form-control" placeholder="Title" value="{{$posts->id}}">
      </div>
    </div>
    <div class="form-group row">
      <label for="title" class="col-sm-2 col-form-label">Title</label>
      <div class="col-sm-10">
        <input type="text" name="title" readonly class="form-control-plaintext" value="{{$posts->title}}">
      </div>
    </div>
    <div class="form-group row">
      <label for="description" class="col-sm-2 col-form-label">Description</label>
      <div class="col-sm-10">
        <input type="text" name="description" readonly class="form-control-plaintext" value="{{$posts->description}}">
      </div>
    </div>
    <div class="form-group row">
      <label for="description" class="col-sm-2 col-form-label">Status</label>
      <div class="col-sm-10">
        <label class="switch">
          <input type="checkbox" name="status" {{$posts->status=='on'?'checked':''}}>
          <span class="slider round"></span>
        </label>
      </div>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-primary">Update</button>
      <button class="btn btn-primary" type="button" onclick="window.location='{{ url()->previous() }}'">Cancel</button>
    </div>
  </form>
  @endsection