<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">
     <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>
    <style>
        .editor-preview img, .answer-preview img{
            max-width: 100%;
            height: auto;
        }
        .btn-icon {
            border: none;
            background: none;
            padding: 0;
        }
    </style>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">

    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body style="background:#f0f0f0;">
    <div id="app">
        <nav class="navbar navbar-expand-md sticky-top navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                     <img src="/images/logo.png" alt="Bootstrap" width="80" height="45">
                  </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
 @auth
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link fw-bold active" aria-current="page" href="{{route('home')}}"><i
                                class="bi bi-house-door mx-1"></i>Home</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link fw-bold"  aria-current="page" href="{{route('groups.index')}}"><i class="bi bi-people mx-1"></i>Groups</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link fw-bold" aria-current="page" href="{{route('categories.index')}}"><i class="bi bi-grid-3x3-gap mx-1"></i>Categories</a>
                          </li>
                           <li class="nav-item">
                            <a class="nav-link fw-bold" aria-current="page" href="{{route('admin.user-management')}}"><i class="bi bi-person-check mx-1"></i>Admins</a>
                          </li>
                    </ul>
                   
                    <form class="p-2 bg-white me-2 ">
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Search here ..." aria-label="Search" aria-describedby="button-addon2">
                          <button class="btn btn-primary" type="button" id="button-addon2"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto align-items-center">
                        <!-- Authentication Links -->
                        <div class="dropdown-center">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                               <i class="bi bi-bell"></i>
                            </button>
                            <ul class="dropdown-menu shadow">
                                @if (auth()->user()->unreadNotifications->count()>0)
                                     @foreach(auth()->user()->unreadNotifications as $notification)
                                <li><a class="dropdown-item" 
                                    href="{{ $notification->data['url'] }}">
                                   @if (isset($notification->data['commenter']))
                                       
                                  <strong>{{ $notification->data['commenter'] }}</strong>
                                   @endif 
                                    {{ $notification->data['message'] }}
                                </a></li>

                                @endforeach
                                @else
                                <li class="text-center">No Notification</li>
                                @endif
                               
                            </ul>
                            </div>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   <img id="profileImage" width="30" height="30"
               @if (Auth::user()->profile->photo!=null) src="{{ asset('images/profile/' . Auth::user()->profile->photo) }}" @else src="{{ asset('images/img.jpg') }}" @endif
                 
                 class="rounded-circle m-1 "
                 alt="...">
                                   
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    <a class="dropdown-item" href="{{ route('profile.index') }}"
                                       >
                                        Profile
                                    </a>
                                </div>
                            </li>
                       
                    </ul>
                  
                </div>
                @else
                 <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarSupportedContent">
                 @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="btn btn-outline-primary" type="submit">Login <i
                                    class="bi bi-box-arrow-in-right"></i></a>
                        @endif
                        @if (Route::has('register'))
                            <div class="vr mx-1"></div>
                            <a href="{{ route('register') }}" class="btn btn-primary" type="submit">Create New Account <i
                                    class="bi bi-arrow-right"></i></a>
                        @endif
                 </div>
                  @endauth
            </div>
        </nav>

        <main class="py-4" style="background:#f0f0f0;">
            @if (session('resent'))
            <div class="alert alert-success" role="alert">
                A fresh verification link has been sent to your email address.
            </div>
        @endif
        @auth
            @if (!auth()->user()->hasVerifiedEmail())
            <div class="alert alert-warning" role="alert">
                Your email address is not verified.

                <form action="{{ route('verification.resend') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Click here to resend verification email</button>.
                </form>
            </div>
            @endif
        @endauth
            @yield('content')
        </main>
    </div>
<div aria-live="polite" aria-atomic="true" style="position: fixed; top: 1rem; right: 1rem; z-index: 1080;">
  <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="10000">
    <div class="toast-header">
      <strong class="me-auto" id="toastTitle">Notification</strong>
      <small>الآن</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body" id="toastBody">
      هنا نص الإشعار
    </div>
  </div>
</div>

<script>
   document.addEventListener('DOMContentLoaded', function () {
  // استورد Bootstrap Toast
  var toastEl = document.getElementById('liveToast');
  var toast = new bootstrap.Toast(toastEl);

  // دالة لتحديث النص وإظهار التوست
  function showToast(title, message, url) {
     console.log("tostshowed")
    document.getElementById('toastTitle').textContent = title;
    document.getElementById('toastBody').innerHTML = `<a href="${url}" class="text-decoration-none">${message}</a>`;
    toast.show();
    console.log("tostshowed")
  }

  // استمع للإشعارات من Laravel Echo
  Echo.private('App.Models.User.{{ Auth::id() }}')
    .notification((notification) => {
      showToast(notification.commenter, notification.message, notification.url);
      console.log(notification)
    });
});
</script>

</body>
</html>
