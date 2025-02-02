@extends('layouts.app')

@section('content')
<div class="container bg-white">
    <div class="row">
        <div class="col-12">
           
        </div>
        <div class="col-lg-8 col-md-12">
            <article>
                <h2 class="mt-3">{{$question->title}}
                    @if ($question->solved)
                    <span class="badge rounded-pill text-bg-success px-3 py-2">Solved</span>
                    @endif
                </h2>
                <div class="d-flex flex-row py-2">
                    <a href="{{route('questions.edit',$question->id)}}" class="btn btn-primary mx-1"><i class="bi bi-pen"></i></a>
                    <form action="{{route('questions.destroy',$question->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mx-1"><i class="bi bi-trash"></i></button>
                    </form>
                </div>
                <p>
                    {{$question->updated_at->diffForHumans()}}
                    by <a href="{{route('profile.show',$profile->id)}}">{{$profile->name}}</a>
                </p>
                <p class="d-block">
                    <span class="badge rounded-pill text-bg-primary px-3 py-2">{{$question->group->name}}</span> 
                    <span class="badge rounded-pill text-bg-success px-3 py-2">{{$question->category->name}}</span>
                </p>
                <hr>
                {!!$question->content!!}
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
                <form action="{{route('answer.store',$question->id)}}" method="POST">
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
                @foreach ($question->answers()->withCount('helpfulVotes')->get()->sortByDesc('helpfulVotes_count') as $answer )
                   
                        <div class="p-2 row">
                            <div class="col-1">
                                <img id="profileImage"
                                @if ($answer->user->profile->photo!=null) src="images/profile/{{$answer->user->profile->photo}}" @else src="/images/img.jpg" @endif
                                  
                                  class="card-img-top rounded-circle mx-auto d-block"
                                  style="width: 50px; hieght:50px;" alt="...">
                            </div>
                            <div class="col-lg-10 col-sm-12 mx-2">
                                <h6>by
                                    <a href="{{route('profile.show',$answer->user->profile->id)}}">{{$answer->user->profile->name}}</a>
                                </h6>
                                <p>{{$answer->updated_at->diffForHumans()}}</p>
                                <span class="badge rounded-pill bg-primary p-2 my-1">{{$answer->helpfulVotes->count()}} Found this helpful</span>
                                <div class="answer-preview">
                                    {!! parseMarkdown($answer->content) !!}
                                </div>
                               
                                <form method="POST" action="{{route('answer.helpful',$answer->id)}}">
                                    @csrf
                                <p class="d-inline"> did you find this helpful?</p> <button class="btn-icon text-primary d-inline" >yes <i class="bi bi-hand-thumbs-up"></i> </button>
                                </form>

                            </div>
                           
                        </div>
                    <hr>
                @endforeach
            </article>
            
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="position-sticky" style="top: 5rem;">
            <div class="p-2">
                <h4>Related Questions</h4>
                @foreach ($questions as $question)
                <div class="col-md-12">
                    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                      <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-primary-emphasis">{{$question->group->name}}</strong>
                        <h3 class="mb-0"> {{$question->title}}</h3>
                        <div class="mb-1 text-body-secondary">Nov 12</div>
                        <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                        <a href="{{route('questions.show',$question->id)}}" class="icon-link gap-1 icon-link-hover stretched-link">
                          Continue reading
                          <svg class="bi"><use xlink:href="#chevron-right"></use></svg>
                        </a>
                      </div>
                    </div>
                  </div>
                @endforeach
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
