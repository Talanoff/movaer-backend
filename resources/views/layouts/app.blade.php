<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,600;0,700;0,800;0,900;1,400;1,600;1,700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles()
</head>
<body class="font-sans antialiased text-slate-800">
<div class="min-h-screen flex flex-col">
    @include('client.partials.header')
    <main class="flex-1" role="main">
        {{ $slot }}
    </main>
</div>
@livewireScripts()
</body>
</html>
