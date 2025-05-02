<x-guest-layout>
  <section class="section main-section">
    <div class="card">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="mdi mdi-account-plus"></i></span>
          Client Registration
        </p>
      </header>
      <div class="card-content">
        <form id="registration-form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
          @csrf

          <div id="step-1">
            <!-- Name -->
            <div class="field spaced">
              <label class="label" for="name">Name</label>
              <div class="control icons-left">
                <input class="input" id="name" type="text" name="name" placeholder="Full Name" value="{{ old('name') }}"
                  required autofocus>
                <span class="icon is-small left"><i class="mdi mdi-account"></i></span>
              </div>
              @error('name')
              <p class="help is-danger">{{ $message }}</p>
              @enderror
            </div>

            <!-- Email Address -->
            <div class="field spaced">
              <label class="label" for="email">Email</label>
              <div class="control icons-left">
                <input class="input" id="email" type="email" name="email" placeholder="user@example.com"
                  value="{{ old('email') }}" required>
                <span class="icon is-small left"><i class="mdi mdi-email"></i></span>
              </div>
              @error('email')
              <p class="help is-danger">{{ $message }}</p>
              @enderror
            </div>

            <!-- Address -->
            <div class="field spaced">
              <label class="label" for="address">Address</label>
              <div class="control icons-left">
                <input class="input" id="address" type="text" name="address" placeholder="Address"
                  value="{{ old('address') }}" required>
                <span class="icon is-small left"><i class="mdi mdi-home"></i></span>
              </div>
              @error('address')
              <p class="help is-danger">{{ $message }}</p>
              @enderror
            </div>

            <!-- Password -->
            <div class="field spaced">
              <label class="label" for="password">Password</label>
              <div class="control icons-left">
                <input class="input" id="password" type="password" name="password" placeholder="Password" required>
                <span class="icon is-small left"><i class="mdi mdi-lock"></i></span>
              </div>
              @error('password')
              <p class="help is-danger">{{ $message }}</p>
              @enderror
            </div>

            <!-- Confirm Password -->
            <div class="field spaced">
              <label class="label" for="password_confirmation">Confirm Password</label>
              <div class="control icons-left">
                <input class="input" id="password_confirmation" type="password" name="password_confirmation"
                  placeholder="Confirm Password" required>
                <span class="icon is-small left"><i class="mdi mdi-lock-check"></i></span>
              </div>
              @error('password_confirmation')
              <p class="help is-danger">{{ $message }}</p>
              @enderror
            </div>

            <div class="field grouped">
              <div class="control">
                <button type="button" class="button blue" id="next-button">
                  Next
                </button>
              </div>
            </div>


          </div>

          <div id="step-2" style="display: none;">
            <!-- License Number -->
            <div class="field spaced">
              <label class="label" for="license_number">License Number</label>
              <div class="control icons-left">
                <input class="input" id="license_number" type="text" name="license_number" placeholder="License Number"
                  value="{{ old('license_number') }}" required>
                <span class="icon is-small left"><i class="mdi mdi-card-account-details"></i></span>
              </div>
              @error('license_number')
              <p class="help is-danger">{{ $message }}</p>
              @enderror
            </div>

            <!-- License Image -->
            <div class="field spaced">
              <label class="label" for="license_image_link">License Image</label>
              <div class="control icons-left">
                <input class="input" id="license_image_link" type="file" name="license_image_link" accept="image/*"
                  required>
                <span class="icon is-small left"><i class="mdi mdi-image"></i></span>
              </div>
              @error('license_image_link')
              <p class="help is-danger">{{ $message }}</p>
              @enderror
            </div>

            <div class="field grouped">

              <div class="control">
                <button type="button" class="button blue" id="back-button" style="display: none;">
                  Back
                </button>
                <button type="submit" class="button green">
                  Submit
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>

  <script>
    document.getElementById('next-button').addEventListener('click', function () {
      document.getElementById('step-1').style.display = 'none';
      document.getElementById('step-2').style.display = 'block';
      document.getElementById('back-button').style.display = 'inline-block';
    });

    document.getElementById('back-button').addEventListener('click', function () {
      document.getElementById('step-2').style.display = 'none';
      document.getElementById('step-1').style.display = 'block';
      document.getElementById('back-button').style.display = 'none';
    });
  </script>
</x-guest-layout>