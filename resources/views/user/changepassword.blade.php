@extends('common.layout')
@section('content')
<div class="user-create">
    <script type="text/javascript">
        function clearFields() {
            document.getElementById("oldpassword").value = ""
            document.getElementById("newpassword").value = ""
            document.getElementById("confirmpassword").value = ""
        }
    </script>
    <h2>Create User</h2>
    <form action="{{ route('changepassword#change',$user->id) }}" class="form" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
        <div class="form-group row {{ $errors->has('oldpassword') ? ' has-error' : '' }}">
                <label for="oldpassword" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                <input type="hidden" name="id" class="text-input form-control" placeholder="Title" value="{{$user->id}}">
                    <input type="password" name="oldpassword" class="text-input form-control" id="oldpassword" placeholder="Old Password" value="{{$user->password}}">
                    <small class="text-danger">{{ $errors->first('oldpassword') }}</small>
                </div>
                <!-- <small class="text-danger">{{ $errors->first('password') }}</small> -->
            </div>
            <div class="form-group row {{ $errors->has('newpassword') ? ' has-error' : '' }}">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" name="newpassword" class="text-input form-control" id="newpassword" placeholder="New Password">
                    <small class="text-danger">{{ $errors->first('newpassword') }}</small>
                </div>
                <!-- <small class="text-danger">{{ $errors->first('password') }}</small> -->
            </div>
            <div class="form-group row {{ $errors->has('confirmpassword') ? ' has-error' : '' }}">
                <label for="confirmpassword" class="col-sm-2 col-form-label">ConfirmPassword</label>
                <div class="col-sm-10">
                    <input type="password" name="confirmpassword" class="text-input form-control" id="confirmpassword" placeholder="ConfirmPassword">
                    <small class="text-danger">{{ $errors->first('confirmpassword') }}</small>
                </div>
                <!-- <small class="text-danger">{{ $errors->first('confirmpassword') }}</small> -->
            </div>
            <div class="form-group">
                <input type="submit" name="submituser" class="btn btn-info btn-md" value="Change">
                <button type="button" class="btn btn-primary" onclick="clearFields()">Clear</button>
            </div>
            <div>
    </form>
</div>

@endsection