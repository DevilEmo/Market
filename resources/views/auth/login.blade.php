@extends('layouts.app')

@section('content')
    <div class="row" style="justify-content:flex-end">
        
        <div class="col-md-6">
            <div style="background-color:whitesmoke;border:0px;">
                    <div class="row mb-3">
                        <img class="m-auto p-3" src="../images/resources_images/logo_real.png" width="200" height="200">
                    </div>
                    <form method="POST"  onsubmit="return checkForm(this);" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-12 col-sm-12 col-md-10 col-lg-6 m-auto">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="username" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 col-sm-12 col-md-10 col-lg-6 m-auto">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="password" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-1 offset-lg-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <div class="col-md-8 offset-md-1 offset-lg-3">
                                <button type="submit" name="myButton" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
            </div>
        </div>
        <div class="col-md-6">
            <h4 class="text-muted text-center"><b>About our Company</b></h4>
            <blockquote class="text-center text-muted">Our Vision and Mission</blockquote>
            <div style="border-left:3px solid green;">
                <div>
                    <div>
                        <h5 class="pb-2 text-center text-muted" style="padding:5px;"><b>Vision</b></h5>
                    </div>
                    <p class="p-3 text-muted"><em> A clean and prosperous community with an existing market to fulfill a public purpose, showcase a community’s unique character and culture while serving its everyday shopping needs.</em></p>
                </div>
                <div>
                    <div>
                        <h5 class="text-center text-muted" style="padding:5px;"><b>Mission</b></h5>
                    </div>
                    <p class="p-3 text-muted"><em>To enhance the administration of market and to be a self-sustaining unit of the municipal government;
                    To increase/improve collections of market fees; and 
                    To improve the performance of employees vis-à-vis by establishing a good harmonious relationship among employees, stall holders, and customers.</em></p>
                </div>
            </div>
        </div>

        @endsection
</div>
