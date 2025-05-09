<x-app-layout>
  <section class="section main-section py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Header Banner -->
      <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl shadow-lg mb-6">
        <div class="flex flex-col md:flex-row items-center justify-between p-6">
          <div class="flex items-center space-x-3 text-white">
            <span class="text-3xl"><i class="mdi mdi-account-check"></i></span>
            <h1 class="text-2xl font-bold">Owner Verification</h1>
          </div>
          <div class="mt-4 md:mt-0 px-4 py-2 bg-blue-400 bg-opacity-30 rounded-lg text-white font-medium">
            <div class="flex items-center">
              <i class="mdi mdi-information-outline mr-2"></i>
              <span>Review and approve vehicle owner registrations</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Statistics Summary -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center">
          <div class="rounded-full bg-blue-100 p-3 mr-4">
            <i class="mdi mdi-account-clock text-blue-600 text-2xl"></i>
          </div>
          <div>
            <p class="text-sm text-gray-500">Pending Approvals</p>
            <p class="text-xl font-bold text-gray-800">{{ count($unapprovedUsers) }}</p>
          </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center">
          <div class="rounded-full bg-green-100 p-3 mr-4">
            <i class="mdi mdi-account-check text-green-600 text-2xl"></i>
          </div>
          <div>
            <p class="text-sm text-gray-500">Approved Today</p>
            <p class="text-xl font-bold text-gray-800">
              {{ App\Models\User::where('is_approved', true)->whereDate('updated_at', today())->count() }}</p>
          </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center">
          <div class="rounded-full bg-purple-100 p-3 mr-4">
            <i class="mdi mdi-account-multiple text-purple-600 text-2xl"></i>
          </div>
          <div>
            <p class="text-sm text-gray-500">Total Owners</p>
            <p class="text-xl font-bold text-gray-800">{{ App\Models\User::where('role', 'client')->count() }}</p>
          </div>
        </div>
      </div>

      <!-- Owner Approval List -->
      <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <header class="bg-gray-50 px-6 py-4 border-b border-gray-100">
          <div class="flex items-center space-x-2">
            <span class="text-xl text-gray-700"><i class="mdi mdi-account-alert"></i></span>
            <h2 class="text-lg font-semibold text-gray-700">Owner Verification Requests</h2>
          </div>
        </header>

        <div class="overflow-x-auto">
          @if(count($unapprovedUsers) > 0)
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Owner</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  License Details</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Contact Info</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Documents</th>
                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Actions</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach ($unapprovedUsers as $user)
              <tr class="hover:bg-gray-50 transition-colors duration-200">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div
                      class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">
                      <i class="mdi mdi-account text-lg"></i>
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                      <div class="text-sm text-gray-500">Registered {{ $user->created_at->diffForHumans() }}</div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4">
                  <div class="text-sm text-gray-900">License: {{ $user->ownerDetail->license_number ?? 'Not provided' }}
                  </div>
                  <div class="text-sm text-gray-500">{{ $user->ownerDetail->address ?? 'No address provided' }}</div>
                </td>
                <td class="px-6 py-4">
                  <div class="text-sm text-gray-900">{{ $user->email }}</div>
                  <div class="text-sm text-gray-500">{{ $user->ownerDetail->phone ?? 'No phone provided' }}</div>
                </td>
                <td class="px-6 py-4">
                  @if ($user->ownerDetail && $user->ownerDetail->license_image_link)
                  <button onclick="viewImage(`{{ asset('storage/' . $user->ownerDetail->license_image_link) }}`)"
                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                    <i class="mdi mdi-file-document-outline mr-1.5"></i>
                    View License
                  </button>
                  @else
                  <span class="px-2 py-1 text-xs font-medium rounded-full text-orange-700 bg-orange-100">No
                    document</span>
                  @endif
                </td>
                <td class="px-6 py-4 text-right">
                  <form method="POST" action="{{ route('users.approve', $user->id) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit"
                      class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200"
                      onclick="return confirm('Are you sure you want to approve this owner?')">
                      <i class="mdi mdi-check mr-2"></i>
                      Approve
                    </button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @else
          <div class="flex flex-col items-center justify-center py-16 text-center">
            <div class="rounded-full bg-green-100 p-4 mb-4">
              <i class="mdi mdi-check-circle text-green-500 text-3xl"></i>
            </div>
            <h3 class="mt-2 text-lg font-medium text-gray-900">No pending approvals</h3>
            <p class="mt-1 text-sm text-gray-500">
              All owner verification requests have been processed. You're all caught up!
            </p>
          </div>
          @endif
        </div>
      </div>
    </div>
  </section>

  <!-- Image View Modal -->
  <script>
    function viewImage(imageUrl) {
      // Create modal container
      const modal = document.createElement('div');
      modal.className = 'fixed inset-0 z-50 overflow-y-auto';
      modal.style.backgroundColor = 'rgba(0, 0, 0, 0.75)';
      modal.style.display = 'flex';
      modal.style.alignItems = 'center';
      modal.style.justifyContent = 'center';

      // Modal content
      modal.innerHTML = `
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-4xl w-full">
          <div class="bg-gray-100 px-4 py-3 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-lg font-medium text-gray-900">License Document</h3>
            <button id="closeModal" class="text-gray-400 hover:text-gray-500">
              <i class="mdi mdi-close text-xl"></i>
            </button>
          </div>
          <div class="p-4 flex items-center justify-center bg-gray-800">
            <img src="${imageUrl}" class="max-w-full max-h-[70vh]" alt="License Image">
          </div>
          <div class="bg-gray-100 px-4 py-3 flex justify-end">
            <button id="downloadBtn" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
              <i class="mdi mdi-download mr-2"></i>
              Download
            </button>
            <button id="closeBtn" class="ml-3 inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              Close
            </button>
          </div>
        </div>
      `;

      // Add modal to body
      document.body.appendChild(modal);

      // Handle close buttons
      document.getElementById('closeModal').addEventListener('click', () => {
        document.body.removeChild(modal);
      });

      document.getElementById('closeBtn').addEventListener('click', () => {
        document.body.removeChild(modal);
      });

      // Handle download button
      document.getElementById('downloadBtn').addEventListener('click', () => {
        const a = document.createElement('a');
        a.href = imageUrl;
        a.download = 'license-document.jpg';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
      });

      // Close on background click
      modal.addEventListener('click', (e) => {
        if (e.target === modal) {
          document.body.removeChild(modal);
        }
      });
    }
  </script>
</x-app-layout>