<!DOCTYPE html>
<html lang="en" class="theme-fs-md">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PathwayWhispers</title>
  <!-- Config Options -->
  
  <!-- End Config Options -->
  <link rel="shortcut icon" href="favicons/images-favicon.ico">
  <link rel="stylesheet" href="{{url('/Forum_resources/css/css-libs.min.css')}}">
  <link rel="stylesheet" href="{{url('/Forum_resources/css/css-socialv.css')}}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500&amp;display=swap" rel="stylesheet">
  <!-- flatpickr css -->
  <link rel="stylesheet" href="{{url('Forum_resources/css/dist-flatpickr.min.css')}}">
  <!-- Sweetlaert2 css -->
  <link rel="stylesheet" href="{{url('/Forum_resources/css/dist-sweetalert2.min.css')}}">
  
  <!-- vanillajs css -->
  <link rel="stylesheet" href="{{url('/Forum_resources/css/css-datepicker.min.css')}}">
  <!-- color customizer css -->
  <link rel="stylesheet" href="{{url('/Forum_resources/css/css-customizer.css')}}">
</head>

<body class="  ">
 
  <!-- loader END -->
  <!-- Wrapper Start -->
  <div class="iq-top-navbar">
     <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar p-lg-0">
        <div class="container-fluid navbar-inner">
           <div class="d-flex align-items-center flex-lg-row-reverse gap-3 pb-2 pb-lg-0">
             
              <a href="{{url('/')}}" class="d-flex align-items-center gap-2 iq-header-logo">
                
                 <h3 class="logo-title d-none d-sm-block" data-setting="app_name">PathwayWhispers - Forum</h3>
              </a>
              
           </div>
      
           <ul class="navbar-nav navbar-list">
           
              <li class="nav-item dropdown user-dropdown">
                 <a href="javascript:void(0);" class="d-flex align-items-center dropdown-toggle" id="drop-down-arrow" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{url('/profile_images')}}/{{auth()->user()->image}}" class="img-fluid rounded-circle me-3" style="object-fit:cover;" alt="user" >
                    <div class="caption d-none d-lg-block">
                       <h6 class="mb-0 line-height">{{auth()->user()->name}}</h6>
                    </div>
                 </a>
                 <div class="sub-drop dropdown-menu caption-menu" aria-labelledby="drop-down-arrow">
                    <div class="card shadow-none m-0">
                       <div class="card-header ">
                          <div class="header-title">
                             <h5 class="mb-0 ">Hello {{auth()->user()->name}}</h5>
                          </div>
                       </div>
                       <div class="card-body p-0 ">
                          
                          
                          <div class="d-flex align-items-center iq-sub-card border-0">
                             <span class="material-symbols-outlined">
                                home
                             </span>
                             <div class="ms-3">
                                <a href="{{url('/')}}" class="mb-0 h6">
                                   Home of Whispers
                                </a>
                             </div>
                          </div>
                          
                          <div class="d-flex align-items-center iq-sub-card">
                             <span class="material-symbols-outlined">
                                 logout
                             </span>
                             <div class="ms-3">
                                <a href="{{url('logout')}}" class="mb-0 h6">
                                   Logout
                                </a>
                             </div>
                          </div>
                        
                       </div>
                    </div>
                 </div>
              </li>
           </ul>        
        </div>
     </nav>
  </div>  

      <div>
    <div class="position-relative">
    </div>
    <div id="content-page" class="content-page">
<div class="container">
   <div class="row">
      <div class="col-lg-12 row m-0 p-0">
         <div class="col-sm-12">
            <div id="post-modal-data" class="card card-block card-stretch card-height">
               <div class="card-header d-flex justify-content-between">
                  <div class="header-title">
                     <h4 class="card-title">Create Post</h4>
                  </div>
               </div>
               <div class="card-body">
                  <div class="d-flex align-items-center">
                     <div class="user-img">
                        <img src="{{url('/profile_images')}}/{{auth()->user()->image}}" alt="userimg" class="avatar-60 rounded-circle" style="object-fit:cover" >
                     </div>
                     <form class="post-text ms-3 w-100 " data-bs-toggle="modal" data-bs-target="#post-modal" action="javascript:void();">
                        <input type="text" class="form-control rounded" placeholder="Write something here..." style="border:none;">
                     </form>
                  </div>
                  <hr>
                  
               </div>
               <div class="modal fade" id="post-modal" tabindex="-1" aria-labelledby="post-modalLabel" aria-hidden="true">
                  <div class="modal-dialog   modal-fullscreen-sm-down">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title" id="post-modalLabel">Create Post</h5>
                           <a href="javascript:void(0);" class="lh-1" data-bs-dismiss="modal">
                              <span class="material-symbols-outlined">close</span>
                           </a>
                        </div>
                        <div class="modal-body">
                           <div class="d-flex align-items-center">
                              <div class="user-img">
                                 <img src="{{url('/profile_images')}}/{{auth()->user()->image}}" alt="userimg" class="avatar-60 rounded-circle img-fluid" >
                              </div>
                              <form class="post-text ms-3 w-100" action="{{route('create_post')}}" method="post">
                                 @csrf
                                 <input type="text" name="body" id="postbody" class="form-control rounded" placeholder="Write post here..." style="border:none;">
                              
                           </div>
                          
                           <div class="other-option">
                              <div class="d-flex align-items-center justify-content-between">
                                 
                                 
                              </div>
                           </div>
                           <button type="submit" id="postbutton" class="btn btn-primary d-block w-100 mt-3">Post</button>
                           </form>
                           <script>
                              // if the postbody is empty, disable the post button
                              document.getElementById("postbutton").disabled = true;
                              document.getElementById("postbody").addEventListener("keyup", function() {
                                  if (document.getElementById("postbody").value == "") {
                                      document.getElementById("postbutton").disabled = true;
                                  } else {
                                      document.getElementById("postbutton").disabled = false;
                                  }
                              });
                           </script>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="container">
         @foreach($posts as $post)
         <div class="col-sm-12">
            <div class="card card-block card-stretch card-height">
               <div class="card-body">
                  <div class="user-post-data">
                     <div class="d-flex justify-content-between">
                        <div class="me-3">
                           <img class="avatar-60 rounded-circle"  style="object-fit:cover" src="{{url('/profile_images')}}/{{$post->image}}" alt="" >
                        </div>
                        <div class="w-100">
                           <div class="d-flex justify-content-between">
                              <div class="" style="">
                                 <h5 class="mb-0 d-inline-block">{{$post->name}}</h5>
                                 <div style="display: flex;gap:10px">
                                 @if($post->role=="mentor")
                                 <p style="background: rgb(98, 137, 141);color:white;text-align:center;border-radius:30px;padding-right:4px;padding-left:4px">Mentor</p>
                                 @endif
                                 @if($post->user_id==auth()->user()->id)
                                 <p style="background: rgb(237, 14, 6);text-align:center;border-radius:30px;padding-right:4px;padding-left:4px">
                                    <a style="color: white" href="{{url('/deletepost')}}/{{$post->id}}">Delete</a>   
                                 </p>
                                 @endif
                                 </div>
                                 
                              </div>
                              
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="mt-3">
                     <p>{{$post->body}}</p>
                  </div>
                  
                  <div class="comment-area mt-3">
                     <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div class="like-block position-relative d-flex align-items-center">
                           <div class="d-flex align-items-center">
                             
                              
                              </div>
                           </div>
                           <div class="total-comment-block">
                              <div class="dropdown">
                                 <span class="dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                 {{$post->comments_count}} Comment
                                 </span>
                                 
                              </div>
                           </div>
                        </div>
                        
                     </div>
                     <hr>
                     <ul class="post-comments list-inline p-0 m-0">
                        @foreach($post->comments as $comment)
                        <li class="mb-2">
                           <div class="d-flex">
                              <div class="user-img">
                                 <img src="{{url('/Profile_images')}}/{{$comment->image}}" alt="userimg" class="avatar-35 rounded-circle img-fluid" >
                              </div>
                              <div class="comment-data-block ms-3">
                                 <h5>{{$comment->name}}@if($comment->role=="mentor")
                                    <span style="background: rgb(98, 137, 141);color:white;text-align:center;border-radius:30px;padding:4px;font-size:9px">Mentor</span>
                                    @endif
                                 @if(Auth()->user()->id==$comment->user_id)
                                 <span style="background: rgb(237, 14, 6);color:white;text-align:center;border-radius:30px;padding:4px;font-size:9px">
                                    <a style="color: white" href="{{url('/deletecomment')}}/{{$comment->id}}">Delete</a>
                                 </span>
                                 @endif
                                 </h5>
                                 <p class="mb-0">{{$comment->body}}</p>
                                 
                              </div>
                           </div>
                        </li>
                        @endforeach
                        
                     </ul>
                     <form class="comment-text d-flex align-items-center mt-3" method="post" action="{{route('create_comment')}}">
                        <!-- hidden input -->
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        @csrf
                        <input type="text" name="comment" class="form-control rounded" placeholder="Enter Your Comment">
                        <div class="comment-attagement d-flex">
                           <!-- send button -->
                           <button type="submit" class="btn btn-primary rounded"><span class="material-icons-outlined">Send</span></button>

                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         @endforeach
         </div>
         
         
        
      </div>
      
      
   </div>
</div>
    </div>
  </div>
  <!-- Wrapper End-->
  <!-- offcanvas start -->
  
  <footer class="iq-footer bg-white">
     <div class="container-fluid">
        <div class="row">
           <div class="col-lg-6">
              <ul class="list-inline mb-0">
                 <li class="list-inline-item"><a href="privacy-policy.html">Privacy Policy</a></li>
                 <li class="list-inline-item"><a href="terms-of-service.html">Terms of Use</a></li>
              </ul>
              </div>
              <div class="col-lg-6 d-flex justify-content-end">
              Copyright 2020
              <a href="#">SocialV</a>
              All Rights Reserved.
         </div>
         </div>
        </div>
     </footer>  <!-- Live Customizer start -->
  <!-- Setting offcanvas start here -->
 
  <!-- Settings sidebar end here -->
  
  

  <div class="offcanvas offcanvas-bottom share-offcanvas" tabindex="-1" id="share-btn" aria-labelledby="shareBottomLabel">
     <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="shareBottomLabel">Share</h5>
         <div class="close-icon" data-bs-dismiss="offcanvas">
              <svg xmlns="http://www.w3.org/2000/svg" width="24px" class="h-5 w-5" viewbox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
              </svg>
          </div>
     </div>
     <div class="offcanvas-body small">
        <div class="d-flex flex-wrap align-items-center">
           <div class="text-center me-3 mb-3">
              <img src="{{url('parent_resources/img/icon-08.png')}}" class="img-fluid rounded mb-2" alt="" >
              <h6>Facebook</h6>
           </div>
           <div class="text-center me-3 mb-3">
              <img src="{{url('parent_resources/img/icon-09.png')}}" class="img-fluid rounded mb-2" alt="" >
              <h6>Twitter</h6>
           </div>
           <div class="text-center me-3 mb-3">
              <img src="{{url('parent_resources/img/icon-10.png')}}" class="img-fluid rounded mb-2" alt="" >
              <h6>Instagram</h6>
           </div>
           <div class="text-center me-3 mb-3">
              <img src="{{url('parent_resources/img/icon-11.png')}}" class="img-fluid rounded mb-2" alt="" >
              <h6>Google Plus</h6>
           </div>
           <div class="text-center me-3 mb-3">
              <img src="{{url('parent_resources/img/icon-13.png')}}" class="img-fluid rounded mb-2" alt="" >
              <h6>LinkedIn</h6>
           </div>
           <div class="text-center me-3 mb-3">
              <img src="{{url('parent_resources/img/icon-12.png')}}" class="img-fluid rounded mb-2" alt="" >
              <h6>YouTube</h6>
           </div>
        </div>
     </div>
  </div>  
  <!-- Backend Bundle JavaScript -->
  <script src="{{url('/forum_resources/js/js-libs.min.js')}}"></script>
  <!-- Lodash Utility -->
  <script src="{{url('/forum_resources/js/lodash-lodash.min.js')}}"></script>
  <!-- Utilities Functions -->
  <script src="{{url('/forum_resources/js/setting-utility.js')}}"></script>
  <!-- Settings Script -->
  <script src="{{url('/forum_resources/js/setting-setting.js')}}"></script>
  <!-- Settings Init Script -->
  <script src="{{url('/forum_resources/js/setting-setting-init.js')}}" defer></script>
  <!-- slider JavaScript -->
  <script src="{{url('/forum_resources/js/js-slider.js')}}"></script>
  <!-- masonry JavaScript --> 
  <script src="{{url('/forum_resources/js/js-masonry.pkgd.min.js')}}"></script>
  <!-- SweetAlert JavaScript -->
  <script src="{{url('/forum_resources/s/js-enchanter.js')}}"></script>
  <!-- Sweet-alert Script -->
  <script src="{{url('/forum_resources/js/dist-sweetalert2.min.js')}}" async></script>
  <script src="{{url('/forum_resources/js/js-sweet-alert.js')}}" defer></script>
  <!-- Chart Custom JavaScript -->
  <script src="{{url('/forum_resources/js/js-customizer.js')}}"></script>
  <!-- app JavaScript -->
  <script src="{{url('/forum_resources/js/charts-weather-chart.js')}}"></script>
  <script src="{{url('/forum_resources/js/js-app.js')}}"></script>
  <!-- Flatpickr Script -->
  <script src="{{url('/forum_resources/js/dist-flatpickr.min.js')}}"></script>
  <!-- fslightbox Script -->
  <script src="{{url('/forum_resources/js/js-fslightbox.js')}}" defer></script> 
  <!-- vanilla Script -->
  <script src="{{url('/forum_resources/js/js-datepicker.min.js')}}"></script>
  <!--lottie Script -->
  <script src="{{url('/forum_resources/js/js-lottie.js')}}"></script>
  <!--select2 Script -->
  <script src="{{url('/forum_resources/js/js-select2.js')}}"></script>
  


</body>

</html>
