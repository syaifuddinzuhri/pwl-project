<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login - Premium RentCar</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="Codedthemes" />
    <!-- Favicon icon -->

    <link rel="icon" href="{{ asset('admin-templates')}}/images/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-templates')}}/css/bootstrap/css/bootstrap.min.css">
    <!-- waves.css -->
    <link rel="stylesheet" href="{{ asset('admin-templates')}}/pages/waves/css/waves.min.css" type="text/css" media="all">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-templates')}}/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-templates')}}/icon/icofont/css/icofont.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-templates')}}/icon/font-awesome/css/font-awesome.min.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-templates')}}/css/style.css">
</head>

<body themebg-pattern="theme1">
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="preloader-wrapper">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->

    <section class="login-block">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->

                    <form class="md-float-material form-material" method="POST" action="{{route('auth.login')}}">
                        @csrf
                        <div class="text-center">
                            <img src="{{ asset('admin-templates')}}/images/logo.png" width="280" alt="logo.png">
                        </div>
                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center">Log In</h3>
                                    </div>
                                </div>
                                <div class="form-group form-default @error('email') form-danger @enderror form-static-label">
                                    <input type="text" name="email" class="form-control" placeholder="Masukkan email">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Masukkan email</label>
                                    @error('email')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group form-default @error('password') form-danger @enderror form-static-label">
                                    <input type="password" name="password" class="form-control" placeholder="Masukkan password">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Masukkan password</label>
                                    @error('password')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Sign in</button>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col text-center">
                                        <p class="m-0">Belum punya akun?<a href="{{ route('auth.register')}}"> Daftar Disini!</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- end of form -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>

    <!-- Required Jquery -->
    <script type="text/javascript" src="{{ asset('admin-templates')}}/js/jquery/jquery.min.js "></script>
    <script type="text/javascript" src="{{ asset('admin-templates')}}/js/jquery-ui/jquery-ui.min.js "></script>
    <script type="text/javascript" src="{{ asset('admin-templates')}}/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="{{ asset('admin-templates')}}/js/bootstrap/js/bootstrap.min.js "></script>
    <!-- waves js -->
    <script src="{{ asset('admin-templates')}}/pages/waves/js/waves.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{ asset('admin-templates')}}/js/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script type="text/javascript" src="{{ asset('admin-templates')}}/js/common-pages.js"></script>
</body>

</html>
