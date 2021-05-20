@extends('common.layout')
@section('content')
<div>
  <h2>Create User</h2>
  <form action="" class="form" method="POST">
    @csrf
    <div class="form-group row">
      <label for="name" class="col-sm-2 col-form-label">Name</label>
      <div class="col-sm-10">
        <input type="text" name="name" class="text-input form-control" id="title" placeholder="Name">
      </div>
    </div>
    <div class="form-group row">
      <label for="email" class="col-sm-2 col-form-label">Email Address</label>
      <div class="col-sm-10">
      <input type="text" name="email" class="text-input form-control" id="email" placeholder="Email Address">
          <!-- <textarea name="email" class="form-control" id="description" placeholder="Email Address"></textarea> -->
      </div>
    </div>
    <div class="form-group row">
      <label for="password" class="col-sm-2 col-form-label">Password</label>
      <div class="col-sm-10">
        <input type="password" name="password" class="text-input form-control" id="password" placeholder="Password">
      </div>
    </div>
    <div class="form-group row">
      <label for="confirmpassword" class="col-sm-2 col-form-label">ConfirmPassword</label>
      <div class="col-sm-10">
        <input type="password" name="confirmpassword" class="text-input form-control" id="confirmpassword" placeholder="ConfirmPassword">
      </div>
    </div>
    <div class="form-group row">
      <label for="type" class="col-sm-2 col-form-label">Type</label>
      <div class="col-sm-10">
        <input type="type" name="confirmpassword" class="text-input form-control" id="type" placeholder="ConfirmPassword">
      </div>
    </div>
    <div class="form-group row">
      <label for="phone" class="col-sm-2 col-form-label">Phone</label>
      <div class="col-sm-10">
        <input type="test" name="phone" class="text-input form-control" id="phone" placeholder="Phone">
      </div>
    </div>
    <div class="form-group row">
      <label for="dob" class="col-sm-2 col-form-label">Date Of Birth</label>
      <div class="col-sm-10">
        <input type="text" name="dob" class="text-input form-control" id="dob" placeholder="Date Of Birth">
      </div>
    </div>
    <div class="form-group row">
      <label for="address" class="col-sm-2 col-form-label">Address</label>
      <div class="col-sm-10">
          <textarea name="address" class="form-control" id="address" placeholder="Address"></textarea>
      </div>
    </div>
    <div class="form-group row">
      <label for="profile" class="col-sm-2 col-form-label">Profile</label>
      <div class="col-sm-10">
        <input type="text" name="profile" class="text-input form-control" id="profile" placeholder="Profile">
      </div>
    </div>

    <div class="form-group">
      <input type="submit" name="submit" class="btn btn-info btn-md" value="Confirm">
      <button type="button" class="btn btn-primary" onclick="clearFields()">Clear</button>
    </div>
  </form>
</div>
@endsection