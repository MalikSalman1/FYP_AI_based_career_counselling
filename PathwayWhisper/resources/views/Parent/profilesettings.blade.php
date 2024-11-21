<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>PathwayWhispers</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    {{-- <link rel='stylesheet' type='text/css' media='screen' href='{{url('/livestream_resources/styles/main.css')}}'> --}}
    <link rel='stylesheet' type='text/css' media='screen' href='{{ url('/livestream_resources/styles/lobby.css') }}'>


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
    <link href="{{ url('/Parent_resources/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ url('/Parent_resources/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ url('/Parent_resources/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ url('/Parent_resources/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <style>
        .error {
            color: red;
            font-size: 12px;
        }
    </style>
    <div style="display: flex;flex-direction:column;height:100vh">
        <div>
            {{-- header --}}
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
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-4 py-lg-0">
                        <a href="{{ url('/') }}" class="nav-item nav-link active">Home</a>
                        <a href="{{ url('/forum') }}" class="nav-item nav-link">Forum</a>
                        <a href="{{ url('/predictor') }}" class="nav-item nav-link">Predictor</a>
                        <a href="{{ url('/chatbot') }}" class="nav-item nav-link">Chatbot</a>
                        {{-- if user is mentor --}}
                        @if (Auth::check() && Auth::user()->role == 'mentor')
                            {{-- Create Live Stream --}}
                            <a href="{{ url('/live_stream') }}" class="nav-item nav-link">Live Stream</a>
                        @else
                            {{-- View Live streams --}}
                            <a href="{{ url('/live_streams') }}" class="nav-item nav-link">Live Streams</a>
                        @endif
                        @if (Auth::check())
                            <a href="{{ url('/logout') }}" class="nav-item nav-link">Logout</a>
                        @else
                            <a href="{{ url('/signup') }}" class="nav-item nav-link">Signup</a>
                            <a href="{{ url('/login') }}" class="nav-item nav-link">Login</a>
                        @endif

                    </div>

                </div>
            </nav>
        </div>
        <div>
            {{-- main --}}
            <main id="room__lobby__container">

                <div id="form__container" >
                    <div id="form__container__header" class="pt-5">
                        <p>Change Profile Details</p>
                        
                    </div>


                    <form id="lobby__form" action="{{url('/profilesettings/update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{--  return back()->with('success','Profile updated successfully'); --}}
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="form__field__wrapper">
                            <label>Name</label>
                            <input type="text" name="name" placeholder="Enter your name" value="{{Auth()->user()->name}}" />
                            @error('name')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                       
                        {{-- image --}}
                        <div class="form__field__wrapper">
                            <label>Image</label>
                            <input type="file" name="image" accept="image/*" />
                            {{-- error message id --}}
                            @error('image')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        



                        <div class="form__field__wrapper">
                            <button type="submit">Change Now
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M13.025 1l-2.847 2.828 6.176 6.176h-16.354v3.992h16.354l-6.176 6.176 2.847 2.828 10.975-11z" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </main>
        </div>


        <main id="room__lobby__container">

            <div id="form__container" >
                <div id="form__container__header" class="pt-5">
                    <p>Change Password</p>
                    
                </div>


                <form id="lobby__form" action="{{url('/profilesettings/update_password')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- return back()->with('error_passchange','Current password is incorrect'); --}}
                    @if (session('errorpasschange'))
                        <div class="alert alert-danger">
                            {{ session('errorpasschange') }}
                        </div>
                    @endif
                        
                        {{-- return back()->with('success_passchange','Password changed successfully'); --}}
                        @if (session('successpasschange'))
                            <div class="alert alert-success">
                                {{ session('successpasschange') }}
                            </div>
                        @endif
                    
                    

                    <div class="form__field__wrapper">
                        <label>Old Password</label>
                        <input type="password" name="oldpassword" placeholder="Enter your password" />
                        @error('oldpassword')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form__field__wrapper">
                        <label>New Password</label>
                        <input type="password" name="password" placeholder="Enter your new password" />
                        @error('password')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form__field__wrapper">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" placeholder="Confirm your new password" />
                        @error('password_confirmation')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                   
                   
                    



                    <div class="form__field__wrapper">
                        <button type="submit">Change Password
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path
                                    d="M13.025 1l-2.847 2.828 6.176 6.176h-16.354v3.992h16.354l-6.176 6.176 2.847 2.828 10.975-11z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </main>

            <div class="container-fluid bg-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
       
                <div class="container-fluid copyright">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                                &copy; <a href="#">PathwayWhispers</a>, All Right Reserved.
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>


            <!-- Back to Top -->
            <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
                    class="bi bi-arrow-up"></i></a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('/Parent_resources/lib/wow/wow.min.js') }}"></script>
    <script src="{{ url('/Parent_resources/lib/easing/easing.min.js') }}"></script>
    <script src="{{ url('/Parent_resources/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ url('/Parent_resources/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ url('/Parent_resources/lib/counterup/counterup.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ url('Parent_resources/js/main.js') }}"></script>

</body>


</html>
