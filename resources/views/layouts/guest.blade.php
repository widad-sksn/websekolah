<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Login</title>

        <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|plus-jakarta-sans:500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50 text-gray-900">
        
        <div class="min-h-screen flex">
            <!-- Left Side (Branding/Image) -->
            <div class="hidden lg:flex lg:w-1/2 relative bg-blue-900 items-center justify-center overflow-hidden">
                <!-- Abstract Background Shapes -->
                <div class="absolute inset-0 z-0 opacity-20">
                    <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-blue-400 blur-3xl"></div>
                    <div class="absolute top-1/2 right-12 w-72 h-72 rounded-full bg-indigo-400 blur-3xl"></div>
                    <div class="absolute -bottom-24 left-1/3 w-80 h-80 rounded-full bg-cyan-400 blur-3xl"></div>
                </div>
                
                <!-- Content -->
                <div class="relative z-10 w-full max-w-lg px-12 flex flex-col items-center text-center">
                    <a href="/" class="mb-10 block transition-transform hover:scale-105 duration-300">
                        <x-application-logo class="w-48 h-auto object-contain drop-shadow-xl" />
                    </a>
                    
                    <h1 class="text-4xl font-display font-bold text-white mb-6 leading-tight">
                        Selamat Datang di Portal <span class="text-blue-300">{{ config('app.name', 'SchoolCMS') }}</span>
                    </h1>
                    
                </div>
                
                <!-- Overlay Pattern -->
                <div class="absolute inset-0 z-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'20\' height=\'20\' viewBox=\'0 0 20 20\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.05\' fill-rule=\'evenodd\'%3E%3Ccircle cx=\'3\' cy=\'3\' r=\'3\'/%3E%3Ccircle cx=\'13\' cy=\'13\' r=\'3\'/%3E%3C/g%3E%3C/svg%3E');"></div>
            </div>
            
            <!-- Right Side (Form) -->
            <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 relative bg-white">
                
                <div class="w-full max-w-md">
                    
                    <!-- Mobile Logo (Visible only on small screens) -->
                    <div class="lg:hidden flex justify-center mb-8">
                        <a href="/">
                            <x-application-logo class="w-24 h-auto object-contain drop-shadow-md" />
                        </a>
                    </div>

                    <div class="mb-10 text-center lg:text-left">
                        <h2 class="text-3xl font-bold font-display text-gray-900 mb-2">Log In</h2>
                        <p class="text-gray-500">Masukkan kredensial Anda untuk melanjutkan</p>
                    </div>

                    {{ $slot }}
                    
                    <div class="mt-8 text-center text-sm text-gray-500">
                        &copy; {{ date('Y') }} {{ config('app.name', 'SchoolCMS') }}. All rights reserved.
                    </div>
                </div>
                
            </div>
        </div>

    </body>
</html>
