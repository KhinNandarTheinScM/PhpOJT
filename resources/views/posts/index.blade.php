@extends('posts.layout')
@section('content')
    <div class="row">
            <table class="table">
  <thead class="color-brown">
    <tr>
      <th scope="col">Post Title</th>
      <th scope="col">Post Description</th>
      <th scope="col">Posted User</th>
      <th scope="col">Posted Date</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  @foreach($posts as $post1)
        <tr>
            <td>{{$post1->title}}</td>
            <td>{{$post1->description}}</td>
            <td>User1</td>
            <td>{{$post1->created_at}}</td>
            <td><a href="">Edit</a></td>
            <td><a href="">Delete</a></td>
        </tr>
  @endforeach
    <!-- <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr> -->
  </tbody>
</table>
    </div>
@endsection