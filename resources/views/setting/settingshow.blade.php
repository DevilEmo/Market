@extends('layouts.app')
@section('content')
<div class="row m-0">
    <div class="col-12 pb-4">
        <div class="card">
        <h1 class="pt-3 text-muted" style="text-align: center;"><i>User Info</i></h1>
            <div class="card-body">
                
                <form action="{{route('setting.update',$user->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div style="display:flex;align-items:center;flex-direction:column;" class="mb-4">
                        <img src="/images/profile_images/{{Auth::user()->profile_image}}" class="mb-3" height="200px" width="200px"  alt="profile Image"
                        style="border-radius:50%;">
                        <div class="form-group">
                          <input type="file" name="profile_image">
                        </div>
                      </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control" name="name" value="{{Auth::user()->name}}" autocomplete="current-password">
                                </div>
                            </div>

                            {{-- <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                                <div class="col-md-8">
                                    <input id="email" type="text" class="form-control" name="email" value="{{Auth::user()->email}}" autocomplete="current-password">
                                </div>
                            </div> --}}

                            
                            <div class="form-group row">
                                <label for="birthday" class="col-md-4 col-form-label text-md-right">Birthday</label>

                                <div class="col-md-8">
                                    <input type="date" name="birthday" id="section" value="{{Auth::user()->birthday}}" class="form-control">
                                </div>
                            </div>

                            
                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>

                                <div class="col-md-8">
                                    <input type="text" name="address" id="section" class="form-control" value="{{Auth::user()->address}}" placeholder="Address">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="position" class="col-md-4 col-form-label text-md-right">Position</label>

                                <div class="col-md-8">
                                    <input type="text" name="position" id="section" class="form-control" value="{{Auth::user()->position}}" placeholder="Position">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4" style="display:flex;justify-content:flex-end">
                                    <button type="submit" class="btn btn-success">
                                        Update
                                    </button>
                                </div>
                            </div> 
                </form>
            </div>
        </div>
    </div>

    <div class="col-12 pb-4">
        <div class="card">
            <h1 class="pt-3 text-muted" style="text-align: center;"><i>Password</i></h1>
            <div class="card-body">
            <form action="{{ route('setting.store') }}" method="POST">
                    @csrf
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>
                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>
    
                            <div class="col-md-8">
                                <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">New Confirm Password</label>
    
                            <div class="col-md-8">
                                <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                            </div>
                        </div>
    
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4" style="display:flex;justify-content:flex-end">
                                <button type="submit" class="btn btn-success">
                                    Update
                                </button>
                            </div>
                        </div>    
            </form>
            </div>
        </div>
    
@endsection
</div>
     