<nav id="navbar-main" class="sticky top-0 z-30 flex items-center h-16 bg-white border-b shadow-sm">
  <!-- Mobile menu button -->
  <div class="flex items-center px-4 lg:hidden">
    <button id="mobile-menu-button" class="text-gray-500 hover:text-blue-600 focus:outline-none">
      <i class="mdi mdi-menu text-2xl"></i>
    </button>
  </div>

  <!-- Navbar Content -->
  <div class="flex items-center justify-between flex-1 px-6">
    <!-- Left side - Breadcrumb (can be expanded later) -->
    <div class="flex items-center">
      <span class="text-gray-600">
        @php
        $currentRouteName = Route::currentRouteName();
        $pageTitle = '';

        if (str_contains($currentRouteName, 'dashboard')) {
        $pageTitle = 'Dashboard';
        } elseif (str_contains($currentRouteName, 'vehicles')) {
        $pageTitle = 'Vehicle Management';
        } elseif (str_contains($currentRouteName, 'violations')) {
        $pageTitle = 'Violation Records';
        } elseif (str_contains($currentRouteName, 'owner.approval')) {
        $pageTitle = 'Owner Approval';
        } elseif (str_contains($currentRouteName, 'client.my_vehicles')) {
        $pageTitle = 'My Vehicles';
        } elseif (str_contains($currentRouteName, 'client.my_violations')) {
        $pageTitle = 'My Violations';
        }
        @endphp
        <span class="font-medium text-lg text-gray-800">{{ $pageTitle }}</span>
      </span>
    </div>

    <!-- Right side - Account menu -->
    <div class="flex items-center space-x-4">
      <!-- Date display -->
      <div class="hidden md:block">
        <div class="px-3 py-1.5 bg-blue-50 text-blue-700 text-sm rounded-md">
          <i class="mdi mdi-calendar mr-1"></i>
          {{ \Carbon\Carbon::now()->format('F d, Y') }}
        </div>
      </div>

      <!-- User dropdown -->
      <div class="relative" x-data="{ isOpen: false }">
        <button @click="isOpen = !isOpen" @keydown.escape="isOpen = false"
          class="flex items-center space-x-3 focus:outline-none">
          <div class="flex items-center space-x-3">
            <div class="w-10 h-10 overflow-hidden bg-gray-200 rounded-full border border-gray-300">
              @if(Auth::check() && Auth::user()->role === 'admin')
              <div class="flex items-center justify-center h-full bg-blue-100 text-blue-700">
                <i class="mdi mdi-shield-account text-xl"></i>
              </div>
              @else
              <div class="flex items-center justify-center h-full bg-green-100 text-green-700">
                <i class="mdi mdi-account text-xl"></i>
              </div>
              @endif
            </div>
            <div class="hidden md:block">
              <div class="text-sm font-medium text-gray-900">{{ Auth::check() ? Auth::user()->name : 'Guest' }}</div>
              <div class="text-xs text-gray-500">
                {{ Auth::check() ? (Auth::user()->role === 'admin' ? 'Administrator' : 'Vehicle Owner') : 'Not logged in' }}
              </div>
            </div>
          </div>
          <div class="text-gray-400">
            <i class="mdi mdi-chevron-down"></i>
          </div>
        </button>

        <!-- Dropdown menu -->
        <div x-show="isOpen" @click.away="isOpen = false" x-transition:enter="transition ease-out duration-100"
          x-transition:enter-start="transform opacity-0 scale-95"
          x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
          x-transition:leave-start="transform opacity-100 scale-100"
          x-transition:leave-end="transform opacity-0 scale-95"
          class="absolute right-0 w-56 mt-2 bg-white rounded-md shadow-lg border border-gray-100 overflow-hidden"
          style="display: none;">

          <div class="px-4 py-3 border-b border-gray-100">
            <div class="text-sm font-semibold text-gray-900">{{ Auth::check() ? Auth::user()->name : 'Guest' }}</div>
            <div class="text-xs text-gray-600 truncate">{{ Auth::check() ? Auth::user()->email : 'Not logged in' }}
            </div>
          </div>

          <div class="py-2">
            <a href="{{ route('profile.edit') }}"
              class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
              <i class="mdi mdi-account-edit mr-3 text-blue-600"></i>
              <span>Edit Profile</span>
            </a>

            @if (Auth::check() && Auth::user()->role === 'admin')
            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
              <i class="mdi mdi-cog mr-3 text-gray-600"></i>
              <span>Settings</span>
            </a>
            @endif

            <hr class="my-1 border-gray-100">

            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                <i class="mdi mdi-logout mr-3 text-red-600"></i>
                <span>Sign out</span>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</nav>

<!-- Mobile menu overlay -->
<div id="mobile-menu-overlay" class="fixed inset-0 z-20 hidden bg-black bg-opacity-50 lg:hidden"></div>

<script>
  // Mobile menu toggle
  document.addEventListener('DOMContentLoaded', function () {
    const menuButton = document.getElementById('mobile-menu-button');
    const sidebar = document.querySelector('.sidebar');
    const overlay = document.getElementById('mobile-menu-overlay');

    if (menuButton && sidebar && overlay) {
      menuButton.addEventListener('click', function () {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
      });

      overlay.addEventListener('click', function () {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
      });
    }
  });
</script>