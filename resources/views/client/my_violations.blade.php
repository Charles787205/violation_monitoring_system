<x-app-layout>
  <section class="section main-section">
    <div class="card">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><span class="material-icons">report_problem</span></span>
          My Violations
        </p>
      </header>
      <div class="card-content">
        <table class="table is-fullwidth is-striped">
          <thead>
            <tr>
              <th>License Plate</th>
              <th>Violation Type</th>
              <th>Amount</th>
              <th>Status</th>
              <th>Paid At</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($violations as $violation)
            <tr>
              <td>{{ $violation->license_plate }}</td>
              <td>{{ $violation->violation_type }}</td>
              <td>{{ $violation->amount }}</td>
              <td>{{ ucfirst($violation->status) }}</td>
              <td>{{ $violation->paid_at ? explode(' ',$violation->paid_at)[0]: 'N/A' }}</td>
            </tr>
            @empty
            <tr>
              <td colspan="5" class="has-text-centered">No violations found.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </section>
</x-app-layout>