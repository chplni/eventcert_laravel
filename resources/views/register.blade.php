<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar Peserta — EventCert</title>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="login-wrapper">
  <div class="login-card">
    <div class="login-logo">
      <div class="logo-icon" style="width:56px;height:56px;font-size:1.8rem;">📜</div>
      <h2>Daftar Akun Peserta</h2>
      <p>Buat akun untuk melihat sertifikat Anda</p>
    </div>

    <?php if (!empty($_SESSION['error'])): ?>
      <div class="alert alert-error"><?= htmlspecialchars($_SESSION['error']) ?></div>
      <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form action="/register" method="POST">
    @csrf
      <div class="form-group">
        <label for="nama">Nama Lengkap</label>
        <input type="text" name="nama" id="nama" placeholder="Nama sesuai sertifikat" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="email@contoh.com" required>
      </div>
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" placeholder="Username unik" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Min. 6 karakter" minlength="6" required>
      </div>
      <div class="form-group">
        <label for="password2">Konfirmasi Password</label>
        <input type="password" name="password2" id="password2" placeholder="Ulangi password" minlength="6" required>
      </div>
      <button type="submit" class="btn btn-primary" style="width:100%;">📝 Daftar</button>
    </form>

    <div class="login-hint">
      Sudah punya akun? <a href="/login">Masuk di sini</a>
    </div>
  </div>
</div>
</body>
</html>