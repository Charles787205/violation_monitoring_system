<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <section class="section main-section">
        <div class="grid gap-6 grid-cols-1 md:grid-cols-3 mb-6">
            <div class="card">
                <div class="card-content">
                    <div class="flex items-center justify-between">
                        <div class="widget-label">
                            <h3>Owners</h3>
                            <h1>{{ $numberOfOwners }}</h1>
                        </div>
                        <span class="icon widget-icon text-purple-500"><i class="mdi mdi-account mdi-48px"></i></span>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <div class="flex items-center justify-between">
                        <div class="widget-label">
                            <h3>Pending Violations</h3>
                            <h1>{{ $pendingViolations }}</h1>
                        </div>
                        <span class="icon widget-icon text-orange-500"><i class="mdi mdi-alert mdi-48px"></i></span>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <div class="flex items-center justify-between">
                        <div class="widget-label">
                            <h3>Total Payments</h3>
                            <h1>₱{{ number_format($totalPayments, 2) }}</h1>
                        </div>
                        <span class="icon widget-icon text-teal-500"><i class="mdi mdi-cash mdi-48px"></i></span>
                    </div>
                </div>
            </div>
        </div>


    </section>
</x-app-layout>