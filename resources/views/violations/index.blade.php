<x-app-layout>
  <section class="section main-section">
    <div class="notification blue">
      <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
        <div>
          <span class="icon"><i class="mdi mdi-alert-circle"></i></span>
          <b>Violations</b>
        </div>
        <a href="{{ route('violations.create') }}" class="button small green">Add Violation</a>
      </div>
    </div>
    <div class="card has-table">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="mdi mdi-alert-circle"></i></span>
          Violations List
        </p>
      </header>
      <div class="card-content">
        <table>
          <thead>
            <tr>
              <th>License Plate</th>
              <th>Violation Type</th>
              <th>Amount</th>
              <th>Status</th>
              <th>Paid At</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($violations as $violation)
            <tr>
              <td>{{ $violation->license_plate }}</td>
              <td>{{ $violation->violation_type }}</td>
              <td>{{ $violation->amount }}</td>
              <td>{{ ucfirst($violation->status) }}</td>
              <td>{{ $violation->paid_at ? explode(' ', $violation->paid_at)[0] : 'N/A' }}</td>
              <td class="actions-cell flex justify-start">
                <div class="buttons right nowrap">
                  <button class="button small green disabled:bg-neutral-600 disabled:border-neutral-800"
                    @if($violation->status !== 'pending')
                    disabled
                    @endif
                    onclick="if(this.disabled === false)
                    window.location.href='{{ route('violations.edit', $violation) }}'">
                    <span class="material-symbols-outlined">
                      edit
                    </span>
                  </button>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="table-pagination">
          {{ $violations->links() }}
        </div>
      </div>
    </div>
  </section>
</x-app-layout>