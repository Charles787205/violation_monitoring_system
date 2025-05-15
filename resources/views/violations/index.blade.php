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

    <!-- Search and Filter Section -->
    <div class="card mb-6">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="material-icons">search</i></span>
          Search & Filter
        </p>
      </header>
      <div class="card-content">
        <form action="{{ route('violations.index') }}" method="GET">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Search Box -->
            <div class="field">
              <label class="label">Search</label>
              <div class="control has-icons-left">
                <input class="input" type="text" name="search" placeholder="License Plate or Violation Type"
                  value="{{ request('search') }}">
                <span class="icon is-small is-left">
                  <i class="material-icons">search</i>
                </span>
              </div>
            </div>

            <!-- Status Filter -->
            <div class="field">
              <label class="label">Status</label>
              <div class="control">
                <div class="select is-fullwidth">
                  <select name="status">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                  </select>
                </div>
              </div>
            </div>

            <!-- Date Range -->
            <div class="field">
              <label class="label">Date Range</label>
              <div class="flex space-x-2">
                <div class="control is-expanded">
                  <input class="input" type="date" name="date_from" placeholder="From"
                    value="{{ request('date_from') }}">
                </div>
                <div class="control is-expanded">
                  <input class="input" type="date" name="date_to" placeholder="To" value="{{ request('date_to') }}">
                </div>
              </div>
            </div>
          </div>

          <!-- Filter Buttons -->
          <div class="field is-grouped mt-4">
            <div class="control">
              <button type="submit" class="button blue">
                <span class="icon"><i class="material-icons">filter_list</i></span>
                <span>Apply Filters</span>
              </button>
            </div>
            <div class="control">
              <a href="{{ route('violations.index') }}" class="button light">
                <span class="icon"><i class="material-icons">clear</i></span>
                <span>Clear Filters</span>
              </a>
            </div>
          </div>
        </form>
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
              <th>Payment Receipt</th>
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
              <td>{{ $violation->formatted_paid_at }}</td>
              <td>
                @if($violation->hasPaymentReceipt())
                <a href="{{ asset('storage/' . $violation->payment_receipt) }}" target="_blank"
                  class="button is-small is-info">
                  <span class="icon"><i class="material-icons">receipt</i></span>
                  <span>View</span>
                </a>
                @else
                <span class="tag is-warning is-light">No Receipt</span>
                @endif
              </td>
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
                  @if($violation->status === 'pending')
                  <form action="{{ route('violations.pay', $violation) }}" method="POST" class="inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="button small blue"
                      onclick="return confirm('Mark this violation as paid?')">
                      <span class="material-symbols-outlined">paid</span>
                    </button>
                  </form>
                  @endif
                </div>
              </td>
            </tr>
            @endforeach

            @if($violations->count() === 0)
            <tr>
              <td colspan="7" class="has-text-centered">No violations found.</td>
            </tr>
            @endif
          </tbody>
        </table>
        <div class="table-pagination">
          {{ $violations->withQueryString()->links() }}
        </div>
      </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="card mt-6">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="material-icons">history</i></span>
          Recent Activity
        </p>
      </header>
      <div class="card-content">
        <div class="content">
          @php $recentActivity = $violations->where('status', 'paid')->sortByDesc('paid_at')->take(5); @endphp

          @if($recentActivity->count() > 0)
          <table class="table is-fullwidth is-striped">
            <thead>
              <tr>
                <th>License Plate</th>
                <th>Violation Type</th>
                <th>Amount</th>
                <th>Settled On</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($recentActivity as $activity)
              <tr>
                <td>{{ $activity->license_plate }}</td>
                <td>{{ $activity->violation_type }}</td>
                <td>{{ $activity->amount }}</td>
                <td>{{ $activity->formatted_paid_at }}</td>
                <td>
                  @if($activity->hasPaymentReceipt())
                  <a href="{{ asset('storage/' . $activity->payment_receipt) }}" target="_blank"
                    class="button is-small is-info">
                    <span class="icon"><i class="material-icons">receipt</i></span>
                    <span>View Receipt</span>
                  </a>
                  @else
                  <span>Marked as paid</span>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @else
          <p>No recent activities.</p>
          @endif
        </div>
      </div>
    </div>
  </section>
</x-app-layout>