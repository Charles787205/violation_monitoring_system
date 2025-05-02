<x-app-layout>

  <section class="section main-section">
    <div class="notification blue">
      <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
        <div>
          <span class="icon"><span class="material-icons">alert</span></span>
          <b>Pending Violations</b>
        </div>
      </div>
    </div>
    <div class="card has-table">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><span class="material-icons">alert</span></span>
          Pending Violations List
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
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($violations as $violation)
            <tr>
              <td>{{ $violation->license_plate }}
              <td>{{ $violation->violation_type }}</td>
              <td>{{ $violation->amount }}</td>
              <td>{{ ucfirst($violation->status) }}</td>
              <td class="actions-cell flex justify-start">
                <div class="buttons right nowrap">
                  <a href="#"
                    onclick="event.preventDefault(); document.getElementById('pay-form-{{ $violation->id }}').submit();"
                    class="button small green">
                    <span class="material-symbols-outlined">
                      payments
                    </span>
                  </a>
                  <form id="pay-form-{{ $violation->id }}" action="{{ route('violations.pay', $violation) }}"
                    method="POST" style="display:none;">
                    @csrf
                    @method('PATCH')
                  </form>
                  <form action="{{ route('violations.destroy', $violation) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="button small red" type="submit">
                      <span class="material-symbols-outlined">
                        delete
                      </span>
                    </button>
                  </form>
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