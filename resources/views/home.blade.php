@extends('layouts.app')

@section('content')

<div class="container bg-white">
    <div class="nav-scroller py-1 mb-3 border-bottom">
        <nav class="nav nav-underline justify-content-between">
          <a class="nav-item nav-link link-body-emphasis active" href="#">World</a>
          <a class="nav-item nav-link link-body-emphasis" href="#">U.S.</a>
          <a class="nav-item nav-link link-body-emphasis" href="#">Technology</a>
          <a class="nav-item nav-link link-body-emphasis" href="#">Design</a>
          <a class="nav-item nav-link link-body-emphasis" href="#">Culture</a>
          <a class="nav-item nav-link link-body-emphasis" href="#">Business</a>
          <a class="nav-item nav-link link-body-emphasis" href="#">Politics</a>
          <a class="nav-item nav-link link-body-emphasis" href="#">Opinion</a>
          <a class="nav-item nav-link link-body-emphasis" href="#">Science</a>
          <a class="nav-item nav-link link-body-emphasis" href="#">Health</a>
          <a class="nav-item nav-link link-body-emphasis" href="#">Style</a>
          <a class="nav-item nav-link link-body-emphasis" href="#">Travel</a>
        </nav>
      </div>
      <div class="row">
        <div class="col-lg-8 col-md-12">
            <div class="row mb-2">
                <h3>Posts</h3>
                <div class="col-md-12">
                  <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                      <strong class="d-inline-block mb-2 text-primary-emphasis">World</strong>
                      <h3 class="mb-0">Featured post</h3>
                      <div class="mb-1 text-body-secondary">Nov 12</div>
                      <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                      <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
                        Continue reading
                        <svg class="bi"><use xlink:href="#chevron-right"></use></svg>
                      </a>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                      <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                      <strong class="d-inline-block mb-2 text-success-emphasis">Design</strong>
                      <h3 class="mb-0">Post title</h3>
                      <div class="mb-1 text-body-secondary">Nov 11</div>
                      <p class="mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                      <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
                        Continue reading
                        <svg class="bi"><use xlink:href="#chevron-right"></use></svg>
                      </a>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                      <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
             
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="row mb-2">
                <h3>Question</h3>
                <div class="col-md-12">
                  <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                      <strong class="d-inline-block mb-2 text-primary-emphasis">World</strong>
                      <h3 class="mb-0">Featured post</h3>
                      <div class="mb-1 text-body-secondary">Nov 12</div>
                      <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                      <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
                        Continue reading
                        <svg class="bi"><use xlink:href="#chevron-right"></use></svg>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                      <strong class="d-inline-block mb-2 text-success-emphasis">Design</strong>
                      <h3 class="mb-0">Post title</h3>
                      <div class="mb-1 text-body-secondary">Nov 11</div>
                      <p class="mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                      <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
                        Continue reading
                        <svg class="bi"><use xlink:href="#chevron-right"></use></svg>
                      </a>
                    </div>
                   
                  </div>
                </div>
              </div>
        
        </div>


    </div>

</div>
<script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
@endsection
