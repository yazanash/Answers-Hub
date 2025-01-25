@extends('layouts.app')

@section('content')
<div class="container bg-white p-2 " >
    <div class="row">
        <div class="col-lg-3 col-md-12 col-sm-12" >
            <div class="card text-center bg-white border border-0">
                <img id="profileImage"
               @if ($profile->photo!=null) src="images/profile/{{$profile->photo}}" @else src="images/img.jpg" @endif
                 
                 class="card-img-top rounded-circle mx-auto d-block"
                 style="width: 150px; hieght:150px;" alt="...">
                <div class="card-body">
                  <h5 class="card-title fs-4 fw-bold">{{$profile->name}} <span class="badge rounded-pill text-bg-success">New</span></h5>
                  <p class="card-text">{!!$profile->bio!!}</p>
                  @auth
                  @if ($profile->user_id==Auth::user()->id)
                  <a href="{{route('profile.edit',$profile->id)}}" class="btn btn-primary m-auto"><i class="bi bi-pen"></i> Edit</a>
                      
                  @endif
                  @endauth
                 
                </div>
              </div>
        </div>
    </div>
</div>
@endsection