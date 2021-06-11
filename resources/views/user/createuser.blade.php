@extends('common.layout')
@section('content')
<div class="user-create">
  <h2>Create User KKKKKKKKKKKKK</h2>
  <form action="{{ route('users#confirm') }}" class="form" method="POST">
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
        <select class="form-select" aria-label="Default select example">
          <option selected>Admin</option>
          <option value="1">User</option>
        </select>
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
        <input type="date" class="form-control" id="datepicker1">
      </div>
    </div>
    <div class="form-group row">
      <label for="address" class="col-sm-2 col-form-label">Address</label>
      <div class="col-sm-10">
        <textarea name="address" class="form-control" id="address" placeholder="Address"></textarea>
      </div>
    </div>
    <div class="ml-2 col-sm-6">
      <img src="https://placehold.it/80x80" id="preview" class="img-thumbnail">
    </div>
</div>
</div>

<div class="form-group">
  <input type="submit" name="submit" class="btn btn-info btn-md" value="Confirm">
  <button type="button" class="btn btn-primary" onclick="clearFields()">Clear</button>
</div>
</form>
</div>
<script>
  $(document).on("click", ".browse", function() {
    var file = $(this).parents().find(".file");
    file.trigger("click");
  });
  $('input[type="file"]').change(function(e) {
    var fileName = e.target.files[0].name;
    $("#file").val(fileName);

    var reader = new FileReader();
    reader.onload = function(e) {
      // get loaded data and render thumbnail.
      document.getElementById("preview").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
  });
</script>
@endsection