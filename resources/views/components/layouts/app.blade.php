<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
        <title>{{ $title ?? 'Encuestas' }}</title>
        @vite('resources/css/app.css')
        @livewireStyles
    </head>
    <body>
        {{ $slot }}
    </body>
</html>
