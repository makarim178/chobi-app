@extends('layouts.app')

@section('content')
<div class="container">
    @if($userBgPic)
        <img src="{{ Storage::url($userBgPic) }}" alt="bgPic" style="width: 100%">
    @else
        <img src="{{ asset('banner') }}/bgPic.jpg" alt="bgPic" style="width: 100%">
    @endif
    
    @if( Auth::check() && auth()->user()->id!=$userId)
        <follow user-id="{{ $userId }}" follows={{ $follows }}></follow>
    @endif
    {{-- <div class="jumbotron jumbotron-fluid text-center">
        <h1 class="display-4">
            Share your Photos
        </h1>
        <p class="lead">
            Share your photos with everyone...
    
        </p> 
    </div> --}}

    <div class="row mt-4">
        @foreach ($albums as $album)
        <div class="col-lg-3">
            <cardalbum :album="{{ $album }}" albumlink="{{ route('view.album', [$album->slug, $album->id]) }}" ></cardalbum>
        </div>
            {{-- <div class="col-lg-3">
                <div class="card">
                    <img src="{{ asset('album') }}/{{ $album->image }}" alt="" class="card-image-top">
                    <div class="card-body">
                        <h5 class="card-title">
                            <center>{{ $album->name }}</center>
                        </h5>
                        <center>
                            <a href="{{ route('view.album', [$album->slug, $album->id]) }}" class="btn btn-primary">View Album</a>
                        </center>
                    </div>

                </div>
            </div> --}}
        @endforeach
    </div>
    
</div>
@endsection
