@extends('layouts.app')

@section('content')
<div class="container">
    
    <ol class="breadcrumb d-flex justify-content-between">
        <h3>My Album</h3>
        <span>
            <a href="{{ route('album.create') }}">
                <button class="btn btn-primary">Create New Album</button>
            </a>
        </span>
        
    </ol>

    <div class="row">
        <div class="col-md-12">
            <index></index>
        </div>
    </div>

</div>
@endsection