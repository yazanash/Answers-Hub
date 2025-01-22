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
    <div
        class="table-responsive"
    >
    @if ($categories->Count()>0)
        
   
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category</th>
                    <th scope="col" width=300>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr class="">
                    <td scope="row">{{$category->id}}</td>
                    <td><a class="fs-3" href="{{route('categories.show',$category->id)}}">
                        {{$category->name}}
                    </a>
                    </td>
                    <td class="d-flex justify-content-start">
                        <a class="btn btn-primary mx-1" href="{{route('categories.edit',$category->id)}}"><i class="bi bi-pen"></i></a>
                        <form action="{{route('categories.destroy',$category->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
        {!!$categories->links()!!}
    </div>
    @else
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">No Categories Added</h4>
        </div>
    </div>
    
    @endif
</div>
@endsection
