<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>{{ $title ?? 'Page Title' }}</title>
    @stack('styles')
    @livewireStyles
</head>

<body>
    {{ $slot }}
    @livewireScripts
</body>

</html>