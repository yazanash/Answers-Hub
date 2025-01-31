@extends('layouts.app')

@section('content')
<div class="container bg-white p-3">
    <div class="row align-items-center">
        <div class="col">
            <h1>Posts</h1>
          </div>
      <div class="col d-flex justify-content-end">
        <a class="btn btn-primary align-items-center" href="{{route('posts.create')}}" ><i class="bi bi-plus fs-5"></i>Add</a>
      </div>
    </div>
  @if ($message=Session::get('success'))
    <div class="alert alert-success" role="alert">
       {{$message}}
    </div>
  @endif

        <div class="row">
          <div class="col-lg-12 col-md-12">
              <div class="row mb-2">
                  
                  @if ($posts->Count()>0)
                  @foreach ($posts as $post)
                 
                  <div class="col-md-6">
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
                <hr>
                {!!$posts->links()!!}
                @else
                <div class="card">
                <div class="card-body">
                    <h4 class="card-title">No Posts Added</h4>
                </div>
                </div>
                
                @endif
          </div>
      </div>









    
</div>
@endsection
