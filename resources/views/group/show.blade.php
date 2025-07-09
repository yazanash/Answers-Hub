@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12 col-sm-12">
                <div class="card bg-white">
                    <img id="profileImage"
                         src="{{ asset('images/' .$group->poster) }}"
                        class="img-fluid object-fit-cover w-100 h-100" style="width: 150px; height:150px;" alt="...">
                    <div class="card-body">
                        <div class="d-flex flex-row align-items-center justify-content-start flex-wrap mb-2">
                            <span class="badge bg-secondary-subtle text-primary m-1">{{ $posts->count() }} Posts</span>
                            <span class="badge bg-secondary-subtle text-primary m-1">{{ $questions->count() }}
                                Questions</span>
                        </div>
                        <h5 class="card-title fs-4 fw-bold mb-2">{{$group->name}} @auth
                                
                                    <a href="{{ route('groups.edit', $group->id) }}" class="link-primary mx-2"><i
                                            class="bi bi-pen"></i></a>
                            @endauth
                        </h5>
                        <p class="card-text"> {!! $group->description !!}</p>

                    </div>
                </div>

            </div>
        <div class="col-lg-5 col-md-12 col-sm-12">
            <div class="row mt-2">
                <div class="col-12 mx-1 mb-2">
                    <div class="d-flex flex-column align-items-start justify-content-center">
                        <h4>Group <strong class="text-primary">Articles</strong></h4>
                    </div>
                </div>
                @foreach ($posts as $post)
                    <div class="col-md-12">
                        <div
                            class="bg-white row g-0 border rounded overflow-hidden flex-md-row mb-2 shadow-sm h-md-250 position-relative">

                            <div class="col p-3 d-flex flex-column position-static">
                                <div class="d-flex flex-row align-items-center justify-content-start bg-white mb-2">

                                    <div class="d-flex flex-column ">
                                        <div class="mb-0 text-body-secondary">
                                            {{ $post->updated_at->diffForHumans() }}</div>
                                    </div>

                                </div>
                                <div class="d-flex flex-row align-items-center justify-content-start">
                                    {{-- <h5> <strong class="badge bg-success-subtle rounded-pill text-success-emphasis">{{$post->category->name}}</strong></h5> --}}

                                </div>
                                <h5 class="mb-2">{{ $post->title }}</h5>

                                <a href="{{ route('posts.show', $post->id) }}"
                                    class="icon-link gap-1 icon-link-hover stretched-link d-block">
                                    Continue reading
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                            </div>
                            <div class="col-12 d-none d-lg-block">
                                <div class="ratio ratio-21x9">
                                    <img src="/images/{{ $post->poster }}" class="img-fluid object-fit-cover w-100 h-100"
                                        role="img" preserveAspectRatio="xMidYMid slice" focusable="false">

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12">
            <div class="row mt-2">
                <div class="col-12 mx-1 mb-2">
                    <div class="d-flex flex-column align-items-start justify-content-center">
                        <h4>Group <strong class="text-primary">Questions</strong></h4>
                    </div>
                </div>
                @foreach ($questions as $question)
                    <div class="col-md-12">
                        <div
                            class="bg-white row g-0 border rounded overflow-hidden flex-md-row mb-2 shadow-sm h-md-250 position-relative">

                            <div class="col p-3 d-flex flex-column position-static">
                                <div class="d-flex flex-row align-items-center justify-content-start bg-white mb-2">

                                    <div class="d-flex flex-column ">
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
@endsection
