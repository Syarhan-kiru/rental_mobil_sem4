<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Rental Mobil</title>

  <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
  </script>
  <style>
    body {
      min-height: 100vh;
      background: linear-gradient(rgba(0, 0, 0, .45), rgba(0, 0, 0, .55)),
        url("{{ asset('images/dashboard/banner.jpg') }}");
      background-size: cover;
      background-position: center;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: sans-serif;
    }

    .login-card {
      width: 420px;
      background: #fff;
      padding: 35px;
      border-radius: 4px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, .25);
    }

    .login-logo {
      width: 60px;
      height: 60px;
      background: #00c8a8;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
      color: white;
      font-size: 28px;
    }

    .btn-login {
      background: #2946a3;
      color: white;
      font-weight: bold;
    }

    .btn-login:hover {
      background: #20398a;
      color: white;
    }
  </style>
</head>

<body>

  <div class="login-card">
    <div class="login-logo">
      <img src="{{ asset('images/RENTAL-MOBIL.jpeg') }}" alt="logo" style="width: 120px; height: auto; border-radius: 20px;" />
    </div>

    <h3 class="text-center mb-1">Rental Mobil</h3>
    <div class="card-body">
      @if (session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div>
      @endif

      <form action="{{ url('login/proses') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
          <label>Email</label>
          <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
        </div>

        <div class="form-group mb-4">
          <label>Password</label>
          <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
        </div>

        <button type="submit" class="btn btn-login w-100">
          Login
        </button>
      </form>
    </div>

</body>

</html>