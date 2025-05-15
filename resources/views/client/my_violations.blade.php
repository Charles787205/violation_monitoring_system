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
              <th>Payment Receipt</th>
              <th>Actions</th>
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
              <td>
                @if($violation->hasPaymentReceipt())
                <a href="{{ asset('storage/' . $violation->payment_receipt) }}" target="_blank"
                  class="button is-small is-info">
                  <span class="icon"><i class="material-icons">receipt</i></span>
                  <span>View Receipt</span>
                </a>
                @else
                <span class="tag is-warning">No Receipt</span>
                @endif
              </td>
              <td>
                @if($violation->status != 'paid')
                <button class="button is-success js-modal-trigger" data-target="settle-payment-{{ $violation->id }}"
                  style="background-color: #48c774; color: white; font-weight: 600; transition: all 0.3s;">
                  <span class="icon"><i class="material-icons">payments</i></span>
                  <span>Settle Payment</span>
                </button>

                <!-- Payment Modal -->
                <div id="settle-payment-{{ $violation->id }}" class="modal">
                  <div class="modal-background"></div>
                  <div class="modal-card">
                    <header class="modal-card-head">
                      <p class="modal-card-title">Settle Violation Payment</p>
                      <button class="delete" aria-label="close"></button>
                    </header>
                    <form action="{{ route('violations.settle', $violation->id) }}" method="POST"
                      enctype="multipart/form-data">
                      @csrf
                      <section class="modal-card-body">
                        <div class="field">
                          <label class="label">Violation Details</label>
                          <div class="notification is-info is-light">
                            <p><strong>License Plate:</strong> {{ $violation->license_plate }}</p>
                            <p><strong>Violation Type:</strong> {{ $violation->violation_type }}</p>
                            <p><strong>Amount:</strong> {{ $violation->amount }}</p>
                          </div>
                        </div>
                        <div class="field">
                          <label class="label">Upload Payment Receipt</label>
                          <div class="control">
                            <input type="file" name="payment_receipt" class="input" required>
                          </div>
                          <p class="help">Please upload a photo of your payment receipt</p>
                        </div>
                      </section>
                      <footer class="modal-card-foot">
                        <button type="submit" class="button is-success" style="background-color: #48c774;">Submit
                          Payment</button>
                        <button type="button" class="button cancel-button">Cancel</button>
                      </footer>
                    </form>
                  </div>
                </div>
                @else
                <span class="tag is-success">Paid</span>
                @endif
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="7" class="has-text-centered">No violations found.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="card mt-6">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><span class="material-icons">history</span></span>
          Recent Activity
        </p>
      </header>
      <div class="card-content">
        <div class="content">
          <h4 class="subtitle is-5">Recently Settled Violations</h4>
          @php $recentlySettled = $violations->where('status', 'paid')->sortByDesc('paid_at')->take(5); @endphp

          @if($recentlySettled->count() > 0)
          <table class="table is-fullwidth is-striped">
            <thead>
              <tr>
                <th>License Plate</th>
                <th>Violation Type</th>
                <th>Amount</th>
                <th>Settled On</th>
              </tr>
            </thead>
            <tbody>
              @foreach($recentlySettled as $settled)
              <tr>
                <td>{{ $settled->license_plate }}</td>
                <td>{{ $settled->violation_type }}</td>
                <td>{{ $settled->amount }}</td>
                <td>{{ $settled->getFormattedPaidAtAttribute() }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @else
          <p>No recently settled violations.</p>
          @endif
        </div>
      </div>
    </div>
  </section>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      console.log('DOM loaded, initializing modals');

      // Functions to open and close a modal
      function openModal($el) {
        console.log('Opening modal', $el);
        $el.classList.add('active'); // Changed from is-active to active to match CSS
      }

      function closeModal($el) {
        console.log('Closing modal', $el);
        $el.classList.remove('active'); // Changed from is-active to active
      }

      function closeAllModals() {
        console.log('Closing all modals');
        (document.querySelectorAll('.modal') || []).forEach(($modal) => {
          closeModal($modal);
        });
      }

      // Direct click handlers for each modal trigger button
      document.querySelectorAll('.js-modal-trigger').forEach(button => {
        const modalId = button.getAttribute('data-target');
        const modal = document.getElementById(modalId);

        console.log('Setting up modal trigger for', modalId);

        if (modal) {
          button.addEventListener('click', function (e) {
            e.preventDefault();
            console.log('Button clicked for modal', modalId);
            openModal(modal);
          });
        } else {
          console.error('Modal not found:', modalId);
        }
      });

      // Add a click event on various child elements to close the parent modal
      document.querySelectorAll('.modal .delete, .modal .cancel-button').forEach(($close) => {
        const $target = $close.closest('.modal');

        $close.addEventListener('click', (e) => {
          e.preventDefault();
          closeModal($target);
        });
      });

      // Click outside modal to close
      document.querySelectorAll('.modal-background').forEach(bg => {
        bg.addEventListener('click', function () {
          const modal = this.closest('.modal');
          closeModal(modal);
        });
      });

      // Add a keyboard event to close all modals
      document.addEventListener('keydown', (event) => {
        if (event.code === 'Escape') {
          closeAllModals();
        }
      });
    });
  </script>
</x-app-layout>