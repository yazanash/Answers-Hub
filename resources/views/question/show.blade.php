@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <article class="bg-white p-3 rounded">
                    <h2 class="mt-3">{{ $question->title }}
                        @if ($question->solved)
                            <span class="badge rounded-pill text-bg-success px-3 py-2">Solved</span>
                        @endif
                    </h2>

                    <p>
                        {{ $question->updated_at->diffForHumans() }}
                        by <a href="{{ route('profile.show', $profile->id) }}">{{ $profile->name }}</a>
                    </p>
                     <div class="d-flex flex-row py-2">
                        <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-primary mx-1"><i
                                class="bi bi-pen"></i></a>
                        <form action="{{ route('questions.destroy', $question->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mx-1"><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                    <p class="fw-bold text-primary">Category : {{ $question->category->name }}</p>
                    <p class="fw-bold text-primary">Group: {{ $question->group->name }} </p>
                    <div class="answer-preview">
                         {!! parseMarkdown($question->content) !!}
                    </div>
                   
                   
                    <hr>
                    <div class="d-flex justify-content-start mb-3">
                        <!-- Facebook -->
                        <a data-mdb-ripple-init class="btn text-white mx-2" style="background-color: #3b5998;"
                            href="{{ $shareLinks['facebook'] }}" role="button"><i class="fab fa-facebook-f"></i></a>

                        <!-- Twitter -->
                        <a data-mdb-ripple-init class="btn text-white mx-2" style="background-color: #55acee;"
                            href="{{ $shareLinks['twitter'] }}" role="button"><i class="fab fa-twitter"></i></a>

                        <!-- Linkedin -->
                        <a data-mdb-ripple-init class="btn text-white mx-2" style="background-color: #0082ca;"
                            href="{{ $shareLinks['linkedin'] }}" role="button"><i class="fab fa-linkedin-in"></i></a>

                        <!-- Reddit -->
                        <a data-mdb-ripple-init class="btn text-white mx-2" style="background-color: #ff4500;"
                            href="{{ $shareLinks['reddit'] }}" role="button"><i class="fab fa-reddit-alien"></i></a>

                        <!-- Whatsapp -->
                        <a data-mdb-ripple-init class="btn text-white mx-2" style="background-color: #25d366;"
                            href="{{ $shareLinks['whatsapp'] }}" role="button"><i class="fab fa-whatsapp"></i></a>
                    </div>
             </article>
             <div class="col-12">

                    <form class="p-3 bg-white mt-2 rounded" action="{{ route('answer.store', $question->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="editor" class="form-label">leave an answer</label>
                            <textarea name="content" id="editor" class="form-control" placeholder="Help your friend by provid an answer"
                                aria-describedby="helpId"></textarea>
                            <div class="d-flex flex-row align-items-center justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            Post
                        </button>
                    </div>

                        </div>
                    </form>
                </div>
                 <div class="p-3 bg-white mt-2 rounded">
                     @if ($question->answers()->count() > 0)
                    @foreach ($question->answers()->withCount('helpfulVotes')->get()->sortByDesc('helpfulVotes_count') as $answer)
                        <div class="p-2 row">
                            <div class="col-1">
                                <img id="profileImage"
                                    @if ($answer->user->profile->photo != null) src="{{asset('images/profile/'. $answer->user->profile->photo)}}" @else src="{{asset('images/img.jpg')}}" @endif
                                    class="card-img-top rounded-circle mx-auto d-block" style="width: 50px; hieght:50px;"
                                    alt="...">
                            </div>
                            <div class="col-lg-10 col-sm-12 mx-2">
                                <h6>by
                                    <a
                                        href="{{ route('profile.show', $answer->user->profile->id) }}">{{ $answer->user->profile->name }}</a>
                                </h6>
                                <p>{{ $answer->updated_at->diffForHumans() }}</p>
                                <span class="badge bg-primary p-2 my-1">{{ $answer->helpfulVotes->count() }}
                                    Found this helpful</span>
                                <div class="answer-preview">
                                    {!! parseMarkdown($answer->content) !!}
                                </div>

                                <form method="POST" action="{{ route('answer.helpful', $answer->id) }}">
                                    @csrf
                                    <p class="d-inline"> did you find this helpful?</p> <button
                                        class="btn-icon text-primary d-inline">yes <i class="bi bi-hand-thumbs-up"></i>
                                    </button>
                                </form>
                                <hr>
                            </div>

                        </div>
                        
                    @endforeach
                     @else
                        <h4 class="text-center">No Answers Yet</h4>
                    @endif

              </div>

            </div>
            <div class="col-lg-12 col-md-12">
                    <div class="row p-2">
                        <h4>Related Questions</h4>
                        @foreach ($questions as $question)
                          <div class="col-md-12">
                                    <div
                                        class="bg-white row g-0 border rounded overflow-hidden flex-md-row mb-2 shadow-sm h-md-250 position-relative">

                                        <div class="col p-3 d-flex flex-column position-static">
                                            <div class="d-flex flex-row align-items-center justify-content-start bg-white mb-2">
                                                <img id="profileImage" width="30" height="30"
                                                    @if ($question->user->profile->photo != null) src="{{ asset('images/profile/' . $question->user->profile->photo) }}" @else src="{{ asset('images/img.jpg') }}" @endif
                                                    class="rounded-circle m-1 " alt="...">
                                                <div class="d-flex flex-column ">
                                                    <h5 class="mb-0">{{ $question->user->profile->name }} - <strong
                                                            class="badge bg-primary-subtle text-primary">{{ $question->group->name }}</strong>
                                                    </h5>
                                                    <div class="mb-0 text-body-secondary">
                                                        {{ $question->updated_at->diffForHumans() }}</div>
                                                </div>

                                            </div>
                                            <div class="d-flex flex-row align-items-center justify-content-start">
                                                {{-- <h5> <strong class="badge bg-success-subtle rounded-pill text-success-emphasis">{{$post->category->name}}</strong></h5> --}}

                                            </div>
                                            <h5 class="mb-2">{{ $question->title }}</h5>

                                            <a href="{{ route('questions.show', $question->id) }}"
                                                class="icon-link gap-1 icon-link-hover stretched-link d-block">
                                                Continue reading
                                                <i class="bi bi-chevron-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                    </div>
            </div>
        </div>
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
