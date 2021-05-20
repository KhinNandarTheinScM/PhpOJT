@extends('common.layout')
@section('content')
<div class="row">
  <h2>Post List</h2>
  <div class="input-group">
    <form action="/search" method="get">
      <div class="form-group">
        <input type="search" name="search" class="pd-10 form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
        <span>
          <button type="submit" class="pd-10 search-btn btn btn-outline-primary">Search</button>
        </span>
        <div class="btn-group">
          <a class="action-link" href="{{ route('posts#create') }}">Add</a>
          <a class="action-link" href="{{ route('posts#showupload') }}">Upload</a>
          <!-- <span data-href="/tasks" id="export" class="btn btn-success btn-sm" onclick="exportTasks(event.target);">Export</span> -->
          <a class="action-link"><span data-href="/tasks" id="export" onclick="exportTasks(event.target);">Export</span></a>
        </div>
      </div>
    </form>
  </div>
  <table class="table post-table">
    <thead class="color-brown">
      <tr>
        <th scope="col">ID</th>
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
        <td>{{$post1->id}}</td>
        <td>{{$post1->title}}</td>
        <td>{{$post1->description}}</td>
        <td>{{$post1->name}}</td>
        <td>{{$post1->created_at}}</td>
        <td>
          <form class="action-form" action="{{ route('posts#edit',$post1->id) }}" method="POST">
            <a class="btn btn-primary" href="{{ route('posts#edit',$post1->id) }}">Edit</a>
            <a href="#modal" data-toggle="modal"  class="btn btn-danger">Delete</a>
            @csrf
          </form>
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
                  <form action="{{route('posts#delete',$post1->id)}}" method="POST">
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

  @if($posts instanceof \Illuminate\Pagination\LengthAwarePaginator )

  {{ $posts->links() }}

  @endif
</div>
<script>
   function exportTasks(_this) {
     console.log(_this);
      let _url = $(_this).data('href');
      console.log(_url);
      window.location.href = _url;
   }
</script>
@endsection