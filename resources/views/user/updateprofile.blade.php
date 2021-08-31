@extends('common.layout')
@section('content')
<div class="user-create">
<script type="text/javascript">
    function clearFields() {
      document.getElementById("name").value = ""
      document.getElementById("email").value = ""
      document.getElementById("usertype").value = ""
      document.getElementById("phone").value = ""
      document.getElementById("datepicker1").value = ""
      document.getElementById("address").value = ""
      document.getElementById("blah").src = ""
      document.getElementById("profileimg").src = ""
      
    }
  </script>
  <h2>Update User</h2>
  <form action="{{ route('users#profileconfirm') }}" class="form" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="profile_img">
      <img name="img" id="profileimg" src="{{$user->profile}}" />
      <input type="hidden" name="id" class="text-input form-control" placeholder="id" value="{{$user->id}}">
      <div>
      </div>
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} row">
        <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
          <input type="text" name="name" class="text-input form-control" id="name" placeholder="Name" value="{{$user->name}}">
          <small class="text-danger">{{ $errors->first('name') }}</small>
        </div>
      </div>
      <div class="form-group row {{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="col-sm-2 col-form-label">Email Address</label>
        <div class="col-sm-10">
          <input type="text" name="email" class="text-input form-control" id="email" placeholder="Email Address" value="{{$user->email}}">
          <small class="text-danger">{{ $errors->first('email') }}</small>
        </div>
      </div>
      <div class="form-group row">
        <label for="type" class="col-sm-2 col-form-label">Type</label>
        <div class="col-sm-10">
          <select name="usertype" id="usertype" class="form-control">
            <option value="Admin" {{ (isset($user->type)&& $user->type=='0')?'selected':''}}>Admin</option>
            <option value="User" {{ (isset($user->type)&& $user->type=='1')?'selected':''}}>User</option>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label for="phone" class="col-sm-2 col-form-label">Phone</label>
        <div class="col-sm-10">
          <input type="phone" name="phone" class="text-input form-control" id="phone" placeholder="Phone" value="{{$user->phone}}">
        </div>
      </div>
      <div class="form-group row">
        <label for="dob" class="col-sm-2 col-form-label">Date Of Birth</label>
        <div class="col-sm-10">
          <input type="date" name='date' class="form-control" id="datepicker1" value="{{$user->dob}}">
        </div>
      </div>
      <div class="form-group row">
        <label for="address" class="col-sm-2 col-form-label">Address</label>
        <div class="col-sm-10">
          <textarea name="address" class="form-control" id="address" placeholder="Address">{{$user->address}}</textarea>
        </div>
      </div>
      <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }} row">
        <label for="address" class="col-sm-2 col-form-label">Profile</label>
        <div class="col-sm-10 profile_img">
          <!-- <input type="file" name="image" class="form-control"> -->
          <input type="file" name="image" accept="image/*" id="imgInp" /><br>
          <small class="text-danger">{{ $errors->first('image') }}</small>
          <img name="showimg" id="blah" src="#" alt="your image" />
        </div>
      </div>
      <div class="change-password">
        <a href="{{ route('user#changepassword',$user->id) }}">Change password</a>
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