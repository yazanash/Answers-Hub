@extends('layouts.app')

@section('content')
<div class="container bg-white p-3">
    <div class="row align-items-center">
        <div class="col">
            <h1>Categories</h1>
          </div>
      <div class="col d-flex justify-content-end">
        <a class="btn btn-primary align-items-center" href="{{route('categories.create')}}" ><i class="bi bi-plus fs-5"></i>Add</a>
      </div>
    </div>
  @if ($message=Session::get('success'))
    <div class="alert alert-success" role="alert">
       {{$message}}
    </div>
  @endif
  <div class="row">
        
    <div class="col-md-12">
      <div class="row mb-2">
        @if ($categories->Count()>0)
          @foreach ($categories as $category)
            <div class="col-md-4">
              <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                  <strong class="d-inline-block mb-2 text-primary-emphasis">1.2K Post</strong>
                  <h3 class="mb-0">{{$category->name}}</h3>
                  <div class="mb-1 text-body-secondary">Nov 12</div>
                  <a href="{{route('categories.show',$category->id)}}" class="icon-link gap-1 icon-link-hover stretched-link">
                    EXPLORE 
                    <svg class="bi"><use xlink:href="#chevron-right"></use></svg>
                  </a>
                </div>
              </div>
            </div>
          @endforeach
          {!!$categories->links()!!}

        @else
          <div class="card">
          <div class="card-body">
              <h4 class="card-title">No Categroies Added</h4>
          </div>
          </div>
          
        @endif
      </div>
              
    </div>
</div>
        <hr>
</div>
@endsection
