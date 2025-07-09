@extends('layouts.app')

@section('content')
@php
  $type = request()->segment(2); // article or question
@endphp
    <div class="container" >


        <div class="row">
         <div class="col-12 mx-1 mb-2">
                        <div class="d-flex flex-column align-items-start justify-content-center">
                            <h4 >Welcome <strong class="text-primary">{{Auth::user()->name}}</strong></h4>
                        </div>
                    </div>
            <div class="col-md-9">
                <div
                    class="d-flex flex-row border rounded align-items-center justify-content-start col-md-12 mb-2 p-1 bg-white">
                    <ul class="nav nav-pills bg-white  p-2 me-2 justify-content-start">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->segment(2) == 'article' ? 'active' : '' }} me-1 " href="{{ url('/home/article') }}"><i class="bi bi-journal-text mx-1"></i>Articles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->segment(2) == 'question' ? 'active' : '' }} me-1" href="{{ url('/home/question') }}"><i class="bi bi-patch-question mx-1"></i>Questions</a>
                        </li>
                    </ul>
                    <form class="bg-white row me-1">
                        <div class="col">
                            <div class="input-group">
                                <label class="input-group-text" for="inputGroupSelect01"><i
                                        class="bi bi-grid-3x3-gap me-1"></i>Category</label>
                                <select class="form-select" id="inputGroupSelect01"  onchange="window.location.href = `/home/{{ $type }}/` + this.value;">
                                    <option value="" selected>All</option>
                                     @foreach($categories as $category)
                                    <option value="{{ $category->slug }}" 
        {{ isset($selected_category) && $selected_category->slug == $category->slug ? 'selected' : '' }}>
        {{ $category->name }}
      </option>
      @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                      <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="bi bi-plus"></i> New
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item"  href="{{route('questions.create')}}"><i class="bi bi-plus"></i>New Question</a></li>
                          <li><a class="dropdown-item" href="{{route('posts.create')}}"><i class="bi bi-plus"></i>New Article</a></li>
                        </ul>
                      </div>
                </div>
                @if(isset($posts))
                    @foreach ($posts as $post)

                                <div class="col-md-12">
                                    <div
                                        class="bg-white row g-0 border rounded overflow-hidden flex-md-row mb-2 shadow-sm h-md-250 position-relative">

                                        <div class="col p-3 d-flex flex-column position-static">
                                            <div class="d-flex flex-row align-items-center justify-content-start bg-white mb-2">
                                                <img id="profileImage" width="30" height="30"
                                                    @if ($post->user->profile->photo != null) src="{{ asset('images/profile/' . $post->user->profile->photo) }}" @else src=" {{ asset('images/img.jpg') }}" @endif
                                                    class="rounded-circle m-1 " alt="...">
                                                <div class="d-flex flex-column ">
                                                    <h5 class="mb-0">{{ $post->user->profile->name }} - <strong
                                                            class="badge bg-primary-subtle text-primary">{{ $post->group->name }}</strong>
                                                    </h5>
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
                                        <div class="col-3 d-none d-lg-block">
                                            <div class="ratio ratio-4x3">
                                                <img src="{{ asset('images/' . $post->poster) }}"
                                                    class="img-fluid object-fit-cover w-100 h-100" role="img"
                                                    preserveAspectRatio="xMidYMid slice" focusable="false">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                    @endforeach
                @endif
                 @if(isset($questions))
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
                @endif

            </div>
            <div class="col-md-3">
                <div class="row mb-2 mx-1 px-1 py-2 bg-white rounded">
                    <h3 class="text-primary">Groups you are in</h3>
                     <a href="{{ route('groups.index') }}"
                                            class="icon-link gap-1 icon-link-hover d-block mb-2">
                                             View All
                                            <i class="bi bi-chevron-right"></i>
                                        </a>
                    
                    <ul class="list-group col-12">
                        @foreach ($groups as $group)
                            <div
                                class="p-1 mb-2 overflow-hidden position-relative d-flex flex-row align-items-center justify-content-start border rounded bg-white">
                                <img src="/images/{{ $group->poster }}" width="50" height="50" alt=""
                                    class="rounded me-2">
                                <div class="d-flex align-items-center justify-content-center">
                                    <h6 class="fw-bold mb-0 text-secondary">{{ $group->name }}</h6>
                                    <a href="{{route('groups.show',$group->id)}}" class="icon-link gap-1 icon-link-hover stretched-link">
                       
                                    </a>
                                </div>

                            </div>
                        @endforeach
                    </ul>
                </div>

            </div>


        </div>

    </div>
    <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
@endsection
