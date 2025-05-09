<x-app-layout>
  <section class="section main-section py-8">
    <div class="max-w-3xl mx-auto">
      <div
        class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl border border-gray-100">
        <header class="bg-gradient-to-r from-blue-500 to-indigo-600 py-5 px-6">
          <div class="flex items-center space-x-3">
            <span class="text-white text-2xl"><i class="mdi mdi-car"></i></span>
            <h2 class="text-xl font-bold text-white">Add New Vehicle</h2>
          </div>
        </header>

        <div class="p-6">
          <form method="POST" action="{{ route('vehicles.store') }}">
            @csrf

            <div class="mb-5">
              <label class="block text-sm font-medium text-gray-700 mb-1" for="license_plate">License Plate</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <i class="mdi mdi-card-account-details text-gray-400"></i>
                </div>
                <input id="license_plate"
                  class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                  type="text" name="license_plate" value="{{ old('license_plate') }}"
                  placeholder="Enter license plate number" required>
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
              <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1" for="make">Make</label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="mdi mdi-factory text-gray-400"></i>
                  </div>
                  <input id="make"
                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                    type="text" name="make" value="{{ old('make') }}" placeholder="Toyota, Honda, etc." required>
                </div>
              </div>

              <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1" for="model">Model</label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="mdi mdi-car-side text-gray-400"></i>
                  </div>
                  <input id="model"
                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                    type="text" name="model" value="{{ old('model') }}" placeholder="Camry, Civic, etc." required>
                </div>
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
              <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1" for="year">Year</label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="mdi mdi-calendar text-gray-400"></i>
                  </div>
                  <input id="year"
                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                    type="number" name="year" value="{{ old('year') }}" placeholder="2025" min="1900"
                    max="{{ date('Y') + 1 }}" required>
                </div>
              </div>

              <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1" for="user_id">Owner</label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="mdi mdi-account text-gray-400"></i>
                  </div>
                  <select id="user_id"
                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 appearance-none bg-no-repeat bg-right"
                    name="user_id" style="background-position: right 0.5rem center; background-size: 1.5em 1.5em;">
                    <option value="">Select Vehicle Owner</option>
                    @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                      {{ $user->name }}</option>
                    @endforeach
                  </select>
                  <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                    <i class="mdi mdi-chevron-down text-lg"></i>
                  </div>
                </div>
              </div>
            </div>

            <div class="mt-8 flex items-center justify-between">
              <a href="{{ route('vehicles.index') }}"
                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                <i class="mdi mdi-arrow-left mr-2"></i> Back
              </a>
              <button type="submit"
                class="inline-flex items-center px-6 py-3 border border-transparent rounded-md shadow-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                <i class="mdi mdi-content-save mr-2"></i> Save Vehicle
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</x-app-layout>