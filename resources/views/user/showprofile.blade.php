@extends('posts.layout')
@section('content')
<div>
  <h2>User Profile</h2>
  <form action="" class="form" method="POST">
    @csrf
    <div>
    <div class="form-group row">
    <a  href="{{ route('user#editprofile',$currentuser->id) }}" class="text-info">Edit</a>
        <label for="fileimg" class="col-sm-2 col-form-label"></label>
        <div class="col-sm-10 profile_img">
        <img  name ="img" src="{{$currentuser->profile}}" />
        <input type="hidden" name="image" class="text-input form-control" placeholder="Title" value="">
        <!-- <input type="hidden" name="id" class="text-input form-control" placeholder="id" value="{{$currentuser->id}}"> -->
        </div>
      </div>
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} row">
        <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
          <input type="text" name="name" readonly  class="form-control-plaintext" id="title" value="{{$currentuser->name}}">
        </div>
        <small class="text-danger">{{ $errors->first('name') }}</small>
      </div>
      <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email Address</label>
        <div class="col-sm-10">
          <input type="text" name="email" readonly class="form-control-plaintext" id="email" value="{{$currentuser->email}}">
        </div>
      </div>
      <div class="form-group row">
        <label for="usertype" class="col-sm-2 col-form-label">Type</label>
        <div class="col-sm-10">
        <input type="text" name="usertype" readonly class="form-control-plaintext" id="usertype" value="{{$currentuser->type='0'?'Admin':'User'}}">
        </div>
      </div>
      <div class="form-group row">
        <label for="phone" class="col-sm-2 col-form-label">Phone</label>
        <div class="col-sm-10">
          <input type="phone" name="phone" readonly class="form-control-plaintext" id="phone" value="{{$currentuser->phone}}">
        </div>
      </div>
      <div class="form-group row">
        <label for="date" class="col-sm-2 col-form-label">Date Of Birth</label>
        <div class="col-sm-10">
        <input type="text" name="dob" readonly class="form-control-plaintext" id="dob" value="{{$currentuser->dob}}">
        </div>
      </div>
      <div class="form-group row">
        <label for="address" class="col-sm-2 col-form-label">Address</label>
        <div class="col-sm-10">
        <input type="text" name="description" readonly class="form-control-plaintext" value="{{$currentuser->address}}">
        </div>
      </div>
      <div>
  </form>
  @endsection