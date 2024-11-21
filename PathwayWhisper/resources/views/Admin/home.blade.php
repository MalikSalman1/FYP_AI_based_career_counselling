@extends('admin.layouts.main')
@section('content')
 <!-- Content wrapper -->
 <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row" style="width: 100%;">
                <div class="col-lg-8 mb-4 order-0" style="width: 100%;">
                  <div class="card">
                    <div class="d-flex align-items-end row" >
                      <div class="col-sm-7">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Welcome
                        
                      
                            {{Auth()->user()->name}}! 🎉</h5>
                          <p class="mb-4">
                            PathwayWhispers< - Dashboard
                          </p>

                          
                        </div>
                      </div>
                      <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="{{url('frontend/assets/img/illustrations/man-with-laptop-light.png')}}"
                            height="140"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
               
               
               
              </div>
             
            </div>
            <!-- / Content -->
          
        
            @endsection
           
           