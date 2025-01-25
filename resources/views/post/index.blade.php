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
        @if ($posts->Count()>0)
        @foreach ($posts as $post)
        <div class="card col-12 m-1 p-1" >
            <img src="/images/{{$post->poster}}" style="width: 120px;" class="card-img-top img-thumbnail" alt="...">
            <div class="card-body">
              <h5 class="card-title"><a class="fs-3" href="{{route('posts.show',$post->id)}}">
                {{$post->title}}
            </a></h5>
              <p class="card-text">
                <span class="badge rounded-pill text-bg-primary">{{$post->group->name}}</span> 
                <span class="badge rounded-pill text-bg-success">{{$post->category->name}}</span>
            </p>
              <div class="d-flex justify-content-start">
                <a class="btn btn-primary mx-1" href="{{route('posts.edit',$post->id)}}"><i class="bi bi-pen"></i></a>
                <form action="{{route('posts.destroy',$post->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                </form>

              </div>
              
            </div>
          </div>
        @endforeach
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
@endsection
