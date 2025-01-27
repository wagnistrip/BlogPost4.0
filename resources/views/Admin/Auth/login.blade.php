<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Wagnistrip Admin Login</title>

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="https://www.flight.wagnistrip.com/assets/images/logo.png" type="image/x-icon">
    <!-- Bootstrap -->
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Pe-icon-7-stroke -->
    <link href="{{ asset('assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css') }}" rel="stylesheet" type="text/css" />
    <!-- Custom style -->
    <link href="{{ asset('assets/dist/css/custom-login.css') }}" rel="stylesheet" type="text/css" />
</head>
<style>
    body {
        /* background-image: url('https://cdn.pixabay.com/photo/2020/01/02/10/15/background-image-4735444_960_720.png'); */
        background-image: url('https://img.freepik.com/free-vector/digital-technology-background-with-abstract-wave-border_53876-117508.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        margin: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-wrapper {
        background: rgb(249 249 249 / 80%);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        width: 100%;
    }

    .header-icon img {
        height: 71px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .btn-custom {
        width: 100%;
        background-color: #007bff;
        color: #fff;
    }

    .btn-custom:hover {
        background-color: #0056b3;
        color: #fff;
    }
</style>

<body>
    <div class="login-wrapper">
        <div class="login-area">
            <div class="panel panel-bd panel-custom">
                <div class="panel-heading">
                    <div class="view-header">
                        <div class="header-icon">
                            <i class="logo">
                                <img src="https://www.flight.wagnistrip.com/assets/images/logo.png" alt="Logo">
                            </i>
                        </div>
                        <div class="header-title">
                            <h3>Login</h3>
                            <small><strong>Please enter your credentials to login.</strong></small>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="email">Username</label>
                            <input type="text" placeholder="Enter Email" required value="" name="email"
                                id="email" class="form-control">
                            <span class="help-block small">Your unique username to app</span>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" placeholder="******" required name="password" id="password"
                                class="form-control" minlength="6">
                            <span class="help-block small">Your strong password (6 characters minimum)</span>
                        </div>
                        <div>
                            <span id="sp-otp"></span>
                            <br>
                            <center>
                                <button type="button" class="btn btn-custom sub-submit" id="login-check">
                                    <span style="display:none;" id="submit-span" class="fa fa-refresh fa-spin"></span>
                                    Login
                                </button>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jQuery/jquery-1.12.4.min.js') }}" type="text/javascript"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $(".sub-submit").click(function() {
            alert("ok");
                var email = $("#email").val();
                var password = $("#password").val();
                $.ajax({
                    url: "{{ route('send.otp.admin') }}",
                    type: "post",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "email": email,
                        "password": password
                    },
                    beforeSend: function() {
                        $("#submit-span").show();
                    },
                    success: function(res) {
                        if (res.res) {
                            $("#submit-span").hide();
                            $("#login-check").remove();
                            var inp =
                                '<br><input id="otp" type="number" onkeyup="checkotp()" class="login-input2 form-control" name="otp" placeholder="Enter Otp" required autofocus">';
                            inp +=
                                '<br><center><button type="submit" class="btn btn-custom" style="max-width:304px;width:100%;">Verify & Login</button></center>';
                            $("#sp-otp").html(inp);
                        } else {
                            alert(res.msg);
                        }
                    }
                });
            });

            function checkotp() {
                var otp1 = $("#otp").val();
            }
        });
    </script>
</body>

</html>
