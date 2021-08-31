@extends('common.layout')
@section('content')
<div class="user-create">
  <script type="text/javascript">
    function clearFields() {

      document.getElementById("name").value = ""
      document.getElementById("email").value = ""
      document.getElementById("password").value = ""
      document.getElementById("confirmpassword").value = ""
      document.getElementById("usertype").value = ""
      document.getElementById("phone").value = ""
      document.getElementById("datepicker1").value = ""
      document.getElementById("address").value = ""
      document.getElementById("imgInp").value = ""
      document.getElementById("blah").src = ""
    }
  </script>
  <h2>Create User</h2>
  <form action="{{ route('users#confirm') }}" class="form" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} row">
        <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
          <input type="text" name="name" class="text-input form-control" id="name" placeholder="Name" value="{{old('name')}}">
          <small class="text-danger">{{ $errors->first('name') }}</small>
        </div>
      </div>
      <div class="form-group row {{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="col-sm-2 col-form-label">Email Address</label>
        <div class="col-sm-10">
          <input type="text" name="email" class="text-input form-control" id="email" placeholder="Email Address" value="{{old('email')}}">
          <small class="text-danger">{{ $errors->first('email') }}</small>
        </div>
        <!-- <small class="text-danger">{{ $errors->first('email') }}</small> -->
      </div>
      <div class="form-group row {{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
          <input type="password" name="password" class="text-input form-control" id="password" placeholder="Password" value="{{old('password')}}">
          <small class="text-danger">{{ $errors->first('password') }}</small>
        </div>
        <!-- <small class="text-danger">{{ $errors->first('password') }}</small> -->
      </div>
      <div class="form-group row {{ $errors->has('confirmpassword') ? ' has-error' : '' }}">
        <label for="confirmpassword" class="col-sm-2 col-form-label">ConfirmPassword</label>
        <div class="col-sm-10">
          <input type="password" name="confirmpassword" class="text-input form-control" id="confirmpassword" placeholder="ConfirmPassword" value="{{old('confirmpassword')}}">
          <small class="text-danger">{{ $errors->first('confirmpassword') }}</small>
        </div>
        <!-- <small class="text-danger">{{ $errors->first('confirmpassword') }}</small> -->
      </div>
      <div class="form-group row">
        <label for="type" class="col-sm-2 col-form-label">Type</label>
        <div class="col-sm-10">
        <select class="form-control" id="usertype" name="usertype">
          <option>Select One</option>
          <option value="Admin" {{ old('usertype') == 'Admin' ? 'selected="selected"' : '' }}>Admin</option>
          <option value="User" {{ old('usertype') == 'User' ? 'selected="selected"' : '' }}>User</option>
      </select>
          <!-- <select name="usertype" id="usertype" class="form-control">
            <option value="Admin" {{ (isset($usertype)&& old('usertype')=='Admin')?'selected':''}}>Admin</option>
            <option value="User" {{ (isset($usertype)&& old('usertype')=='User')?'selected':''}}>User</option>
          </select> -->
        </div>
      </div>
      <div class="form-group row">
        <label for="phone" class="col-sm-2 col-form-label">Phone</label>
        <div class="col-sm-10">
          <input type="phone" name="phone" class="text-input form-control" id="phone" placeholder="Phone" value="{{old('phone')}}">
        </div>
      </div>
      <div class="form-group row">
        <label for="dob" class="col-sm-2 col-form-label">Date Of Birth</label>
        <div class="col-sm-10">
          <input type="date" name='date' class="form-control" id="datepicker1" value="{{old('date')}}">
        </div>
      </div>
      <div class="form-group row">
        <label for="address" class="col-sm-2 col-form-label">Address</label>
        <div class="col-sm-10">
          <textarea name="address" class="form-control" id="address" placeholder="Address">{{old('address')}}</textarea>
        </div>
      </div>
      <div class="form-group row">
        <label for="address" class="col-sm-2 col-form-label">Profile</label>
        <div class="col-sm-10 profile_img">
          <!-- <input type="file" name="image" class="form-control"> -->
          <input type="file" name="image" accept="image/*" id="imgInp" /><br><br>
          <img name="showimg" id="blah" src="#" alt="your image" />
        </div>
      </div>
      <div class="form-group">
        <input type="submit" name="submituser" class="btn btn-info btn-md" value="Confirm">
        <button type="button" class="btn btn-primary" onclick="clearFields()">Clear</button>
      </div>
      <div>
  </form>
</div>
<script>
  imgInp.onchange = evt => {
    const [file] = imgInp.files
    if (file) {
      blah.src = URL.createObjectURL(file)
    }
  }
</script>
@endsection