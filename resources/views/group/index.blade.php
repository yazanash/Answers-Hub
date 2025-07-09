@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col bg-white mb-2 rounded border py-3 d-flex flex-row align-items-center justify-content-between">
        
            <h3 class="me-3">Explore AnswersHub <strong class="text-primary">Groups and programs</strong></h3>
            
             <a class="btn btn-primary" href="{{route('groups.create')}}" ><i class="bi bi-plus"></i>Create New Group</a>
           
           
        </div>
    </div>
  @if ($message=Session::get('success'))
    <div class="alert alert-success" role="alert">
       {{$message}}
    </div>
  @endif
    <div class="row mt-3">
        
        <div class="col-md-12">
          <div class="row mb-2">
            @if ($groups->Count()>0)
              @foreach ($groups as $group)
                <div class="col-md-12 ">
                  <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow h-md-250 position-relative bg-white">
                     <div class="col-2 d-none d-lg-block">
                      <div class="ratio ratio-4x3">
                      <img src="{{ asset('images/' .$group->poster) }}" class="img-fluid object-fit-cover w-100 h-100" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"/>
                    </div>
                    </div>
                    <div class="col p-2 d-flex flex-column position-static">
                      {{-- <strong class="d-inline-block mb-2 text-primary-emphasis"> {{$group->posts->count()}} P || {{$group->question->count()}} Q</strong> --}}
                      <h3 class="mb-0">{{$group->name}}</h3>
                      {{-- <div class="mb-1 text-body-secondary">{{$group->updated_at->diffForHumans()}}</div> --}}
                      <p class="card-text mb-2 ">{{$group->description}}</p>
                      <a href="{{route('groups.show',$group->id)}}" class="icon-link gap-1 icon-link-hover stretched-link">
                       
                      </a>
                      @if (in_array($group->id, $subscriptions))
            <form style="z-index: 100" action="{{ route('unsubscribe') }}" method="POST">
                @csrf
                <input type="hidden" name="group_id" value="{{ $group->id }}">
                <button type="submit" class="btn btn-danger">Unsubscribe</button>
            </form>
        @else
            <form style="z-index: 100" action="{{ route('subscribe') }}" method="POST">
                @csrf
                <input type="hidden" name="group_id" value="{{ $group->id }}">
                <button type="submit" class="btn btn-primary">Subscribe</button>
            </form>
        @endif
                    </div>
                   
                  </div>
                </div>
              @endforeach
              {!!$groups->links()!!}

            @else
              <div class="card">
              <div class="card-body">
                  <h4 class="card-title">No Groups Added</h4>
              </div>
              </div>
              
            @endif
          </div>
                  
        </div>
    </div>
            <hr>
           
</div>
        
        

@endsection
