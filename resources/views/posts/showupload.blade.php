@extends('common.layout')
@section('content')
<form class="upload" id="upload" action="{{ route('posts#postupload') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <!-- <input id="file" type="file" class="form-control @error('file') is-invalid @enderror" name="file" value="{{ old('file') }}"> -->
  <!-- <input type="file" class="mt-20" id="myFile" name="uploadfile"> -->
  <input id="file" type="file" class="mt-20" name="file">
  <br>
  <button type="submit" class="btn btn-primary mt-20">Upload File</button>
  <!-- <input type="submit" class="mt-20"> -->
</form>
@endsection