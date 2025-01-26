@extends('layouts.app')

@section('content')
<div class="container bg-white p-3">
    <div class="row align-items-center">
        <div class="col">
            <h1>Questions</h1>
          </div>
      <div class="col d-flex justify-content-end">
        <a class="btn btn-primary align-items-center" href="{{route('questions.create')}}" ><i class="bi bi-plus fs-5"></i>Add</a>
      </div>
    </div>
  @if ($message=Session::get('success'))
    <div class="alert alert-success" role="alert">
       {{$message}}
    </div>
  @endif
        @if ($questions->Count()>0)
          <div class="row mb-2">
              @foreach ($questions as $question)
              <div class="col-md-6">
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
        {!!$questions->links()!!}
            </div>
            @else
<div class="card">
<div class="card-body">
    <h4 class="card-title">No Questions Added</h4>
</div>
</div>

@endif
      
      </div>
        


    
</div>
@endsection
