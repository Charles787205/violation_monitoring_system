<x-app-layout>
  <section class="section main-section">
    <div class="notification blue">
      <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
        <div>
          <span class="icon"><i class="mdi mdi-car"></i></span>
          <b>Vehicles</b>
        </div>
      </div>
    </div>
    <div class="card has-table">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="mdi mdi-car"></i></span>
          Vehicles List
        </p>
      </header>
      <div class="card-content">
        <table>
          <thead>
            <tr>
              <th>License Plate</th>
              <th>Make</th>
              <th>Model</th>
              <th>Year</th>
              <th>Owner</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($vehicles as $vehicle)
            <tr>
              <td>{{ $vehicle->license_plate }}</td>
              <td>{{ $vehicle->make }}</td>
              <td>{{ $vehicle->model }}</td>
              <td>{{ $vehicle->year }}</td>
              <td>{{ $vehicle->user ? $vehicle->user->name : 'N/A' }}</td>
              <td class="actions-cell">
                <div class="buttons right nowrap">
                  <a href="{{ route('vehicles.edit', $vehicle) }}" class="button small green">
                    <span class="icon"><i class="mdi mdi-pencil"></i></span>
                  </a>
                  <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="button small red" type="submit">
                      <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="table-pagination">
          {{ $vehicles->onEachSide(1)->links() }}
        </div>
      </div>
    </div>
  </section>
</x-app-layout>