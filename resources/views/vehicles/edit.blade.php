<x-app-layout>
  <section class="section main-section">
    <div class="card">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="mdi mdi-car"></i></span>
          Edit Vehicle
        </p>
      </header>
      <div class="card-content">
        <form method="POST" action="{{ route('vehicles.update', $vehicle) }}">
          @csrf
          @method('PUT')
          <div class="field">
            <label class="label">License Plate</label>
            <div class="control">
              <input class="input" type="text" name="license_plate"
                value="{{ old('license_plate', $vehicle->license_plate) }}" required>
            </div>
          </div>
          <div class="field">
            <label class="label">Make</label>
            <div class="control">
              <input class="input" type="text" name="make" value="{{ old('make', $vehicle->make) }}" required>
            </div>
          </div>
          <div class="field">
            <label class="label">Model</label>
            <div class="control">
              <input class="input" type="text" name="model" value="{{ old('model', $vehicle->model) }}" required>
            </div>
          </div>
          <div class="field">
            <label class="label">Year</label>
            <div class="control">
              <input class="input" type="number" name="year" value="{{ old('year', $vehicle->year) }}" required>
            </div>
          </div>
          <div class="field">
            <label class="label">Owner</label>
            <div class="control">
              <select class="input" name="user_id">
                <option value="">Select Owner</option>
                @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ old('user_id', $vehicle->user_id) == $user->id ? 'selected' : '' }}>
                  {{ $user->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="field">
            <div class="control">
              <button class="button green" type="submit">Update</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</x-app-layout>