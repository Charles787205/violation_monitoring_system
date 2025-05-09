<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <x-head />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Alpine.js for dropdowns and mobile menu -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex flex-col">
        <div class="flex flex-1 overflow-hidden">
            <!-- Sidebar -->
            <x-sidebar />

            <!-- Main Content -->
            <div class="flex-1 flex flex-col overflow-hidden">
                <!-- Navbar -->
                <x-navbar />

                <!-- Page Header (if exists) -->
                @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
                @endisset

                <!-- Main Content -->
                <main class="flex-1 overflow-auto">
                    {{ $slot }}
                </main>

                <!-- Footer -->
                <footer class="bg-white border-t py-3">
                    <div class="container mx-auto px-6">
                        <div class="flex justify-center text-sm text-gray-500">
                            <span>© {{ date('Y') }} Traffic Violation Monitoring System</span>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
</body>

</html>