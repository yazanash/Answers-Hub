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
                <p>
                    {{$post->updated_at->diffForHumans()}}
                    by <a href="{{route('profile.show',$profile->id)}}">{{$profile->name}}</a>
                </p>
                <p class="d-block">
                    <span class="badge rounded-pill text-bg-primary px-3 py-2">{{$post->group->name}}</span> 
                    <span class="badge rounded-pill text-bg-success px-3 py-2">{{$post->category->name}}</span>
                </p>
                <hr>
                {!!$post->content!!}

                <hr>
                <form action="{{route('comment.store',$post->id)}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="comment" class="form-label">leave a comment</label>
                        <input
                            type="text"
                            name="content"
                            id="comment"
                            class="form-control"
                            placeholder="Give us your opinion"
                            aria-describedby="helpId"
                        />
                        <button
                            type="submit"
                            class="btn btn-primary"
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
                                <p>{{$comment->content}}</p>
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
@endsection
