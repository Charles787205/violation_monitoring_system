<x-app-layout>
  <section class="section main-section">
    <div class="card">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="mdi mdi-alert-circle"></i></span>
          Violation Details
        </p>
      </header>
      <div class="card-content">
        <div class="content">
          <p><strong>License Plate:</strong> {{ $violation->license_plate }}</p>
          <p><strong>Violation Type:</strong> {{ $violation->violation_type }}</p>
          <p><strong>Amount:</strong> ${{ $violation->amount }}</p>
          <p><strong>Status:</strong> {{ ucfirst($violation->status) }}</p>
          <p><strong>Paid At:</strong> {{ $violation->paid_at ? $violation->paid_at->format('Y-m-d H:i:s') : 'N/A' }}
          </p>
        </div>
        <div class="buttons">
          <a href="{{ route('violations.edit', $violation) }}" class="button small green">
            <span class="icon"><i class="mdi mdi-pencil"></i></span>
            Edit
          </a>
          <form action="{{ route('violations.destroy', $violation) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button class="button small red" type="submit">
              <span class="icon"><i class="mdi mdi-trash-can"></i></span>
              Delete
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>
</x-app-layout>