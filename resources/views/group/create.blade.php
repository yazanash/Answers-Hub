@extends('layouts.app')

@section('content')
    <div class="container p-3 bg-white">
        <div class="row ">
            <div class="col-4">
                <h1>Groups</h1>
              </div>
          <div class="col-4 text-align-end">
          
          </div>
        </div>
      @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
               <li>{{$error}}</li>
                @endforeach
            </ul>
          
        </div>
      @endif
      <form method="POST" class="col-8" action="{{route('groups.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Group name</label>
          <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description name</label>
          <input type="text" class="form-control" id="description" name="description">
        </div>
        <div class="input-group mb-3">
          <label class="input-group-text" for="inputGroupFile01">Poster</label>
          <input type="file" class="form-control" name="poster" id="inputGroupFile01">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a class="btn btn-danger" href="{{route('groups.index')}}" >Cancel </a>
      </form>
    </div>

@endsection