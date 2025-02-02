@extends('layouts.app')

@section('content')
    <div class="container p-3 bg-white">
        <div class="row ">
            <div class="col-4">
                <h1>Posts</h1>
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
      <form method="POST" class="col-8" action="{{route('posts.update',$post->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" value="{{$post->title}}" id="title" name="title">
        </div>
        <select class="form-select" name="group_id">
            <option selected>Not selected</option>
            @foreach ($groups as $group)
            <option @if ($post->group_id == $group->id)
                selected
            @endif value="{{$group->id}}">{{$group->name}}</option>
            @endforeach
           
          </select>
          <select class="form-select" name="category_id">
            <option selected>Not selected</option>
            @foreach ($categories as $category)
            <option  @if ($post->category_id == $category->id)
                selected
            @endif value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
          </select>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Content</label>
            <textarea class="form-control" name="content"   id="editor" rows="10">
                {!! $post->content !!}
            </textarea>
          </div>
        <div class="input-group mb-3">
          <label class="input-group-text" for="inputGroupFile01">Poster</label>
          <input type="file" class="form-control" name="poster" id="inputGroupFile01">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a class="btn btn-danger" href="{{route('posts.index')}}" >Cancel </a>
      </form>
    </div>
    <script>
      var easyMDE = new EasyMDE({
           element: document.getElementById('editor'),
           toolbar: ["bold", "italic", "heading", "|", "quote", "unordered-list", "ordered-list", "|", "link","upload-image", "image", "|", "preview", "side-by-side", "fullscreen"],
           minHeight: "50px", // Set the minimum height
           maxHeight: "300px", // Set the maximum height
           uploadImage: true,
           imageUploadEndpoint: '/upload-image', 
           imageUploadFunction: function(file, onSuccess, onError) {
               var formData = new FormData();
               formData.append('image', file);
   
               fetch('/upload-image', {
                   method: 'POST',
                   body: formData,
                   headers: {
                       'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                   }
               })
               .then(response => response.json())
               .then(data => {
                   if (data.success) {
                       onSuccess(data.url);
                   } else {
                       onError(data.message);
                   }
               })
               .catch(error => {
                   onError(error.message);
                   console.log(error.message);
                   
               });
           },
       });
   </script>
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
   <script src="{{ asset('js/share.js') }}"></script>
   <script src="https://kit.fontawesome.com/bc897fcb31.js" crossorigin="anonymous"></script>
@endsection