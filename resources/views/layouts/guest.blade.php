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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased p-0">
    <img src="/img/lto.jpeg" alt="background" class="z-[-1] fixed top-0 left-0 w-screen h-screen object-cover ">
    <div class="fixed top-0 left-0 w-full z-50">
        @if (session('status'))
        <div class="bg-green-500 text-white text-center py-2">
            {{ session('status') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="bg-red-500 text-white text-center py-2">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <div class="min-h-screen flex flex-col sm:justify-center items-center ">

        <div class="w-full sm:max-w-md mt-6 px-6 py-4  shadow-md overflow-hidden sm:rounded-lg">

            {{ $slot }}
        </div>
    </div>
</body>

</html>