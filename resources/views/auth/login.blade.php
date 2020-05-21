@extends('layouts.login')
@section('title', 'Register')
@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-top: 42px;">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="text-align: center;"><b>{{ __('Login') }}</b></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" id="orderForm">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                                <a href="{{ url('login/google') }}" class="btn btn-danger btn-social-icon btn-google-plus"><i class="fa fa-google-plus"> Login With Google</i></a> 
<!--                                <a href="{{url('register')}}" class="btn btn-primary">
                                    Register
                                </a>   -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/plugins/jquery.min.js"></script>
<script type='text/javascript' src='js/plugins/jquery.validate.js'></script>
<script type="text/javascript">
//            $("#btnsubmit").on("click",function(){

            var jvalidate = $("#orderForm").validate({
                rules: {   
                        email: {required: true},
                        password : {required: true},
                    },
                     messages: {
                         email: "Please Enter Email Address",
                         password: "Please Enter Password"
                       }  
                });
                
                $('#btnsubmit').on('click', function() {
                    $("#orderForm").valid();
                });
                
        </script>
@endsection
