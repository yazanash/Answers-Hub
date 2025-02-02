@extends('layouts.app')

@section('content')

<div class="container bg-white">
    <div class="nav-scroller py-1 mb-3 border-bottom">
        <nav class="nav nav-underline justify-content-between">
          <a class="nav-item nav-link link-body-emphasis active" href="#">All</a>

          @foreach ($categories as $category)
          <a class="nav-item nav-link link-body-emphasis" href="{{route('category.show.slug',$category->slug)}}">{{$category->name}}</a>
          @endforeach
        </nav>
      </div>
      <div class="row">
        <div class="col-lg-8 col-md-12">
            <div class="row mb-2">
                <h3>Posts</h3>
                <hr>
                <div class="row mb-2">
                  
                  @foreach ($posts as $post)
                 
                  <div class="col-md-6">
                    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                      <div class="col-12 d-none d-lg-block">
                        <img src="/images/{{$post->poster}}" class="bd-placeholder-img img-fluid"  role="img"  preserveAspectRatio="xMidYMid slice" focusable="false"></img>
                      </div>
                      <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-primary-emphasis">{{$post->group->name}}</strong>
                        <strong class="d-inline-block mb-2 text-success-emphasis">{{$post->category->name}}</strong>
                        <h5 class="mb-0">{{$post->title}}</h5>
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
              <hr>
             
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="row mb-2">
                <h3>Question</h3>
                <hr>
                <div class="row mb-2">
                  @foreach ($questions as $question)
                  <div class="col-md-12">
                    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                      <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-primary-emphasis">{{$question->group->name}}</strong>
                        <h5 class="mb-0"> {{$question->title}}</h5>
                        <div class="mb-1 text-body-secondary">{{$question->updated_at->diffForHumans()}}</div>
                        <strong class="d-inline-block mb-2 text-success-emphasis">{{$question->category->name}}</strong>
                        
                        <a href="{{route('questions.show',$question->id)}}" class="icon-link gap-1 icon-link-hover stretched-link">
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

</div>
<script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
@endsection
