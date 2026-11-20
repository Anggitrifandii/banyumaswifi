<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'BanyumasWiFi') }} - Login</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Outfit:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="antialiased font-sans text-slate-800 bg-slate-50 min-h-screen flex flex-col items-center justify-center relative py-10 overflow-x-hidden overflow-y-auto">
    
    <div class="fixed inset-0 z-0 pointer-events-none">
        <div class="absolute -top-[20%] -right-[10%] w-[50vw] h-[50vw] rounded-full bg-gradient-to-br from-blue-300/40 to-cyan-200/40 blur-[100px]"></div>
        <div class="absolute top-[10%] -left-[10%] w-[40vw] h-[40vw] rounded-full bg-gradient-to-tr from-[#1a44a6]/20 to-indigo-300/20 blur-[120px]"></div>
    </div>
    
    <div class="fixed inset-0 z-10 bg-black/60 backdrop-blur-sm pointer-events-none"></div>

    <div class="z-20 w-full sm:max-w-md px-8 py-10 bg-white shadow-2xl rounded-xl relative border-[4px] border-white/20 bg-clip-padding my-auto">
        {{ $slot }}
    </div>

</body>
</html>