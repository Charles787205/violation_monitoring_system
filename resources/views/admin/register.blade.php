<x-guest-layout>
  <section class="section main-section">
    <div class="card">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="mdi mdi-account-plus"></i></span>
          Register Admin
        </p>
      </header>
      <div class="card-content">
        <form method="POST" action="{{ route('register.admin.store') }}">
          @csrf
          <div class="field">
            <label class="label">Name</label>
            <div class="control">
              <input class="input" type="text" name="name" value="{{ old('name') }}" required>
            </div>
          </div>
          <div class="field">
            <label class="label">Email</label>
            <div class="control">
              <input class="input" type="email" name="email" value="{{ old('email') }}" required>
            </div>
          </div>
          <div class="field">
            <label class="label">Password</label>
            <div class="control">
              <input class="input" type="password" name="password" required>
            </div>
          </div>
          <div class="field">
            <label class="label">Confirm Password</label>
            <div class="control">
              <input class="input" type="password" name="password_confirmation" required>
            </div>
          </div>
          <div class="field">
            <div class="control">
              <button class="button green" type="submit">Register</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</x-guest-layout>