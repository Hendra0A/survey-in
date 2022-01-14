<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Password Baru</title>
  <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="/fontawesome5/css/all.css" />
  <link rel="stylesheet" href="/css/custom-view.css" />
  <link rel="stylesheet" href="/css/lupa-password.css" />
</head>

<body>
  <div class="container-fluid d-flex flex-column ps-0 pe-0 m-0" style="background: #f3f8ff; min-height: 100vh;">
    <div class="header d-flex justify-content-between align-items-centers py-md-3 px-md-5 p-2">
      <div class="logo d-flex align-items-center">
        <a href="{{ url()->previous() }}" class="nav-link"><i class="fas fa-chevron-left text-dark"></i></a>
        <span class="fw-bold">Lupa Password</span>
      </div>
    </div>
    <div class="content">
      <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 90vh">
          <h1 class="fs-3 text-center">Lupa Password</h1>
          <div class="keterangan col-12 col-md-8 d-flex flex-column flex-md-row-reverse align-items-center">
            <img class="keterangan-img" src="/img/lupa-pw.png" alt="">
            <div class="keterangan-text text-center text-md-start col">
              <p class="fw-bold">Masukkan alamat email yang terkait dengan akun Anda</p>
              <p class="keterangan-bawah">Kami akan mengirim email kepada Anda untuk mengatur ulang password</p>
            </div>
          </div>
          <div class="inputan d-flex col-12 col-md-8 flex-column justify-content-between">
            <form action="/forgot-password" method="post">
              @csrf
              <input class="input-email rounded-3 w-100 p-3 mb-5" type="text" name="email" placeholder="Masukan Email"
                autofocus>
              <button type="submit" class="py-3 btn btn-email btn-primary w-100">Kirim</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}">
  <script src="{{ asset('/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>