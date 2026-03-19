@extends('chicorycom::layouts.layout')

@section('content')
    <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h4 class="form-title">Espacen Etudiants Ciga-formation</h4>
                    <auth-register></auth-register>

                </div>
                <div class="signup-image">
                    <figure><img src="/images/signup-image.jpg" alt="sing up image"></figure>
                    <a href="{{ route('login') }}" class="signup-image-link">Je suis déjà membre</a>
                </div>
            </div>
        </div>
    </section>
@endsection
