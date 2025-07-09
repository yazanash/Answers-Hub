@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row ">
            <div class="col bg-white mb-2 rounded border py-3 d-flex flex-row align-items-center justify-content-between">
                <h3 class="me-3">Edit <strong class="text-primary">Question</strong></h3>
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>
        @endif
        <form method="POST" class="col-12" action="{{route('questions.update',$question->id)}}">
            @csrf
             @method('PUT')
            <div class="row bg-white p-2 rounded border">
                <div class="col">
                    <div class="input-group">
                        <span class="input-group-text">Title:</span>
                        <input required type="text" value="{{$question->title}}" class="form-control" id="title" name="title">
                    </div>

                </div>
                <div class="col">
                    <div class="input-group">
                        <span class="input-group-text">Group:</span>
                        <select required class="form-select" name="group_id">
                            <option selected>Not selected</option>
                            @foreach ($groups as $group)
                                <option @if ($question->group_id == $group->id)
                selected
            @endif value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach

                        </select>
                    </div>

                </div>

                <div class="col">
                    <div class="input-group">
                        <span class="input-group-text">Category:</span>
                        <select required class="form-select" name="category_id">
                            <option selected>Not selected</option>
                            @foreach ($categories as $category)
                                <option  @if ($question->category_id == $category->id)
                selected
            @endif  value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="col-12">
                    <div class="my-3">
                        <label for="exampleFormControlTextarea1" class="form-label fs-4">Describe your Problem</label>
                        <textarea required class="form-control" name="content" id="editor" rows="3">
                           {!! $question->content !!}
                        </textarea>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-end">
                  <a class="btn btn-danger mx-2" href="{{ route('home') }}">Cancel </a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    
                </div>
            </div>
        </form>
    </div>
    <script>
        var easyMDE = new EasyMDE({
            element: document.getElementById('editor'),
            toolbar: ["bold", "italic", "heading", "|", "quote", "unordered-list", "ordered-list", "|", "link",
                "upload-image", "image", "|", "preview", "side-by-side", "fullscreen"
            ],
            minHeight: "50px", // Set the minimum height
            maxHeight: "100px", // Set the maximum height
            uploadImage: true,
            imageUploadEndpoint: '/upload-image',
            imageUploadFunction: function(file, onSuccess, onError) {
                var formData = new FormData();
                formData.append('image', file);

                fetch('/upload-image', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/share.js') }}"></script>
    <script src="https://kit.fontawesome.com/bc897fcb31.js" crossorigin="anonymous"></script>
@endsection