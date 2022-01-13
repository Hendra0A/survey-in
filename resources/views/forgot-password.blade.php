<form action="/forgot-password" method="post">
    @csrf
    <input type="email" name="email" placeholder="Masukkan email anda">
    @error('email')
    {{ $message }}
    @enderror

    <button type="submit">Submit</button>
</form>