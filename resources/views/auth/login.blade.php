
@extends('layouts.auth')
@section('title', 'Login')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    @include('layouts.common.success')
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-4 col-lg-offset-4 col-md-offset-3 col-sm-offset-3">
                    <form action="{{ route('login') }}" method="post">
                        {{ csrf_field() }}
                        <div class="card card-login card-hidden">
                            <div class="card-header text-center" data-background-color="red">
                                <h4 class="card-title">Login</h4>
                            </div>
                            <div class="card-content">
                                @include('layouts.common.error')
                                @include('layouts.common.warnings')
                                <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">list</i>
                                            </span>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Email/Phone No</label>
                                        <input type="text" name="email" value="{{ old('email') }}" class="form-control" required>
                                    </div>
                                </div>

                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">lock_outline</i>
                                        </span>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Password</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                </div>

                                {{-- <div class="input-group" style="margin-left: auto; margin-right: auto;">
                                    <div class="form-group label-floating">
                                        {!! app('captcha')->display(['data-theme' => 'dark']) !!}
                                    </div>
                                </div> --}}

                                <div class="checkbox input-group">
                                    <label>
                                        <input type="checkbox" name="remember" value="{{ old('remember') }}"> Remember Me
                                    </label>&nbsp;
                                    <a href="{{ route('password.request') }}" class="text-danger">
                                        <small>Forgot Your Password?</small>
                                    </a>
                                </div>

                            </div>
                            <div class="footer text-center">
                                <button type="submit" class="btn btn-danger"><i class="fa fa-sign-in"></i> Sign in</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
