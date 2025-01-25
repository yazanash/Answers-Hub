@extends('layouts.app')

@section('content')
    <div class="container p-3 bg-white">
        <div class="row ">
            <div class="col-4">
                <h1>Questions</h1>
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
      <form method="POST" class="col-8" action="{{route('questions.store')}}" >
        @csrf
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" id="title" name="title">
        </div>
        <select class="form-select mb-3" name="group_id">
            <option selected>Not selected</option>
            @foreach ($groups as $group)
            <option value="{{$group->id}}">{{$group->name}}</option>
            @endforeach
           
          </select>
          <select class="form-select mb-3" name="category_id">
            <option selected>Not selected</option>
            @foreach ($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
          </select>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Content</label>
            <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="10"></textarea>
          </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a class="btn btn-danger" href="{{route('questions.index')}}" >Cancel </a>
      </form>
    </div>
    {{-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#exampleFormControlTextarea1',
            plugins: 'image code',
            toolbar: 'undo redo | link image | code | fontsizeselect fontselect',
            menubar: false,
            setup: function (editor) {
                editor.on('change', function () {
                    editor.save();
                });
            }
        });
    </script> --}}
@endsection