<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="shortcut icon" href="/images/logo.png" type="image/x-icon">
</head>
<body class="min-vh-100">
<div class="container min-vh-100">
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <chicorycom-login class="card o-hidden border-0 shadow-lg my-5 w-100 card-login" title="Ciga Formation"></chicorycom-login>
    </div>
</div>
<script >{!! $login !!}</script>
</body>
</html>
