@extends('layouts.app')

@section('content')
<div class="container bg-white p-3">
    <div class="row align-items-center">
        <div class="col">
            <h1>Groups</h1>
          </div>
      <div class="col d-flex justify-content-end">
        <a class="btn btn-primary align-items-center" href="{{route('groups.create')}}" ><i class="bi bi-plus fs-5"></i>Add</a>
      </div>
    </div>
  @if ($message=Session::get('success'))
    <div class="alert alert-success" role="alert">
       {{$message}}
    </div>
  @endif
    <div class="row">
        @if ($groups->Count()>0)
        @foreach ($groups as $group)
        <div class="card col-3 m-1 p-1" >
            <img src="/images/{{$group->poster}}" style="width: 120px;" class="card-img-top img-thumbnail" alt="...">
            <div class="card-body">
              <h5 class="card-title"><a class="fs-3" href="{{route('groups.show',$group->id)}}">
                {{$group->name}}
            </a></h5>
              <p class="card-text">{{$group->description}}</p>
              <div class="d-flex justify-content-start">
                <a class="btn btn-primary mx-1" href="{{route('groups.edit',$group->id)}}"><i class="bi bi-pen"></i></a>
                <form action="{{route('groups.destroy',$group->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                </form>

              </div>
              
            </div>
          </div>
        @endforeach
{!!$groups->links()!!}
@else
<div class="card">
<div class="card-body">
    <h4 class="card-title">No Categories Added</h4>
</div>
</div>

@endif
    </div>
    
</div>
@endsection
