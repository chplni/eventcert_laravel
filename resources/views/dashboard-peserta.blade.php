<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Peserta — EventCert</title>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="app-container">

  <nav class="navbar">
    <div class="logo-area">
      <div class="logo-icon">📜</div>
      <span>EventCert</span>
    </div>
    <div class="nav-menu">
      <a href="/dashboard" class="nav-item active">Dashboard</a>
      <a href="/sertifikat-saya" class="nav-item">Sertifikat Saya</a>
      <a href="/tentang" class="nav-item">Tentang</a>
      <a href="/logout" class="nav-item" onclick="return confirm('Yakin logout?')">🚪 Logout</a>
    </div>
  </nav>

  <section class="hero-section">
    <div class="hero-text">
      <h1>Halo, {{ session('nama') }}! 👋</h1>
      <p>Selamat datang di portal peserta EventCert. Lihat dan unduh sertifikat Anda di sini.</p>
    </div>
  </section>

  <!-- Kartu Profil Peserta -->
  <div class="info-peserta-card">
    <div class="info-peserta-icon">👤</div>
    <div class="info-peserta-detail">
      <h3>{{ session('nama') }}</h3>
      <p>📧 {{ session('email') ?? '-' }}</p>
      <p>🎫 Username: <strong>{{ session('username') }}</strong></p>
    </div>
  </div>

  <!-- AKSES CEPAT -->
  <div class="section-header">
    <h2>🎯 Akses Cepat</h2>
  </div>

  <div class="quick-actions">
    <a href="/sertifikat-saya" class="quick-card">
      <div class="quick-icon">📄</div>
      <h3>Lihat Sertifikat</h3>
      <p>Daftar sertifikat atas nama Anda</p>
    </a>

    <a href="/tentang" class="quick-card">
      <div class="quick-icon">ℹ️</div>
      <h3>Tentang Aplikasi</h3>
      <p>Info & fitur EventCert</p>
    </a>

    <a href="/logout" class="quick-card" onclick="return confirm('Yakin logout?')">
      <div class="quick-icon">🚪</div>
      <h3>Logout</h3>
      <p>Keluar dari akun Anda</p>
    </a>
  </div>

</div>
</body>
</html>