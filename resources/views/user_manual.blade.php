


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Button -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div style="position: absolute; top: 0; left: 0; margin: 10px; color: red;">
            <a href="/"><button class="btn"><i class="fa fa-home"></i> Back to Login Page</button></a>
        </div>            
        <div style="position: absolute; top: 0; right: 0; margin: 5px; width: 200px; height: 200px;">
            <a href="/">
                <x-application-logo style="width: 10px; height: 10px;" class=" fill-current text-gray-500" />
            </a>
        </div>
        <div style="position: absolute; top: 0; left: 50%; transform: translateX(-50%); margin: 10px; margin-top: 20px;">
            <h1 style="text-align: center; font-family: Impact, Haettenschweiler, 'Arial Bold', sans-serif; font-size: 25px;" class="text-center">
                USER MANUAL
            </h1>
        </div>
        
        <div class="flex space-x-4">
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg" style="margin: 5px;">
                <img src="{{ URL::to('assets/img/Slide1.jpg') }}" alt="">
            </div>
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg" style="margin: 5px;">
                <img src="{{ URL::to('assets/img/Slide2.jpg') }}" alt="">
            </div>
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg" style="margin: 5px;">
                <img src="{{ URL::to('assets/img/Slide3.jpg') }}" alt="">
            </div>
        </div>
    </div>
</body>


</html>

