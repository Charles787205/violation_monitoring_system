<x-app-layout>
  <section class="section main-section">
    <div class="card">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="mdi mdi-alert-circle"></i></span>
          Add Violation
        </p>
      </header>
      <div class="card-content">
        <form method="POST" action="{{ route('violations.store') }}">
          @csrf
          <div class="field">
            <label class="label">License Plate</label>
            <div class="control">
              <input class="input" type="text" name="license_plate" value="{{ old('license_plate') }}" required>
            </div>
          </div>
          <div class="field">
            <label class="label">Violation Type</label>
            <div class="control">
              <input class="input" type="text" name="violation_type" value="{{ old('violation_type') }}" required>
            </div>
          </div>
          <div class="field">
            <label class="label">Amount</label>
            <div class="control">
              <input class="input" type="number" step="0.01" name="amount" value="{{ old('amount') }}" required>
            </div>
          </div>
          <div class="field">
            <label class="label">Status</label>
            <div class="control">
              <select class="input" name="status" required>
                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="paid" {{ old('status') == 'paid' ? 'selected' : '' }}>Paid</option>
              </select>
            </div>
          </div>
          <div class="field">
            <div class="control">
              <button class="button green" type="submit">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</x-app-layout>