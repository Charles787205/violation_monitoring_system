<x-app-layout>
  <section class="section main-section">
    <div class="card">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><span class="material-icons">directions_car</span></span>
          My Vehicles
        </p>
      </header>
      <div class="card-content">
        <a href="{{ route('client.create_vehicle') }}" class="button green small">
          Add Vehicle
        </a>
        <table class="table is-fullwidth is-striped">
          <thead>
            <tr>
              <th>License Plate</th>
              <th>Make</th>
              <th>Model</th>
              <th>Year</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($vehicles as $vehicle)
            <tr>
              <td>{{ $vehicle->license_plate }}</td>
              <td>{{ $vehicle->make }}</td>
              <td>{{ $vehicle->model }}</td>
              <td>{{ $vehicle->year }}</td>
            </tr>
            @empty
            <tr>
              <td colspan="4" class="has-text-centered">No vehicles found.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </section>
</x-app-layout>