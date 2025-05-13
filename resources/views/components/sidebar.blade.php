<aside
  class="fixed inset-y-0 left-0 z-20 flex flex-col w-64 transition-all duration-300 bg-white border-r shadow-lg transform sidebar lg:translate-x-0 lg:static lg:inset-0"
  x-show="true" x-data="{ isDropdownOpen: false }">
  <!-- Sidebar Header -->
  <div class="flex items-center justify-center h-16 px-6 bg-gradient-to-r from-blue-600 to-indigo-700">
    <div class="flex items-center">
      <img src="{{ asset('img/lto.jpeg') }}" class="w-8 h-8 mr-3 rounded" alt="Logo">
      <span class="text-xl font-bold text-white">Traffic Monitoring</span>
    </div>
  </div>

  <!-- Sidebar Content -->
  <div class="flex flex-col flex-1 overflow-y-auto">
    <!-- General Section -->
    <div class="py-4">
      <p class="px-6 py-2 text-xs font-semibold tracking-wider text-gray-500 uppercase">General</p>
      <ul class="mt-2">
        <li>
          <a href="/dashboard"
            class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors duration-200 {{ request()->is('dashboard') ? 'bg-blue-50 text-blue-700 border-r-4 border-blue-700' : '' }}">
            <span class="flex items-center justify-center w-8 h-8 mr-3 text-blue-600 bg-blue-100 rounded-md">
              <i class="mdi mdi-view-dashboard text-lg"></i>
            </span>
            <span class="text-sm font-medium">Dashboard</span>
          </a>
        </li>
      </ul>
    </div>

    <!-- Management Section -->
    <div class="py-4">
      <p class="px-6 py-2 text-xs font-semibold tracking-wider text-gray-500 uppercase">Management</p>
      <ul class="mt-2">
        @if (Auth::check() && Auth::user()->role === 'admin')
        <!-- Vehicles -->
        <li>
          <a href="/vehicles"
            class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors duration-200 {{ request()->is('vehicles*') ? 'bg-blue-50 text-blue-700 border-r-4 border-blue-700' : '' }}">
            <span class="flex items-center justify-center w-8 h-8 mr-3 text-green-600 bg-green-100 rounded-md">
              <i class="mdi mdi-car text-lg"></i>
            </span>
            <span class="text-sm font-medium">Vehicles</span>
          </a>
        </li>

        <!-- Violations -->
        <li x-data="{violationOpen: {{ request()->is('violations*') ? 'true' : 'false' }}}">
          <a @click="violationOpen = !violationOpen"
            class="flex items-center justify-between px-6 py-3 text-gray-700 cursor-pointer hover:bg-blue-50 hover:text-blue-700 transition-colors duration-200 {{ request()->is('violations*') ? 'bg-blue-50 text-blue-700 border-r-4 border-blue-700' : '' }}">
            <div class="flex items-center">
              <span class="flex items-center justify-center w-8 h-8 mr-3 text-red-600 bg-red-100 rounded-md">
                <i class="mdi mdi-alert-circle text-lg"></i>
              </span>
              <span class="text-sm font-medium">Violations</span>
            </div>
            <i class="mdi" :class="{'mdi-chevron-up': violationOpen, 'mdi-chevron-down': !violationOpen}"></i>
          </a>
          <ul x-show="violationOpen" x-collapse class="pl-16 mt-1 bg-gray-50">
            <li>
              <a href="{{ route('violations.index') }}"
                class="block py-2 text-sm text-gray-600 hover:text-blue-700 {{ request()->routeIs('violations.index') ? 'text-blue-700 font-medium' : '' }}">
                All Violations
              </a>
            </li>
            <li>
              <a href="{{ route('violations.pending') }}"
                class="block py-2 text-sm text-gray-600 hover:text-blue-700 {{ request()->routeIs('violations.pending') ? 'text-blue-700 font-medium' : '' }}">
                Pending Violations
              </a>
            </li>
            <li>
              <a href="{{ route('violations.paid') }}"
                class="block py-2 text-sm text-gray-600 hover:text-blue-700 {{ request()->routeIs('violations.paid') ? 'text-blue-700 font-medium' : '' }}">
                Paid Violations
              </a>
            </li>
          </ul>
        </li>

        <!-- Owner Approval -->
        <li>
          <a href="{{ route('owner.approval') }}"
            class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors duration-200 {{ request()->routeIs('owner.approval') ? 'bg-blue-50 text-blue-700 border-r-4 border-blue-700' : '' }}">
            <span class="flex items-center justify-center w-8 h-8 mr-3 text-purple-600 bg-purple-100 rounded-md">
              <i class="mdi mdi-account-check text-lg"></i>
            </span>
            <span class="text-sm font-medium">Owner Approval</span>
            @if(App\Models\User::where('is_approved', false)->count() > 0)
            <span
              class="ml-auto inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">
              {{ App\Models\User::where('is_approved', false)->count() }}
            </span>
            @endif
          </a>
        </li>
        @elseif (Auth::check() && Auth::user()->role === 'client')
        <!-- My Vehicles -->
        <li>
          <a href="{{ route('client.my_vehicles') }}"
            class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors duration-200 {{ request()->routeIs('client.my_vehicles') ? 'bg-blue-50 text-blue-700 border-r-4 border-blue-700' : '' }}">
            <span class="flex items-center justify-center w-8 h-8 mr-3 text-green-600 bg-green-100 rounded-md">
              <i class="mdi mdi-car text-lg"></i>
            </span>
            <span class="text-sm font-medium">My Vehicles</span>
          </a>
        </li>

        <!-- My Violations -->
        <li>
          <a href="{{ route('client.my_violations') }}"
            class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors duration-200 {{ request()->routeIs('client.my_violations') ? 'bg-blue-50 text-blue-700 border-r-4 border-blue-700' : '' }}">
            <span class="flex items-center justify-center w-8 h-8 mr-3 text-red-600 bg-red-100 rounded-md">
              <i class="mdi mdi-alert-circle text-lg"></i>
            </span>
            <span class="text-sm font-medium">My Violations</span>
            @php
            $pendingCount = Auth::user()->ownerDetail ? Auth::user()->ownerDetail->violations()->where('status',
            'pending')->count() : 0;
            @endphp
            @if($pendingCount > 0)
            <span
              class="ml-auto inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">
              {{ $pendingCount }}
            </span>
            @endif
          </a>
        </li>
        @endif
      </ul>
    </div>

    <!-- App Info -->
    <div class="mt-auto p-4 border-t border-gray-100">
      <div class="flex items-center justify-center">
        <div class="text-xs text-center text-gray-500">
          <p>Traffic Violation Monitoring</p>
          <p>Version 1.0</p>
        </div>
      </div>
    </div>
  </div>
</aside>