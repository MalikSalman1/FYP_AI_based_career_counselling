@extends('parent.layouts.main')
@section('content')
    <!-- Header Start -->

    <div class="container" style="display: flex; justify-content:center;flex-direction:column;align-items:center">
        <div class="row">
            <div class="col-12 my-4">
                <div class="section-title">
                    <h3>Active Live Streams</h3>
                </div>
            </div>
        </div>
        <div class="row" style="display: flex; align-items:center; justify-content:center; gap:20px">
            @foreach ($streams as $stream)
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="{{ url('/livestream_images') }}/{{ $stream->image }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ $stream->title }}</h5>
                        <p class="card-text">{{ $stream->description }}</p>
                        <a href="{{ url('stream') }}/{{ $stream->stream_key }}" class="btn btn-primary">Watch Stream</a>
                    </div>
                </div>
                
               
               
                
        </div>
        @endforeach
    </div>
@endsection
