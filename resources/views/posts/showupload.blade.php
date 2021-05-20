@extends('common.layout')
@section('content')
<form class="upload" id="upload" action="{{ route('posts#postupload') }}" method="POST" role="form" enctype="multipart/form-data">
  @csrf
  <input id="file" type="file" class="form-control @error('file') is-invalid @enderror" name="file" value="{{ old('file') }}">
  <!-- <input type="file" class="mt-20" id="myFile" name="uploadfile"> -->
  <!-- <input id="file" type="file" class="mt-20" name="uploadfile"> -->
  <br>
  <button type="submit" class="btn btn-primary">Upload File</button>
  <!-- <input type="submit" class="mt-20"> -->
</form>
@endsection