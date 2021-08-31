<!DOCTYPE html>
<html>

<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo asset('css/styles.css') ?>" type="text/css">
    <!------ Include the above in your HEAD tag ---------->
</head>

<body class="login-page">
    <div id="login">
        <h3 class="text-center text-white pt-5">Login form</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <!-- <ul> -->
                        @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach
                        <!-- </ul> -->
                    </div>
                    @endif
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" action="{{ route('user#checkuser') }}" class="form" method="POST">
                            @csrf
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="text-info">Email:</label><br>
                                <input type="text" name="email" id="email" class="form-control" value="{{old('email')}}">
                                <small class="text-danger">{{ $errors->first('email') }}</small>
                            </div>
                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control" value="{{old('password')}}">
                                <small class="text-danger">{{ $errors->first('password') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="#" class="text-info">forgot password?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>