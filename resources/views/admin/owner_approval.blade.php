<x-app-layout>
  <section class="section main-section">
    <div class="card">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="mdi mdi-account-alert"></i></span>
          Owner Approval
        </p>
      </header>
      <div class="card-content">
        <table class="table is-fullwidth is-striped">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>License Number</th>
              <th>Address</th>
              <th>Actions</th>
              <th>License Image</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($unapprovedUsers as $user)
            <tr>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->ownerDetail->license_number ?? 'N/A' }}</td>
              <td>{{ $user->ownerDetail->address ?? 'N/A' }}</td>
              <td>
                <form method="POST" action="{{ route('users.approve', $user->id) }}">
                  @csrf
                  @method('PATCH')
                  <button class="button green small" type="submit">Approve</button>
                </form>
              </td>
              <td>
                @if ($user->ownerDetail && $user->ownerDetail->license_image_link)
                <button class="button small blue"
                  onclick="viewImage(`{{ asset('storage/' . $user->ownerDetail->license_image_link) }}`)">
                  View Image
                </button>
                @else
                N/A
                @endif
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="6" class="has-text-centered">No unapproved users found.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </section>
  <script>
    function viewImage(imageUrl) {
      const imagePopup = window.open('', '_blank', 'width=600,height=400');
      imagePopup.document.write(`
            <html>
                <head>
                    <title>License Image</title>
                </head>
                <body style="margin:0;display:flex;justify-content:center;align-items:center;height:100%;background-color:#000;">
                    <img src="${imageUrl}" style="max-width:100%;max-height:100%;">
                </body>
            </html>
        `);
    }
  </script>
</x-app-layout>