@extends('posts.layout')
@section('content')
<div>
    <h2>Update User Confirmation</h2>
    <form action="{{ route('users#confirmprofileupdate') }}" class="form" method="POST">
        @csrf
        <div>
            <div class="form-group row">
                <label for="fileimg" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10 profile_img">
                <img name="img" src="{{$confirmuserprofile->path}}" />
                    <!-- <img name="img" src="{{ URL::to('/images/' . $confirmuserprofile->path) }}" /> -->
                    <input type="hidden" name="image" class="text-input form-control" placeholder="Title" value="{{$confirmuserprofile->path}}">
                </div>
            </div>
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" name="name" readonly class="form-control-plaintext" id="title" value="{{$confirmuserprofile->name}}">
                </div>
                <small class="text-danger">{{ $errors->first('name') }}</small>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email Address</label>
                <div class="col-sm-10">
                    <input type="text" name="email" readonly class="form-control-plaintext" id="email" value="{{$confirmuserprofile->email}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="usertype" class="col-sm-2 col-form-label">Type</label>
                <div class="col-sm-10">
                    <input type="text" name="usertype" readonly class="form-control-plaintext" id="usertype" value="{{$confirmuserprofile->usertype}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                <div class="col-sm-10">
                    <input type="phone" name="phone" readonly class="form-control-plaintext" id="phone" value="{{$confirmuserprofile->phone}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="date" class="col-sm-2 col-form-label">Date Of Birth</label>
                <div class="col-sm-10">
                    <input type="text" name="dob" readonly class="form-control-plaintext" id="dob" value="{{$confirmuserprofile->date}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="address" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-10">
                    <input type="text" name="description" readonly class="form-control-plaintext" value="{{$confirmuserprofile->address}}">
                    <!-- <textarea name="address" readonly class="form-control-plaintext" id="address">"{{$confirmuserprofile->date}}"</textarea> -->
                </div>
            </div>
            <div class="form-group">
                <input type="submit" name="submituser" class="btn btn-info btn-md" value="Update">
                <button type="button" class="btn btn-primary" onclick="window.location='{{ url("users/create") }}'">Cancel</button>
                <!-- <button type="button" class="btn btn-primary" onclick="clearFields()">Clear</button> -->
            </div>
            <div>
    </form>
    @endsection