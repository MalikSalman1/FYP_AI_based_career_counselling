@extends('parent.layouts.main')
@section('content')
<!-- Header Start -->

<div class="container-fluid hero-header bg-light py-5 mb-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <!-- if any errors show here and finish after 5 seconds -->
              
               
                <div class="col-lg-6">
                <form enctype="multipart/form-data" method="POST" action="{{route('signup')}}">
                    @csrf
                        <div class="row g-3">
                            <h2 class="text-primary">Signup</h2>
                               @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li style="color: red;">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                            @endif
                            <?php
                            $inputDetails = array(
                                array("input_name" => "name", "type" => "text","label"=>"Your Name"),
                                array("input_name" => "email", "type" => "email","label"=>"Your Email"),
                                array("input_name" => "image", "type" => "file","label"=>"Your Image"),
                                array("input_name" => "password", "type" => "password","label"=>"Your Password"),
                                array("input_name" => "password_confirmation", "type" => "password","label"=>"Confirm Password")
                            );
                             ?>
                            @foreach($inputDetails as $inputDetail)
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="{{$inputDetail['type']}}" name="{{$inputDetail['input_name']}}" class="form-control" id="{{$inputDetail['input_name']}}" placeholder="Your {{$inputDetail['input_name']}}">
                                    <label for="{{$inputDetail['input_name']}}">{{$inputDetail['label']}}</label>
                                </div>
                            </div>
                            @endforeach
                           
                            
                            
                           
                           
                            
                            <div class="col-12">
                                <button class="btn btn-primary py-3 px-4" type="submit">Signup</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 animated fadeIn">
                    <img class="img-fluid animated pulse infinite" style="animation-duration: 3s;" src="https://img.freepik.com/free-vector/mobile-login-concept-illustration_114360-83.jpg?w=996&t=st=1702193150~exp=1702193750~hmac=516e0cd0b11f1c0734cdec8fb9ecb7b1f8c075d90f835a97f441948698be56b9"
                        alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


@endsection