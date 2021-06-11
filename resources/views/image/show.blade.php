@extends('layouts.app')

@section('content')
<div class="container fluid">

    <div class="row">
        <div class="col-md-12">
            <add-image :image="{{ $image }}"></add-image>
        </div>
    </div>
</div>
@endsection
