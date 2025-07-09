<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- Styles / Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="">
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow  fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="/images/logo.png" alt="Bootstrap" width="80" height="45">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-around align-items-center" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0 align-items-center">
                    <li class="nav-item">
                        <a class="nav-link fw-bold active" aria-current="page" href="#home"><i
                                class="bi bi-house-door mx-1"></i>Home</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link fw-bold" href="#about"><i class="bi bi-info-square mx-1"></i>About us</a>
                    </li>
                    <li class="nav-item dropdown fw-bold">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-boxes mx-1"></i>Features
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item fw-bold" href="#feature-questions">Questions</a></li>
                            <li><a class="dropdown-item fw-bold" href="#feature-posts">Posts & Articles</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item fw-bold" href="#feature-groups">Groups</a></li>
                        </ul>
                    </li>
                   
                   
                </ul>

                <div class="d-flex justify-content-around align-items-center">
                    <a class="link-primary fs-5 mx-1" href="#"><i class="bi bi-facebook"></i></a>
                    <a class="link-success fs-5 mx-1" href="#"><i class="bi bi-whatsapp"></i></a>
                    <a class="link-danger fs-5 mx-1" href="#"><i class="bi bi-envelope-at-fill"></i></a>
                    <div class="vr mx-1"></div>
                    <a class="link-dark fs-5 mx-1" href="#"><i class="bi bi-github"></i></a>
                </div>
                <div class="d-flex justify-content-around align-items-center">
                    @guest
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="btn btn-outline-primary" type="submit">Login <i
                                    class="bi bi-box-arrow-in-right"></i></a>
                        @endif
                        @if (Route::has('register'))
                            <div class="vr mx-1"></div>
                            <a href="{{ route('register') }}" class="btn btn-primary" type="submit">Join us Now! <i
                                    class="bi bi-arrow-right"></i></a>
                        @endif
                    @else
                        <a href="{{ route('home') }}" class="btn btn-primary" type="submit">
                            <i class="bi bi-ui-radios-grid mx-1"></i>Dashboard <i class="bi bi-arrow-right"></i></a>
                    @endguest
                </div>
            </div>
    </nav>
    <section style="margin-top: 5rem" id="home" class="container animate__animated animate__fadeInUp mb-3"
        style="--animate-duration: 1.5s;">
        <div class="row flex-column-reverse flex-md-row">
            <div class="col-md col-12 d-flex flex-column align-items-start justify-content-center mb-sm-2 ">
                <h1 class="fs-1 fw-bold mb-2">Discover <strong class="text-primary"> &ldquo;Syrian Virtual University
                        Community System&rdquo;</strong> and get engaged with Us</h1>
                <p class="text-mute">
                    Describe your problem We answers it<br> with us you will get Help, Friends, Mates and <strong
                        class="text-primary">
                        &ldquo;Answers&rdquo;</strong> Join us now</p>
                <a href="" class="btn btn-primary">Explore Our Community</a>
            </div>
            <div class="col col-md col-sm-12 mb-sm-3">
                <figure class="figure">
                    <img src="/images/back_img.jpg" class="figure-img img-fluid rounded" alt="...">
                </figure>
                {{-- <img class="img-fluid rounded" src=""  alt=""> --}}
            </div>
        </div>
        <hr>
        <div class="row text-secondary mt-2">
            <div class="col-12 col-md-3 p-1 d-flex align-items-center justify-content-start">
                <i class="bi bi-question-square fs-3 mx-1"></i>
                <h5 class="fw-bold mb-0 text-secondary">Questions & Answers</h5>
            </div>
            <div class="col-12 col-md-3 p-1 d-flex align-items-center justify-content-start">
                <i class="bi bi-openai fs-3 mx-1"></i>
                <h5 class="fw-bold mb-0  text-secondary">AI Supported</h5>
            </div>
            <div class="col-12 col-md-3 p-1 d-flex align-items-center justify-content-start">
                <i class="bi bi-folder m-1 fs-3 mx-1"></i>
                <h5 class="fw-bold mb-0 text-secondary">Articles & Posts</h5>
            </div>
            <div class="col-12 col-md-3 p-1 d-flex align-items-center justify-content-start">
                <i class="bi bi-graph-up-arrow fs-3 mx-1"></i>
                <h5 class="fw-bold mb-0  text-secondary">Community Validation</h5>
            </div>
        </div>
        <hr>
    </section>
    <section id="about" class="container  py-3 mb-3">
        <h1 class="text-center text-underline fw-bold mb-3">About <strong class="text-primary">
                &ldquo;AnswersHUB&rdquo;</strong></h1>
        <hr>
        <div class="row ">
            <div class="col">
                <img src="/images/back_img.jpg" alt="" class="img-thumbnail">
            </div>
            <div class="col">
                <h3 class="fw-bold">Syrian Virtual University Community System Leads students to engage with all!</h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ad voluptate facere esse hic quis, maxime
                    temporibus, architecto quaerat nostrum consequuntur quia aliquam cumque sequi ut modi doloribus
                    neque ipsum debitis.</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <input class="form-check-input me-1" type="checkbox" checked readonly id="firstCheckbox">
                        <label class="form-check-label" for="firstCheckbox">Questions' Answers & problem
                            solving</label>
                    </li>
                    <li class="list-group-item">
                        <input class="form-check-input me-1" type="checkbox" checked readonly id="secondCheckbox">
                        <label class="form-check-label" for="secondCheckbox">Articles, Topics and discussion
                            forums</label>
                    </li>
                    <li class="list-group-item">
                        <input class="form-check-input me-1" type="checkbox" checked readonly id="thirdCheckbox">
                        <label class="form-check-label" for="thirdCheckbox">AI Solution Provider</label>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section id="feature-questions" class="container py-3 mb-3">
        <h1 class="text-center fw-bold">Discover Latest <strong class="text-primary">Solved Problems</strong> </h1>
        <hr>
        <div class="row my-3">
            @foreach ($questions as $question)
                <div class="col-4">
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md">
                                <div
                                    class="card-header border-0 d-flex flex-row align-items-center justify-content-start bg-white">
                                    <img id="profileImage" width="30" height="30"
                                        @if ($question->user->profile->photo != null) src="images/profile/{{ $question->user->profile->photo }}" @else src="images/img.jpg" @endif
                                        class="rounded-circle m-1" alt="...">
                                    <div class="d-flex flex-column ">
                                        <h5 class="mb-0">{{ $question->user->profile->name }} - <strong
                                                class="badge bg-primary-subtle text-primary">{{ $question->group->name }}</strong>
                                        </h5>
                                    </div>

                                </div>

                                <div class="card-body">
                                    <h5> <strong
                                            class="badge bg-success-subtle rounded-pill text-success-emphasis">{{ $question->category->name }}</strong>
                                    </h5>

                                    <h5 class="card-title">{{ $question->title }}</h5>
                                    <div class="mb-0 text-body-secondary">{{ $question->updated_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </section>
    <section id="feature-posts" class="container py-3 mb-3">
        <h1 class="text-center fw-bold">Discover Latest <strong class="text-primary">Topics</strong> </h1>
        <hr>
        <div class="row g-2 my-3">
            @foreach ($posts as $post)
                <div class="col-4">
                    <div class="card">
                        <img src="/images/{{ $post->poster }}" height="150" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5> <strong
                                    class="badge bg-success-subtle rounded-pill text-success-emphasis">{{ $post->category->name }}</strong>
                            </h5>

                            <h5 class="card-title">{{ $post->title }}</h5>
                            <a href="#" class="btn btn-primary">Show it</a>
                        </div>
                        <div
                            class="card-header border-0 d-flex flex-row align-items-center justify-content-start bg-white">
                            <img id="profileImage" width="30" height="30"
                                @if ($post->user->profile->photo != null) src="images/profile/{{ $post->user->profile->photo }}" @else src="images/img.jpg" @endif
                                class="rounded-circle m-1" alt="...">
                            <div class="d-flex flex-column ">
                                <h5 class="mb-0">{{ $post->user->profile->name }} - <strong
                                        class="badge bg-primary-subtle text-primary">{{ $post->group->name }}</strong>
                                </h5>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </section>
    <section id="feature-groups" class="container py-3 mb-3">
        <h1 class="text-center fw-bold">Explore <strong class="text-primary">Groups and programs</strong> </h1>
        <hr>
        <div class="row g-3">
            @foreach ($groups as $group)
                <div class="col-3">
                    <div class="p-1 d-flex flex-row align-items-center justify-content-center">
                        <img src="/images/{{ $group->poster }}" width="50" height="50" alt=""
                            class="rounded mx-1">
                        <div>
                            <h6 class="fw-bold mb-0 text-secondary">{{ $group->name }}</h6>
                            <p class="text-mute text-truncate">{{ $group->description }}</p>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <section class="container mb-3 py-3">
        <div class="card bg-primary-subtle p-3">
            <div class="row">
                <div class="col-6 ">
                    <span class="text-primary">Become a AnswersHUB Teammate</span>
                    <h2>You can join with AnswersHUB Team as <strong class="text-primary">Teammate ?</strong> </h2>
                </div>
                <div class="col-6 d-flex align-items-center justify-content-center">
                    <a href="" class="btn btn-primary">Apply Now</a>
                </div>
            </div>
        </div>
    </section>
    <section id="feature-posts" class="container py-3 mb-3">
        <h1 class="text-center fw-bold">Meet our <strong class="text-primary">Team</strong> </h1>
        <hr>
        <div class="row g-2 my-3">
            @foreach ($profiles as $profile)
                <div class="col-4">
                    <div class="card p-1">
                        <img width="100" height="100"
                            @if ($profile->photo != null) src="images/profile/{{ $profile->photo }}" @else src="images/img.jpg" @endif
                            class=" rounded-circle mx-auto" alt="...">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $profile->name }}</h5>
                            <p class="card-text">Role</p>
                            <p class="card-text text-truncate text-wrap">{{ $profile->bio }}</p>
                            <div class="d-flex flex-row align-items-center justify-content-center">
                                <i class="bi bi-facebook mx-1 fs-5"></i>
                                <i class="bi bi-whatsapp mx-1 fs-5"></i>
                                <i class="bi bi-linkedin mx-1 fs-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </section>
    <hr>
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-4 mb-0 text-body-secondary">© 2025 Company, Inc</p> <a href="/"
                class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none"
                aria-label="Bootstrap"> <img src="/images/logo.png" alt="Bootstrap" width="80" height="45">
            </a>
            <ul class="nav col-md-4 justify-content-end">
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Features</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Pricing</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">FAQs</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">About</a></li>
            </ul>
        </footer>
    </div>
</body>

</html>
