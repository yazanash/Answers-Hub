@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center">
         <div class="col bg-white mb-2 rounded border py-3 d-flex flex-row align-items-center justify-content-between">
        
            <h3 class="me-3">Explore AnswersHub <strong class="text-primary">Categories</strong></h3>
            
             <a class="btn btn-primary" href="{{route('categories.create')}}" ><i class="bi bi-plus"></i>Create New Category</a>
           
           
        </div>
    </div> 
  @if ($message=Session::get('success'))
    <div class="alert alert-success" role="alert">
       {{$message}}
    </div>
  @endif
  <div class="row mt-2">
        
    <div class="col-md-12">
      <div class="row mb-2">
        @if ($categories->Count()>0)
          @foreach ($categories as $category)
            <div class="col-md-4">
              <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative bg-white">
                <div class="col p-4 d-flex flex-row align-items-center justify-content-between position-static">
                  <div class="d-flex flex-column align-items-start ">
                  <h4 class="mb-1">{{$category->name}} </h4>
                  <div class="d-flex flex-row">
                      <span class="badge text-bg-primary me-1">@shortNumber($category->posts->count()) Articles</span>
                  <span class="badge text-bg-primary me-1">@shortNumber($category->questions->count()) Questions</span>
                  </div>
                
                  </div>
                  <a href="{{url('home/article/'.$category->slug)}}" class="icon-link gap-1 icon-link-hover stretched-link">
                    EXPLORE 
                    <i class="bi bi-chevron-right"></i>
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
