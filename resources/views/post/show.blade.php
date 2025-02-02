@extends('layouts.app')

@section('content')
<div class="container bg-white">
    <div class="row">
        <div class="col-12">
           
        </div>
        <div class="col-lg-8 col-md-12">
            <article>
                <img src="/images/{{$post->poster}}" class="img-thumbnail" alt="...">
                <h2 class="mt-3">{{$post->title}}</h2>
                <div class="d-flex flex-row py-2">
                    <a href="{{route('posts.edit',$post->id)}}" class="btn btn-primary mx-1"><i class="bi bi-pen"></i></a>
                    <form action="{{route('posts.destroy',$post->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mx-1"><i class="bi bi-trash"></i></button>
                    </form>
                </div>
                <p>
                    {{$post->updated_at->diffForHumans()}}
                    by <a href="{{route('profile.show',$profile->id)}}">{{$profile->name}}</a>
                </p>
                <p class="d-block">
                    <span class="badge rounded-pill text-bg-primary px-3 py-2">{{$post->group->name}}</span> 
                    <span class="badge rounded-pill text-bg-success px-3 py-2">{{$post->category->name}}</span>
                </p>
                <hr>
                <div class="answer-preview">
                    {!! parseMarkdown($post->content) !!}
                </div>
                <hr>
                <div class="d-flex justify-content-start">
        <!-- Facebook -->
<a data-mdb-ripple-init class="btn text-white mx-2" style="background-color: #3b5998;" href="{{ $shareLinks['facebook'] }}" role="button"
><i class="fab fa-facebook-f"></i
></a>

<!-- Twitter -->
<a data-mdb-ripple-init class="btn text-white mx-2" style="background-color: #55acee;" href="{{ $shareLinks['twitter'] }}" role="button"
><i class="fab fa-twitter"></i
></a>

<!-- Linkedin -->
<a data-mdb-ripple-init class="btn text-white mx-2" style="background-color: #0082ca;" href="{{ $shareLinks['linkedin'] }}" role="button"
><i class="fab fa-linkedin-in"></i
></a>

<!-- Reddit -->
<a data-mdb-ripple-init class="btn text-white mx-2" style="background-color: #ff4500;" href="{{ $shareLinks['reddit'] }}" role="button"
><i class="fab fa-reddit-alien"></i
></a>

<!-- Whatsapp -->
<a data-mdb-ripple-init class="btn text-white mx-2" style="background-color: #25d366;" href="{{ $shareLinks['whatsapp'] }}" role="button"
><i class="fab fa-whatsapp"></i
></a>
</div>

                <hr>
                <form action="{{route('comment.store',$post->id)}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="editor" class="form-label">leave an answer</label>
                        <textarea
                            name="content"
                            id="editor"
                            class="form-control"
                            placeholder="Help your friend by provid an answer"
                            aria-describedby="helpId"
                        ></textarea>
                        <button
                            type="submit"
                            class="btn btn-primary my-1 float-end"
                        >
                            Save
                        </button>
                        
                    </div>
                </form>
                @foreach ($post->comments as $comment )
                   
                        <div class="p-2 row">
                            <div class="col-1">
                                <img id="profileImage"
                                @if ($comment->user->profile->photo!=null) src="images/profile/{{$comment->user->profile->photo}}" @else src="/images/img.jpg" @endif
                                  
                                  class="card-img-top rounded-circle mx-auto d-block"
                                  style="width: 50px; hieght:50px;" alt="...">
                            </div>
                            <div class="col-lg-10 col-sm-12 mx-2">
                                <h6>by
                                    <a href="{{route('profile.show',$comment->user->profile->id)}}">{{$comment->user->profile->name}}</a>
                                </h6>
                                <p>{{$comment->updated_at->diffForHumans()}}</p>
                                <div class="answer-preview">
                                    {!! parseMarkdown($comment->content) !!}
                                </div>
                            </div>
                           
                        </div>
                    
                @endforeach
            </article>

        </div>
        <div class="col-lg-4 col-md-12">
            
            <div class="p-2 bg-white rounded mt-2">
                <h4 >
                  About <a href="{{route('profile.show',$profile->id)}}">{{$profile->name}}</a>
                </h4>
                    <p>{{$profile->bio}}</p>
              </div>
            <div class="p-2">
                <h4>More Linked Posts</h4>
                <div class="row">

                
                @foreach ($posts as $post)
                <div class="col-md-12">
                    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                      <div class="col-12 d-none d-lg-block">
                        <img src="/images/{{$post->poster}}" class="bd-placeholder-img img-fluid"  role="img"  preserveAspectRatio="xMidYMid slice" focusable="false"></img>
                      </div>
                      <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-primary-emphasis">{{$post->group->name}}</strong>
                        <h3 class="mb-0">{{$post->title}}</h3>
                        {{-- <span class="badge rounded-pill text-bg-success">{{$post->category->name}}</span> --}}
                        <div class="mb-1 text-body-secondary">{{$post->updated_at->diffForHumans()}}</div>
                        {{-- <a class="btn btn-primary mx-1" href="{{route('posts.edit',$post->id)}}"><i class="bi bi-pen"></i></a>
                          <form action="{{route('posts.destroy',$post->id)}}" method="POST">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                          </form> --}}
                         
                          
                        <a href="{{route('posts.show',$post->id)}}" class="icon-link gap-1 icon-link-hover stretched-link d-block">
                          Continue reading
                          <i class="bi bi-chevron-right"></i>
                        </a>
                      </div>
                     
                    </div>
                  </div>
                @endforeach
            </div>
            </div>
            <div class="p-2">
                <h4>Explore our groups</h4>
                <ol class="list-unstyled mb-0">
                    @foreach ($groups as $group)
                    <li><a href="{{route('groups.show',$group->id)}}">{{$group->name}}</a></li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
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
