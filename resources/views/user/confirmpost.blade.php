@extends('posts.layout')
@section('content')
<div>
  <h2>Create User Confirmation</h2>
  <form action="{{ route('users#store') }}" class="form" method="POST">
    @csrf
    <div>
    <div class="form-group row">
        <label for="fileimg" class="col-sm-2 col-form-label"></label>
        <div class="col-sm-10 profile_img">
        <!-- <img src={{ url('/images/'. $confirusers->path) }}/> -->
        <img  name ="img" src="{{ URL::to('/images/' . $confirusers->path) }}" />
        <input type="hidden" name="image" class="text-input form-control" placeholder="Title" value="{{URL::to('/images/' . $confirusers->path)}}">
        </div>
      </div>
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} row">
        <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
          <input type="text" name="name" readonly  class="form-control-plaintext" id="title" value="{{$confirusers->name}}">
        </div>
        <small class="text-danger">{{ $errors->first('name') }}</small>
      </div>
      <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email Address</label>
        <div class="col-sm-10">
          <input type="text" name="email" readonly class="form-control-plaintext" id="email" value="{{$confirusers->email}}">
        </div>
      </div>
      <div class="form-group row">
        <label for="password" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
          <input type="password" name="password" readonly class="form-control-plaintext" id="password" value="{{$confirusers->password}}">
        </div>
      </div>
      <!-- <div class="form-group row">
        <label for="confirmpassword" class="col-sm-2 col-form-label">ConfirmPassword</label>
        <div class="col-sm-10">
          <input type="password" name="confirmpassword" class="form-control-plaintext" id="confirmpassword" placeholder="ConfirmPassword">
        </div>
      </div> -->
      <div class="form-group row">
        <label for="usertype" class="col-sm-2 col-form-label">Type</label>
        <div class="col-sm-10">
        <input type="text" name="usertype" readonly class="form-control-plaintext" id="usertype" value="{{$confirusers->usertype}}">
        </div>
      </div>
      <div class="form-group row">
        <label for="phone" class="col-sm-2 col-form-label">Phone</label>
        <div class="col-sm-10">
          <input type="phone" name="phone" readonly class="form-control-plaintext" id="phone" value="{{$confirusers->phone}}">
        </div>
      </div>
      <div class="form-group row">
        <label for="date" class="col-sm-2 col-form-label">Date Of Birth</label>
        <div class="col-sm-10">
        <input type="text" name="dob" readonly class="form-control-plaintext" id="dob" value="{{$confirusers->date}}">
        </div>
      </div>
      <div class="form-group row">
        <label for="address" class="col-sm-2 col-form-label">Address</label>
        <div class="col-sm-10">
        <input type="text" name="description" readonly class="form-control-plaintext" value="{{$confirusers->address}}">
          <!-- <textarea name="address" readonly class="form-control-plaintext" id="address">"{{$confirusers->date}}"</textarea> -->
        </div>
      </div>
      <div class="form-group">
        <input type="submit" name="submituser" class="btn btn-info btn-md" value="Create">
        <button type="button" class="btn btn-primary" onclick="window.location='{{ url("users/create") }}'">Cancel</button>
        <!-- <button type="button" class="btn btn-primary" onclick="clearFields()">Clear</button> -->
      </div>
      <div>
  </form>
  @endsection