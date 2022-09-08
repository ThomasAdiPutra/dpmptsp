<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Log In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('asset/img/favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body.authentication-bg {
            background-size: cover;
            background-position: center
        }

        body.authentication-bg {
            background-image: url('{{ asset('asset/img/bg-login.jpg') }}');
            background-size: cover;
            background-position: center
        }
    </style>

</head>

<body class="loading authentication-bg authentication-bg-pattern">

    <div class="account-pages my-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="text-center">
                                <a href="index.html">
                                    <img src="{{ asset('asset/img/logo.png') }}" alt="Logo" height="22"
                                        class="mx-auto">
                                </a>
                                <p class="text-muted mt-2 mb-4">DPMPTSP Ketapang</p>
                            </div>
                            <div class="text-center mb-4">
                                <h4 class="text-uppercase mt-0">Sign In</h4>
                            </div>
                            @if (session()->has('error'))
                                <div class="text-danger">
                                    <ul>
                                        <li>{{ session()->get('error') }}</li>
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ url('login') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input class="form-control" type="text" name="username" id="username"
                                        required placeholder="Enter your username">
                                    @error('username')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input class="form-control" type="password" name="password" required
                                        id="password" placeholder="Enter your password">
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 d-grid text-center">
                                    <button class="btn btn-primary" type="submit"> Log In </button>
                                </div>
                            </form>
                            <div class="text-center">
                                <a href="{{ url('/') }}" class="text-decoration-none">Website DPMPTSP Ketapang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
