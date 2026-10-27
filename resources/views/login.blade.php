<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login — EventCert</title>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="login-wrapper">
  <div class="login-card">
    <div class="login-logo">
      <div class="logo-icon" style="width:64px;height:64px;font-size:2rem;">📜</div>
      <h2>EventCert</h2>
      <p>Platform Manajemen Sertifikat Digital</p>
    </div>

    <form action="/login" method="POST">
      @csrf
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" placeholder="Masukkan username" required autofocus>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Masukkan password" required>
      </div>
      <button type="submit" class="btn btn-primary" style="width:100%;">🔐 Masuk</button>
    </form>

    <div class="login-hint">
      <strong>Admin demo:</strong> <code>admin</code> / <code>admin123</code><br>
      <span style="display:inline-block;margin-top:8px;">
        Peserta? <a href="/register" class="link-orange">Daftar di sini</a>
      </span>
    </div>
  </div>
</div>
</body>
</html>