@extends('layouts.app')

@section('content')

<div class="container p-3 bg-white">
    <div class="row ">
        <div class="col-4">
            <h1>Categories</h1>
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
  <form method="POST" class="col-8" action="{{route('categories.update',$category->id)}}">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label for="name" class="form-label">Category name</label>
      <input type="text" class="form-control" value="{{$category->name}}"  id="name" name="name">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a class="btn btn-danger" href="{{route('categories.index')}}" >Cancel </a>
  </form>
</div>


@endsection
