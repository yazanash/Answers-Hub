@extends('layouts.app')

@section('content')
<div class="container">
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
                
            </article>
            
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="position-sticky" style="top: 5rem;">
            <div class="p-2">
                <h4>Related Questions</h4>
                @foreach ($questions as $question)
                    <div class="card" >
                         <div class="card-body">
                            <h6 class="card-title"><a  href="{{route('questions.show',$question->id)}}">
                            {{$question->title}}
                                </a>
                            </h6>
                            <p class="card-text">
                                <span class="badge rounded-pill text-bg-primary">{{$question->group->name}}</span> 
                                <span class="badge rounded-pill text-bg-success">{{$question->category->name}}</span>
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
