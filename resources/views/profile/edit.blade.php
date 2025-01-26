@extends('layouts.app')

@section('content')
<div class="container rounded bg-white p-2 " >
  <form class="p-2" action="{{route('profile.update',$profile->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
  <div class="row">
    <div class="col-lg-4 col-md-12 col-sm-12 text-start" >
      
        <img id="photo_img" src="/images/img.jpg" class="card-img-top rounded-circle "
        style="width: 150px; hieght:150px;cursor: pointer;" alt="...">
        <input type="file" name="photo" id="fileInput" style="display: none;"> <br>
        <a href="#" id="profileImage" class="btn btn-primary mb-3">Change profile photo</a>
        <h5 class="text-start">{{$user->name}}</h5>
    </div>
    <div class="col-lg-8 col-md-12 col-sm-12 text-start">
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Name</label>
        <input type="text" name="name" value="{{$profile->name}}" class="form-control" id="exampleFormControlInput1" placeholder="Enter your name">
      </div>
      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Bio</label>
        <textarea class="form-control" name="bio" id="exampleFormControlTextarea1" rows="3">
          {{$profile->bio}}
        </textarea>
      </div>
      <select class="form-select" name="gender" aria-label="Default select example">
        <option>Not selected</option>
        <option @if ($profile->gender==1)
          selected
        @endif value="1">Male</option>
        <option @if ($profile->gender==2)
          selected
        @endif value="2">Female</option>
      </select>
      <div class="input-group my-3">
        <span class="input-group-text" id="basic-addon1"><i class="bi bi-facebook"></i></span>
        <input type="url" name="facebook" value="{{$profile->facebook}}"  class="form-control" placeholder="Facebook Link" aria-label="Facebook" aria-describedby="basic-addon1">
      </div>
      <div class="input-group my-3">
        <span class="input-group-text" id="basic-addon2"><i class="bi bi-linkedin"></i></span>
        <input type="url" name="linkedin" value="{{$profile->linkedin}}" class="form-control" placeholder="Linkedin Link" aria-label="linkedin" aria-describedby="basic-addon2">
      </div>
      <div class="input-group my-3">
        <span class="input-group-text" id="basic-addon3"><i class="bi bi-whatsapp"></i></span>
        <input type="tel" name="whatsapp" value="{{$profile->whatsapp}}" class="form-control" placeholder="Whatsapp Number" aria-label="Whatsapp" aria-describedby="basic-addon3">
      </div>
      
      <div class="input-group my-3">
        <span class="input-group-text" id="basic-addon4"><i class="bi bi-envelope-at-fill"></i></span>
        <input type="email" name="svu_email" value="{{$profile->svu_email}}" class="form-control" placeholder="SVU Email" aria-label="Email" aria-describedby="basic-addon4">
      </div>
      <button type="submit" class="btn btn-primary mb-3">Update</button>
    
    </div>
     
  </div>
  <form>

</div>
<script>
  document.getElementById('profileImage').addEventListener('click', function() {
  document.getElementById('fileInput').click();
});

document.getElementById('fileInput').addEventListener('change', function(event) {
  const file = event.target.files[0];
  if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
          document.getElementById('photo_img').src = e.target.result;
      };
      reader.readAsDataURL(file);
  }
});
</script>
@endsection