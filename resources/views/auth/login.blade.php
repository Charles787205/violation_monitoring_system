<x-guest-layout>
    <section class="section main-section">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                    <span class="icon"><i class="mdi mdi-lock"></i></span>
                    Login
                </p>
            </header>
            <div class="card-content">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="field spaced">
                        <label class="label" for="email">Email</label>
                        <div class="control icons-left">
                            <input class="input" id="email" type="email" name="email" placeholder="user@example.com"
                                value="{{ old('email') }}" required autofocus autocomplete="username">
                            <span class="icon is-small left"><i class="mdi mdi-account"></i></span>
                        </div>
                        @error('email')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="field spaced">
                        <label class="label" for="password">Password</label>
                        <div class="control icons-left">
                            <input class="input" id="password" type="password" name="password" placeholder="Password"
                                required autocomplete="current-password">
                            <span class="icon is-small left"><i class="mdi mdi-asterisk"></i></span>
                        </div>
                        @error('password')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="field spaced">
                        <div class="control">
                            <label class="checkbox">
                                <input type="checkbox" name="remember" id="remember_me">
                                <span class="check"></span>
                                <span class="control-label">Remember me</span>
                            </label>
                        </div>
                    </div>

                    <hr>

                    <div class="field grouped">
                        <div class="control">
                            <button type="submit" class="button blue">
                                Log in
                            </button>
                        </div>
                        <div class="control">
                            <a href="{{ route('register') }}" class="button is-link">
                                Register Here
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-guest-layout>