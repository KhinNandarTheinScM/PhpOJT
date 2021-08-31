@extends('common.layout')
@section('content')
<h2>User List</h2>
<div class="content" id="user">
  <form class="form-inline user" action="/usersearch">
    @csrf
    <div class="form-group">
      <input type="search" class="form-control" name="username" value="{{ app('request')->input('username') }}" id="name" placeholder="
  Name">
      <input type="search" class="form-control" name="email" value="{{ app('request')->input('email') }}" id="email" placeholder="
  Email">
      <input type="date" class="form-control" name="create-from" value="{{ app('request')->input('create-from') }}" id="create-from" placeholder="
  Create From">
      <input type="date" class="form-control" name="create-to" value="{{ app('request')->input('create-to') }}" id="create-to" placeholder="
  Create To">
      <button type="submit">Search</button>
      <a class="action-link" href="{{ route('user#create') }}">Add</a>
    </div>
  </form>
  @if($users->isNotEmpty())
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
        <td>
          <a data-toggle="modal" data-id="{{$user->id}}" data-target="#modal1{{$user->id}}">{{$user->name}}</a>
          <div id="modal1{{$user->id}}" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Show User Detail</h5>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <ul class="modal-lists">
                    <li>{{$user->name}}</li>
                    <li>{{$user->email}}</li>
                    <li>{{$user->phone}}</li>
                    <li>{{date('Y/m/d', strtotime($user->dob))}}</li>
                    <li>{{$user->address}}</li>
                    <li>{{date('Y/m/d', strtotime($user->created_at))}}</li>
                    <li>{{$user->create_username}}</li>
                    <li>{{date('Y/m/d', strtotime($user->updated_at))}}</li>
                    <li>{{$user->updated_user}}</li>
                  </ul>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
              </div>
            </div>
          </div>
          <!-- {{$user->name}} -->
        </td>
        <td>{{$user->email}}</td>
        <td>{{$user->create_username}}</td>
        <td>{{$user->phone}}</td>
        <td>{{$user->dob}}</td>
        <td>{{$user->created_at}}</td>
        <td>
          <a data-toggle="modal" data-id="{{$user->id}}" data-target="#modal2{{$user->id}}" class="btn btn-danger">Delete</a>
          <form id="form2" action="{{route('user#delete',$user->id)}}" method="POST">
            @method('DELETE')
            @csrf
            <div id="modal2{{$user->id}}" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <p>Do you want to delete this {{$user->name}}?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                  </div>
                </div>
              </div>
            </div>
          </form>

        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @else
  <div>
    <h2>No User found</h2>
  </div>
  @endif
  @if($users instanceof \Illuminate\Pagination\LengthAwarePaginator )

  {{ $users->links() }}

  @endif
</div>
@endsection