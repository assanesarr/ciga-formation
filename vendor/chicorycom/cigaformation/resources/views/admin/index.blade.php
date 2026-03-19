@php
$config = [
    'appName' => config('app.name'),
    'locale' => $locale = app()->getLocale(),
    'locales' => config('app.locales'),
    'base' => config('cigaformation.prefix'),
    'githubAuth' => config('services.github.client_id'),
];
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="/images/logo.png" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ mix('assets/css/main.css') }}">
</head>
<body data-page="{{ $menus->toJson() }}">
  {{-- Global configuration object --}}
  <script>
    window.config = @json($config);
  </script>
  {{-- Load the application scripts --}}
  <script>{!! $appjs !!}</script>
</body>
</html>
