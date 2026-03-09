@extends('chicorycom::layouts.layout')

@section('content')
    <!-- Sing in  Form -->
    <section class="sign-in">
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="/images/signin-image.jpg" alt="sing up image"></figure>
                   <div>
                       <a href="{{ url('/') }}" class="signup-image-link">Annuler</a>
                       <a href="{{ route('register') }}" class="signup-image-link">Créer un compte</a>
                   </div>
                </div>

                <div class="signin-form">
                    <h4 class="form-title">Espacen Etudiants Ciga-formation</h4>
                    <auth-login></auth-login>
                    <div class="social-login">
                        <span class="social-label">Ou connectez-vous avec</span>
                        <ul class="socials">
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
