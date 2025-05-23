<x-app-layout>
  <section class="section main-section py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Header Banner -->
      <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl shadow-lg mb-6">
        <div class="flex flex-col md:flex-row items-center justify-between p-6">
          <div class="flex items-center space-x-3 text-white">
            <span class="text-3xl"><i class="mdi mdi-car"></i></span>
            <h1 class="text-2xl font-bold">Vehicles Management</h1>
          </div>
          <a href="{{ route('vehicles.create') }}"
            class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 bg-white text-blue-600 border border-transparent rounded-md font-semibold text-sm hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white focus:ring-offset-blue-600 transition-all duration-200">
            <i class="mdi mdi-plus-circle mr-2"></i>
            Add New Vehicle
          </a>
        </div>
      </div>

      <!-- Search and Filter Section -->
      <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 mb-6">
        <header class="bg-gray-50 px-6 py-4 border-b border-gray-100">
          <div class="flex items-center space-x-2">
            <span class="text-xl text-gray-700"><i class="mdi mdi-filter-variant"></i></span>
            <h2 class="text-lg font-semibold text-gray-700">Search & Filter</h2>
          </div>
        </header>
        <div class="p-6">
          <form action="{{ route('vehicles.index') }}" method="GET" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
              <!-- Search Box -->
              <div class="col-span-1 md:col-span-2">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                <div class="relative rounded-md shadow-sm">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="mdi mdi-magnify text-gray-400"></i>
                  </div>
                  <input type="text" name="search" id="search"
                    class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-12 sm:text-sm border-gray-300 rounded-md"
                    placeholder="License Plate, Make, Model or Owner" value="{{ request('search') }}">
                </div>
              </div>

              <!-- Year Filter -->
              <div>
                <label for="year" class="block text-sm font-medium text-gray-700 mb-1">Year</label>
                <select id="year" name="year"
                  class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                  <option value="">All Years</option>
                  @for ($i = date('Y'); $i >= date('Y')-30; $i--)
                  <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                  @endfor
                </select>
              </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-3 pt-2">
              <a href="{{ route('vehicles.index') }}"
                class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="mdi mdi-refresh mr-2"></i>
                Reset
              </a>
              <button type="submit"
                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="mdi mdi-filter mr-2"></i>
                Apply Filters
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- Vehicles Table Card -->
      <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <header class="bg-gray-50 px-6 py-4 border-b border-gray-100">
          <div class="flex items-center space-x-2">
            <span class="text-xl text-gray-700"><i class="mdi mdi-format-list-bulleted"></i></span>
            <h2 class="text-lg font-semibold text-gray-700">Registered Vehicles</h2>
          </div>
        </header>

        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  License Plate
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Make
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Model
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Year
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Owner
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Violations
                </th>
                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Actions
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach ($vehicles as $vehicle)
              <tr class="hover:bg-gray-50 transition-colors duration-200">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 text-blue-500">
                      <i class="mdi mdi-card-account-details text-lg"></i>
                    </div>
                    <div class="ml-3 font-medium text-gray-900">{{ $vehicle->license_plate }}</div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                  {{ $vehicle->make }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                  {{ $vehicle->model }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                  {{ $vehicle->year }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div
                      class="flex-shrink-0 h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-500">
                      <i class="mdi mdi-account"></i>
                    </div>
                    <div class="ml-3 text-sm font-medium text-gray-700">
                      {{ $vehicle->user ? $vehicle->user->name : 'N/A' }}
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  @php $violationCount = $vehicle->violations->count(); @endphp
                  @if($violationCount > 0)
                  <span
                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $violationCount > 3 ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800' }}">
                    {{ $violationCount }} {{ Str::plural('violation', $violationCount) }}
                  </span>
                  @else
                  <span
                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                    No violations
                  </span>
                  @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                  <div class="flex items-center justify-end space-x-2">
                    <a href="{{ route('vehicles.edit', $vehicle) }}"
                      class="inline-flex items-center p-2 border border-transparent rounded-full text-blue-600 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
                      title="Edit">
                      <i class="mdi mdi-pencil"></i>
                    </a>
                    <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" class="inline-flex">
                      @csrf
                      @method('DELETE')
                      <button type="submit"
                        class="inline-flex items-center p-2 border border-transparent rounded-full text-red-600 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200"
                        onclick="return confirm('Are you sure you want to delete this vehicle?')" title="Delete">
                        <i class="mdi mdi-trash-can"></i>
                      </button>
                    </form>
                    <a href="{{ route('vehicles.show', $vehicle) }}"
                      class="inline-flex items-center p-2 border border-transparent rounded-full text-green-600 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200"
                      title="View Details">
                      <i class="mdi mdi-eye"></i>
                    </a>
                  </div>
                </td>
              </tr>
              @endforeach

              @if($vehicles->count() === 0)
              <tr>
                <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                  <div class="flex flex-col items-center justify-center">
                    <i class="mdi mdi-alert-circle-outline text-4xl text-gray-400"></i>
                    <p class="mt-2 text-lg">No vehicles found</p>
                    <a href="{{ route('vehicles.create') }}"
                      class="mt-3 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200">
                      <i class="mdi mdi-plus-circle mr-2"></i>
                      Add Your First Vehicle
                    </a>
                  </div>
                </td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>

        <div class="bg-white px-6 py-4 border-t border-gray-200">
          {{ $vehicles->withQueryString()->onEachSide(1)->links() }}
        </div>
      </div>
    </div>
  </section>
</x-app-layout>