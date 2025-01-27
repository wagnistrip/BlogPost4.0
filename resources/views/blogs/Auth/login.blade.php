<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title> Login | Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="favicon.png">

    <!-- App css -->
    <link href="{{ asset('login/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('login/assets/css/app.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('login/assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>

    <div class="auth-fluid" style="background-image: url({{ asset('login/assets/images/bg-auth.jpg') }}) ">
        <!--Auth fluid left content -->
        <div class="auth-fluid-form-box pb-4 px-3">
            <div class="align-items-center d-flex h-100">
                <div class="card-body">

                    <!-- Logo -->
                    <div class="auth-brand text-center">
                    </div>
                    <!-- title-->
                    <h3 class="mt-0 mb-4">Admin Login</h3>
                    @error('status')
                    <p class="text-danger mb-4" style="font-size: 13px"><i
                            class="mdi mdi-information-outline me-1"></i>{{ $message }}</p>
                    @enderror

                    <!-- form -->
                    <form method="POST" action="{{route('authenticate')}}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" autocomplete="email"
                                placeholder="Enter your email" autofocus>
                            @error('email')
                            <code id="email-error" class="text-danger">{{ $message }}</code>
                            @enderror
                        </div>
                        <div class="mb-3">

                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                autocomplete="current-password" placeholder="Enter your password">
                            @error('password')
                            <code id="password-error" class="text-danger">{{ $message }}</code>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}
                                    class="form-check-input" id="checkbox-signin">
                                <label class="form-check-label" for="checkbox-signin">Remember me</label>
                            </div>
                        </div>
                        <div class="d-grid mb-0 text-center">
                            <button class="btn btn-primary" type="submit"> Login
                            </button>
                        </div>
                    </form>


                </div> <!-- end .card-body -->
            </div> <!-- end .align-items-center.d-flex.h-100-->
        </div>

        <div class="auth-fluid-right">
            <div class="auth-user-testimonial align-items-center d-flex h-100">
            </div>
        </div>
    </div>
</body>

</html>
