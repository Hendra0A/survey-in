<form action="/reset-password" method="post">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="email" name="email" placeholder="Email">
    @error('email')
    {{ $message }}
    @enderror
    <input type="password" name="password" placeholder="Masukkan password">
    @error('password')
    {{ $message }}
    @enderror
    <input type="password" name="password_confirmation" placeholder="Konfirmasi password">
    @error('password_confirmation')
    {{ $message }}
    @enderror

    <button type="submit">Ubah password</button>
</form>