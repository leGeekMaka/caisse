<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon" />
    <!-- ========== All CSS files linkup ========= -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/LineIcons.css" />
        <link rel="stylesheet" href="assets/css/materialdesignicons.min.css" />
        <link rel="stylesheet" href="assets/css/fullcalendar.css" />
        <link rel="stylesheet" href="assets/css/fullcalendar.css" />
        <link rel="stylesheet" href="assets/css/main.css" />

    </head>
    <body>

<!-- ========== signin-section start ========== -->
<section class="signin-section">
    <div class="container-fluid">
        <div class="row g-0 auth-row">
            <div class="col-lg-6">
                @if(session()->has('message'))
                    <div id="alert-message" class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('message')}} </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="auth-cover-wrapper bg-primary-100">
                    <div class="auth-cover">
                        <div class="title text-center">
                            <h1 class="text-primary mb-10">Bien venu à nouveau</h1>
                            <p class="text-medium">
                                Connectez-vous à votre compte existant pour continuer
                            </p>
                        </div>
                        <div class="cover-image">
                            <img src="assets/images/auth/signin-image.svg" alt="" />
                        </div>
                        <div class="shape-image">
                            <img src="assets/images/auth/shape.svg" alt="" />
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
            <div class="col-lg-6">
                <div class="signin-wrapper">
                    <div class="form-wrapper">
                        <h6 class="mb-15">Formulaire de connexion</h6>
                        <p class="text-sm mb-25">
                            Commencez à créer la meilleure expérience utilisateur possible pour vos clients.
                        </p>
                        <form method="POST" action="{{route('login')}}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Nom</label>
                                        <input type="email" name="email" placeholder="email" />
                                    @error('email') <span class="text-danger">{{$message}}</span>  @enderror
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>mot de passe</label>
                                        <input type="password" name="password" placeholder="mot de passe" />
                                        @error('password') <span class="text-danger" >{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <!-- end col -->
{{--                                <div class="col-xxl-6 col-lg-12 col-md-6">--}}
{{--                                    <div class="form-check checkbox-style mb-30">--}}
{{--                                        <input class="form-check-input" type="checkbox" value=""--}}
{{--                                            id="checkbox-remember" />--}}
{{--                                        <label class="form-check-label" for="checkbox-remember">--}}
{{--                                            Ce rappeler de moi</label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <!-- end col -->
                                <div class="col-xxl-6 col-lg-12 col-md-6">
                                    <div class="text-start text-md-end 
                                     text-lg-start text-xxl-end mb-30">
                                        <a href="reset-password.html" class="hover-underline">
                                            mot de passe oublié?
                                        </a>
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-12">
                                    <div class="button-group d-flex justify-content-center flex-wrap">
                                        <button type="submit" class=" main-btn primary-btn btn-hover w-100 text-center">
                                            Se connecter
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
</section>
<!-- ========== signin-section end ========== -->
</body>
</html>
