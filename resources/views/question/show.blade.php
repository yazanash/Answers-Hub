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
                <form action="{{route('answer.store',$question->id)}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="comment" class="form-label">leave an answer</label>
                        <input
                            type="text"
                            name="content"
                            id="comment"
                            class="form-control"
                            placeholder="Help your friend by provid an answer"
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
                @foreach ($question->answers as $answer )
                   
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
                                <p>{{$answer->content}}</p>
                            </div>
                           
                        </div>
                    
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
@endsection
