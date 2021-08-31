@extends('common.layout')
@section('content')
<div class="row">
  <h2>Post List</h2>
  <div class="input-group">
    <form action="/search" method="get" role="search">
      <div class="form-group">
        <input type="search" name="search" value="{{ app('request')->input('search') }}" class="pd-10 form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
        <span>
          <button type="submit" class="pd-10 search-btn btn btn-outline-primary">Search</button>
        </span>
        <div class="btn-group">
        @if(Auth::user()->type=='0')
          <a class="action-link" href="{{ route('posts#create') }}">Add</a>
        @endif
          <a class="action-link" href="{{ route('posts#showupload') }}">Upload</a>
          <a class="action-link" href="{{ route('posts#export') }}">Export</a>
          <!-- <button class="btn btn-success">Export</button> -->
          <!-- <span data-href="/tasks" id="export" class="btn btn-success btn-sm" onclick="exportTasks(event.target);">Export</span> -->
          <!-- <a class="action-link"><span data-href="/tasks" id="export" onclick="exportTasks(event.target);">Export</span></a> -->
          
        </div>
      </div>
    </form>
  </div>
  @if($posts->isNotEmpty())
  <table class="table post-table">
    <thead class="color-brown">
      <tr>
        <th scope="col">Post Title</th>
        <th scope="col">Post Description</th>
        <th scope="col">Posted User</th>
        <th scope="col">Posted Date</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach($posts as $post1)
      <tr>
        <input type="hidden" class="del-val-id" value="{{$post1->id}}">
        <td>
          <a data-toggle="modal" data-id="{{$post1->id}}" data-target="#modal1{{$post1->id}}">{{$post1->title}}</a>
          <div id="modal1{{$post1->id}}" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Show Post Detail</h5>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <ul class="modal-lists">
                    <li>{{$post1->id}}</li>
                    <li>{{$post1->title}}</li>
                    <li>{{$post1->description}}</li>
                    <li>{{$post1->status}}</li>
                    <li>{{date('Y/m/d', strtotime($post1->created_at))}}</li>
                    <li>{{$post1->create_username}}</li>
                    <li>{{date('Y/m/d', strtotime($post1->updated_at))}}</li>
                    <li>{{$post1->updated_username}}</li>
                  </ul>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </td>
        <td>{{$post1->description}}</td>
        <td>{{$post1->create_username}}</td>
        <td>{{date('Y/m/d', strtotime($post1->created_at))}}</td>
        <td>
          <form id="form1" class="action-form" action="{{ route('posts#edit',$post1->id) }}" method="POST">
            <a class="btn btn-primary" href="{{ route('posts#edit',$post1->id) }}">Edit</a>
            <a data-toggle="modal" data-id="{{$post1->id}}" data-target="#modal2{{$post1->id}}" class="btn btn-danger">Delete</a>
            @csrf
          </form>
          <form id="form2" action="{{route('posts#delete',$post1->id)}}" method="POST">
            @method('DELETE')
            @csrf
            <div id="modal2{{$post1->id}}" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <p>Do you want to delete this {{$post1->title}}?</p>
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
    <h2>No posts found</h2>
  </div>
  @endif
  @if($posts instanceof \Illuminate\Pagination\LengthAwarePaginator )

  {{ $posts->links() }}

  @endif
</div>

<script>
  function exportTasks(_this) {
    let _url = $(_this).data('href');
    window.location.href = _url;
  }
</script>
@endsection