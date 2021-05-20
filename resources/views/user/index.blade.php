<!-- <table class="table table-striped">
    <thead>
        <tr>
            <td>Name</td>
            <td>Email</td>
            <td>Phone</td>
            <td colspan=2>Actions</td>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->phone}}</td>
            <td></td>
        </tr>
        @endforeach
    </tbody>
</table> -->
@extends('common.layout')
@section('content')
<h2>User List</h2>
<div class="content" id="user">
    <form class="form-inline user" action="">
    @csrf
        <div class="form-group">
            <input type="text" class="form-control" id="name" placeholder="
  Name">
            <input type="text" class="form-control" id="email" placeholder="
  Email">
            <input type="text" class="form-control" id="create-from" placeholder="
  Create From">
            <input type="text" class="form-control" id="create-to" placeholder="
  Create To">
            <button type="submit">Search</button>
            <a class="action-link" href="{{ route('user#create') }}">Add</a>
            <!-- <button  onclick="window.location='{{ url("users/create") }}'">ADD</button> -->
        </div>
    </form>
    <table class="table post-table">
    <thead class="color-brown">
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Created User</th>
        <th scope="col">Phone</th>
        <th scope="col">Birth Date</th>
        <th scope="col">Created Date</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>User</td>
            <td>{{$user->phone}}</td>
            <td>{{$user->dob}}</td>
            <td>{{$user->created_at}}</td>
            <td> <button type="submit" class="btn btn-danger">Delete</button></td>
        </tr>
    @endforeach
    </tbody>
    </table>
</div>

@endsection