@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron jumbotron-fluid text-center">
        <h1 class="display-4">
            Share your Photos
        </h1>
        <p class="lead">
            Share your photos with everyone...
    
        </p> 
    </div>

    <div class="flex justify-content-center">

        @if(Auth::check())
            <home-images :check="true"></home-images>
        @else
            <home-images :check="false"></home-images>
        @endif
        
        
    </div>

    <hr>
    
    <h1 class="text-center m-4">Albums</h1>

    <div class="row">

        @foreach ($albums as $album)
            <div class="col-lg-3">

                <cardalbum :album="{{ $album }}" albumlink="{{ route('view.album', [$album->slug, $album->id]) }}" ></cardalbum>
                {{-- <div class="card">
                    <img src="{{ asset('album') }}/{{ $album->image }}" alt="" class="card-image-top">
                    <div class="card-body">
                        <h5 class="card-title">
                            <center>{{ $album->name }}</center>
                        </h5>
                        <center>
                            <a href="{{ route('view.album', [$album->slug, $album->id]) }}" class="btn btn-primary">View Album</a>
                        </center>
                    </div>

                </div> --}}
            </div>
        @endforeach
    </div>
    {{ $albums->links() }}
</div>
@endsection
