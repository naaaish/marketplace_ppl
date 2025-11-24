<h2>Halo {{ $user->name }}</h2>
<p>Silakan buat password Anda.</p>
<form method="POST" action="{{ route('activation.process') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="password" name="password" placeholder="Password Baru" required>
    <button type="submit">Simpan Password</button>
</form>