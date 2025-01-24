@extends('layouts.app')

@section('content')
<div class="container bg-white p-2 " >
    <div class="row">
        <div class="col-lg-3 col-md-12 col-sm-12" >
            <div class="card text-center bg-white border border-0">
                <img id="profileImage" src="/images/img.jpg" class="card-img-top rounded-circle mx-auto d-block"
                 style="width: 150px; hieght:150px;cursor: pointer;" alt="...">
                <div class="card-body">
                  <h5 class="card-title fs-4 fw-bold">User Name <span class="badge rounded-pill text-bg-success">New</span></h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-primary m-auto">Open</a>
                  
                </div>
              </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12" >
            <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">Personal Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">Questions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">Answers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">Posts</a>
                </li>
              </ul>
            <form class="p-2">
            <input type="file" id="fileInput" style="display: none;">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Name</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
              </div>
              <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Bio: write about your self</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
              </div>
              <select class="form-select" aria-label="Default select example">
                <option selected>Not selected</option>
                <option value="1">Male</option>
                <option value="2">Female</option>
              </select>
              <div class="input-group my-3">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-facebook"></i></span>
                <input type="text" class="form-control" placeholder="Facebook Link" aria-label="Facebook" aria-describedby="basic-addon1">
              </div>
              <div class="input-group my-3">
                <span class="input-group-text" id="basic-addon2"><i class="bi bi-linkedin"></i></span>
                <input type="text" class="form-control" placeholder="Linkedin Link" aria-label="linkedin" aria-describedby="basic-addon2">
              </div>
              <div class="input-group my-3">
                <span class="input-group-text" id="basic-addon3"><i class="bi bi-whatsapp"></i></span>
                <input type="text" class="form-control" placeholder="Whatsapp Number" aria-label="Whatsapp" aria-describedby="basic-addon3">
              </div>
              
              <div class="input-group my-3">
                <span class="input-group-text" id="basic-addon4"><i class="bi bi-envelope-at-fill"></i></span>
                <input type="text" class="form-control" placeholder="SVU Email" aria-label="Email" aria-describedby="basic-addon4">
              </div>
              <button type="submit" class="btn btn-primary mb-3">Confirm identity</button>

              <form>
        </div>
    </div>
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
            document.getElementById('profileImage').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>


@endsection