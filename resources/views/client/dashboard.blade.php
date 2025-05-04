<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Owner Dashboard') }}
    </h2>
  </x-slot>

  <section class="section main-section">
    <div class="grid gap-6 grid-cols-1 md:grid-cols-3 mb-6">
      <div class="card">
        <div class="card-content">
          <div class="flex items-center justify-between">
            <div class="widget-label">
              <h3>Total Vehicles</h3>
              <h1>{{ $totalVehicles }}</h1>
            </div>
            <span class="icon widget-icon text-blue-500"><i class="mdi mdi-car mdi-48px"></i></span>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-content">
          <div class="flex items-center justify-between">
            <div class="widget-label">
              <h3>Active Violations</h3>
              <h1>{{ $activeViolations }}</h1>
            </div>
            <span class="icon widget-icon text-red-500"><i class="mdi mdi-alert-circle mdi-48px"></i></span>
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
            <span class="icon widget-icon text-green-500"><i class="mdi mdi-cash mdi-48px"></i></span>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-content">
          <div class="flex items-center justify-between">
            <div class="widget-label">
              <h3>Total Violations</h3>
              <h1>{{ $totalViolations->count() }}</h1>
            </div>
            <span class="icon widget-icon text-yellow-500"><i class="mdi mdi-alert mdi-48px"></i></span>
          </div>
        </div>
      </div>
    </div>
  </section>
</x-app-layout>