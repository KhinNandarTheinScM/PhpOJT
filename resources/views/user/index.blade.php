@extends('common.layout')
@section('content')
<h2>User List</h2>
<div class="content" id="user">
    <form class="form-inline user" action="/usersearch">
        @csrf
        <div class="form-group">
            <input type="search" class="form-control" name="username" id="name" placeholder="
  Name">
            <input type="search" class="form-control" name="email" id="email" placeholder="
  Email">
            <input type="date" class="form-control" name="create-from" id="create-from" placeholder="
  Create From">
            <input type="date" class="form-control" name="create-to" id="create-to" placeholder="
  Create To">
            <button type="submit">Search</button>
            <a class="action-link" href="{{ route('user#create') }}">Add</a>
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
                <td> 
                <!-- <button type="submit" class="btn btn-danger">Delete</button> -->
                <a href="#modal" data-toggle="modal" class="btn btn-danger">Delete</a>
                <div id="modal" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Confirmation</h5>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <p>Do you want to delete this?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <form action="{{route('user#delete',$user->id)}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if($users instanceof \Illuminate\Pagination\LengthAwarePaginator )

    {{ $users->links() }}

    @endif
</div>
@endsection