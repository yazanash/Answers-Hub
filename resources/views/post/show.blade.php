@extends('layouts.app')

@section('content')
<div class="container">
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
            </article>
            
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="position-sticky" style="top: 5rem;">
            <div class="p-2 bg-body-tertiary rounded">
                <h4 >
                  About <a href="{{route('profile.show',$profile->id)}}">{{$profile->name}}</a>
                </h4>
                    <p>{{$profile->bio}}</p>
              </div>
            <div class="p-2">
                <h4>More Linked Posts</h4>
                @foreach ($posts as $post)
                    <div class="card" >
                        <img src="/images/{{$post->poster}}" class="card-img-top img-thumbnail" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><a  href="{{route('posts.show',$post->id)}}">
                            {{$post->title}}
                                </a>
                            </h5>
                            <p class="card-text">
                                <span class="badge rounded-pill text-bg-primary">{{$post->group->name}}</span> 
                                <span class="badge rounded-pill text-bg-success">{{$post->category->name}}</span>
                            </p>
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
@endsection
