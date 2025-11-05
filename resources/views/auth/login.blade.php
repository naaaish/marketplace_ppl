<form method="POST" action="{{ route('login') }}">
    @csrf

    <div>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" :value="old('email')" required autofocus>
    </div>

    <div class="mt-4">
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>
    </div>

    <div class="block mt-4">
        <label for="remember">
            <input id="remember" type="checkbox" name="remember">
            <span>Remember me</span>
        </label>
    </div>

    <div class="flex items-center justify-end mt-4">
        <button type="submit">
            Log in
        </button>
    </div>
</form>