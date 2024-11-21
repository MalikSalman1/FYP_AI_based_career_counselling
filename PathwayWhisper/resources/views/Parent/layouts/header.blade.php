<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PathwayWhispers</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{url('/Parent_resources/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{url('/Parent_resources/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{url('/Parent_resources/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{url('/Parent_resources/css/style.css')}}" rel="stylesheet">
</head>

<body>
   
<div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 px-4 px-lg-5">
        <a href="index.html" class="navbar-brand d-flex align-items-center">
            <h2 class="m-0 text-primary"><img class="img-fluid me-2" src="img/icon-1.png" alt=""
                    style="width: 45px;">Pathway Whispers</h2>
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-4 py-lg-0">
                <a href="{{url('/')}}" class="nav-item nav-link active">Home</a>
                <a href="{{url('/forum')}}" class="nav-item nav-link">Forum</a>
                <a href="{{url('/predictor')}}" class="nav-item nav-link">Predictor</a>
                <a href="{{url('/chatbot')}}" class="nav-item nav-link">Chatbot</a>
                {{-- if user is mentor --}}
                @if(Auth::check() && Auth::user()->role == 'mentor')
                {{-- Create Live Stream --}}
                <a href="{{url('/live_stream')}}" class="nav-item nav-link">Live Stream</a>
                @elseif(Auth::check())
                {{-- View Live streams --}}
                <a href="{{url('/live_streams')}}" class="nav-item nav-link">Live Streams</a>
                @endif
                @if(Auth::check())
                <a href="{{url('/profilesettings')}}" class="nav-item nav-link">Profile Settings</a>
                <a href="{{url('/logout')}}" class="nav-item nav-link">Logout</a>
                @else
                <a href="{{url('/signup')}}" class="nav-item nav-link">Signup</a>
                <a href="{{url('/login')}}" class="nav-item nav-link">Login</a>
                @endif
                
            </div>
            
        </div>
    </nav>
    <!-- Navbar End -->
