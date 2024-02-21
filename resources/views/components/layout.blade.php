<!DOCTYPE html>
<html class="h-full bg-gray-50" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    @vite('resources/css/app.css')
</head>
<body class="h-full">
<div>
    <x-navigation></x-navigation>
    <main class="py-10 lg:pl-72">
        <div class="px-4 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </main>
</div>
</body>
</html>
