<x-app-layout>
  <section class="section main-section">
    <div class="card">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="mdi mdi-car"></i></span>
          Add New Vehicle
        </p>
      </header>
      <div class="card-content">
        <form method="POST" action="{{ route('client.store_vehicle') }}">
          @csrf
          <div class="field">
            <label class="label">License Plate</label>
            <div class="control">
              <input class="input" type="text" name="license_plate" required>
            </div>
          </div>
          <div class="field">
            <label class="label">Make</label>
            <div class="control">
              <input class="input" type="text" name="make" required>
            </div>
          </div>
          <div class="field">
            <label class="label">Model</label>
            <div class="control">
              <input class="input" type="text" name="model" required>
            </div>
          </div>
          <div class="field">
            <label class="label">Year</label>
            <div class="control">
              <input class="input" type="number" name="year" min="1900" max="{{ date('Y') }}" required>
            </div>
          </div>
          <button class="button is-success" type="submit">Save</button>
        </form>
      </div>
    </div>
  </section>
</x-app-layout>