<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SKKPD | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- CSS --}}
    @include('layouts.navbar')
    {{-- CSS --}}
</head>

{{--

<body class="hold-transition login-page"
    style="background-image: url('gambar/bg.jpg'); background-repeat: no-repeat; background-size: cover;"> --}}

    <body>

        <style>
            @import url('https://fonts.googleapis.com/css?family=Raleway&display=swap');

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                padding: 0;
                font-family: 'Raleway', sans-serif;
            }

            .box {
                display: flex;
                background-color: white;
                align-items: center;
                justify-content: center;
                background-color: #21D4FD;
                background-image: linear-gradient(19deg, #21D4FD 0%, #B721FF 100%);
                height: 100vh;
            }

            .login-form {
                min-width: 250px;
                max-width: 400px;
                border-radius: 24px;
                padding: 15px;
                background-color: white;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            }

            .login-form h1 {
                text-align: center;
                font-size: 2.5rem;
                margin-top: 35px;
            }

            .login-form input[type="text"] {
                margin-top: 30px;
            }

            .login-form input[type="password"] {
                margin-top: 10px;
            }

            input {
                outline: none;
            }

            .links {
                margin-top: 10px;
                display: flex;
                flex-wrap: wrap;
                flex-direction: row;
            }

            .links>a:first-of-type {
                margin-right: 5px;
            }

            .links>a {
                background-color: #E0E0E0;
                border-radius: 24px;
                font-weight: 400;
                color: black;
                line-height: 12px;
                flex: 1;
                text-align: center;
                padding: 10px;
                text-decoration: none;
                font-family: 'Raleway';
                transition: 0.25s;
            }

            .links>a:hover {
                opacity: 0.6;
            }

            .login-form input[type="submit"] {
                background-color: #E0E0E0;
                background-image: linear-gradient(19deg, #21D4FD 0%, #B721FF 100%);
                width: 100%;
                color: white;
                border: none;
                margin-top: 35px;
                cursor: pointer;
                padding: 10px;
                font-family: 'Raleway', sans-seriff;
                font-size: 1.3rem;
                font-weight: bold;
                border-radius: 24px;
                transition: 0.25s;
            }

            .login-form input[type="submit"]:hover {
                opacity: 0.8;
            }

            .login-form input[type="text"]:focus,
            .login-form input[type="password"]:focus {
                border: 2px #21D4FD solid;
            }

            .login-form input[type="text"],
            .login-form input[type="password"] {
                width: 100%;
                border: none;
                border-radius: 24px;
                font-size: 1rem;
                font-family: 'Raleway', sans-seriff;
                background-color: gainsboro;
                padding: 15px;
            }
        </style>
        @include('layouts.script')
        {{-- script --}}

        {{-- <div class="login-box">
            <div class="login-logo">
                <span class="text-white"><b>Login
                    </b>SKKP</span>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg"></p>

                    <form action="{{ route('proses_login') }}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" name="username" class="form-control" placeholder="Username" required
                                autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 mb-5">
                            <button type="submit" name="cek" class="btn btn-primary btn-block mb-2">Sign In</button>
                        </div>
                </div>
                </form>

                <!-- /.social-auth-links -->

            </div>
            <!-- /.login-card-body -->
        </div> --}}

        <!-- /.login-box -->

        <div class="box">

            <form action="{{ route('proses_login') }}" method="POST" class="login-form">
                @csrf
                <div class="d-flex" style="margin-bottom: -10px">
                    <img src="{{ asset('asset/dist/img/batam-aero-tec.webp') }}" alt="BATAM AERO TECH" class="m-auto"
                        width="250" height="250">
                </div>
                {{-- <h1>Login</h1> --}}
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" name="Login" value="Login">
                </button>
            </form>

        </div>

    </body>

</html>