@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">

                    <ul class="nav nav-tabs" role="tablist">
                        {{-- <li class="nav-item">
                          <a class="nav-link active" href="#profile" role="tab" data-toggle="tab">Profile</a>
                        </li> --}}
                        <li class="nav-item">
                          <a class="nav-link active" href="#buzz" role="tab" data-toggle="tab">Following</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#profilepic" role="tab" data-toggle="tab">Profile Picture</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#bgpic" role="tab" data-toggle="tab">Background Picture</a>
                        </li>
                      </ul>
                      
                      <!-- Tab panes -->
                      <div class="tab-content">
                        {{-- <div role="tabpanel" class="tab-pane fade in active" id="profile">Manage your profile</div> --}}
                        <div role="tabpanel" class="tab-pane fade in active" id="buzz">

                            <table class="table table-strip">
                                <thead>
                                    <th>Name</th>
                                    <th>Photo</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($followings as $follow)
                                    <tr>
                                        <td>{{ $follow->userfollow->name }}</td>
                                        <td >
                                            <a href="{{ route('user.album', [$follow->userfollow->id]) }}">
                                                <img src="{{ Storage::url($follow->userfollow->profilePic) }}" alt="{{ $follow->userfollow->name }}" width="25%" class="img img-thumbnail rounded-circle">
                                            </a>
                                        </td>
                                        <td>
                                            @if( Auth::check() && auth()->user()->id!=$userId)
                                                <follow user-id="{{ $userId }}" follows={{ $follows }}></follow>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="profilepic">
                            <avatar userid="{{ auth()->user()->id }}"></avatar>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="bgpic">
                            
                            <bgpic userid="{{ auth()->user()->id }}"></bgpic>
                        </div>
                      </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
