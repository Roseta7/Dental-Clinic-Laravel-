<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <title>Login</title>
        <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
    </head>

    <body>

        <div class="form-container d-flex align-items-center justify-content-center my-5">
            <div class="overlay"></div>
            <div class="login-container-inputs">
                <p class="title text-light">Welcome to our clinic</p>
                <img src="{{ asset('images/logo.png') }}" loading="lazy" alt="logo">
                <h6 class="lead text-center text-white">log in to your account</h6>
                <form class="form" action="{{ route('login') }}" method="post">
                    @csrf
                    <input type="email" class="input" name="email" placeholder="Email">
                    @error('email')
                        <div style="color: red;">
                            {{$message}}
                        </div>
                    @enderror

                    <input type="password" class="input" name="password" placeholder="Password">
                    @error('password')
                        <div style="color: red;">
                            {{$message}}
                        </div>
                    @enderror
                    
                    <button class="form-btn" type="submit">Login</button>
                </form>
            </div>
        </div>
    </body>

</html>