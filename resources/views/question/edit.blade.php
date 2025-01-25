@extends('layouts.app')

@section('content')
    <div class="container p-3 bg-white">
        <div class="row ">
            <div class="col-4">
                <h1>Question</h1>
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
      <form method="POST" class="col-8" action="{{route('questions.update',$question->id)}}" >
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" value="{{$question->title}}" id="title" name="title">
        </div>
        <select class="form-select" name="group_id">
            <option selected>Not selected</option>
            @foreach ($groups as $group)
            <option @if ($question->group_id == $group->id)
                selected
            @endif value="{{$group->id}}">{{$group->name}}</option>
            @endforeach
           
          </select>
          <select class="form-select" name="category_id">
            <option selected>Not selected</option>
            @foreach ($categories as $category)
            <option  @if ($question->category_id == $category->id)
                selected
            @endif value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
          </select>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Content</label>
            <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="10">
                {!! $question->content !!}
            </textarea>
          </div>
        <div class="input-group mb-3">
          <label class="input-group-text" for="inputGroupFile01">Poster</label>
          <input type="file" class="form-control" name="poster" id="inputGroupFile01">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a class="btn btn-danger" href="{{route('questions.index')}}" >Cancel </a>
      </form>
    </div>

@endsection