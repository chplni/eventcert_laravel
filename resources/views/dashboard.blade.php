<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard — EventCert</title>
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
      <a href="/peserta" class="nav-item">Data Peserta</a>
      <a href="/sertifikat" class="nav-item">Sertifikat</a>
      <a href="/tentang" class="nav-item">Tentang Aplikasi</a>
      <a href="/logout" class="nav-item">🚪 Logout</a>
    </div>
  </nav>

  <section class="hero-section">
    <div class="hero-text">
      <h1>Selamat Datang, {{ session('nama') }}!</h1>
      <p>Kelola peserta, terbitkan, dan cetak sertifikat digital dengan mudah, cepat, dan profesional.</p>
    </div>
    <div class="hero-actions">
      <a href="tambah.php" class="btn btn-primary">➕ Tambah Peserta</a>
      <a href="sertifikat.php" class="btn btn-outline">📄 Lihat Sertifikat</a>
    </div>
  </section>

  <div class="stats-grid">
    <div class="stat-card">
      <div class="stat-icon">👥</div>
      <div class="stat-label">Total Peserta</div>
      <div class="stat-value" id="statTotalPeserta">6</div>
      <div class="stat-desc">Peserta terdaftar</div>
    </div>
    <div class="stat-card">
      <div class="stat-icon">✅</div>
      <div class="stat-label">Sertifikat Terbit</div>
      <div class="stat-value" id="statSertifikatTerbit">5</div>
      <div class="stat-desc">Telah diterbitkan</div>
    </div>
    <div class="stat-card">
      <div class="stat-icon">⏳</div>
      <div class="stat-label">Menunggu</div>
      <div class="stat-value" id="statMenunggu">1</div>
      <div class="stat-desc">Persetujuan tertunda</div>
    </div>
    <div class="stat-card">
      <div class="stat-icon">📅</div>
      <div class="stat-label">Total Event</div>
      <div class="stat-value" id="statTotalEvent">6</div>
      <div class="stat-desc">Event terdaftar</div>
    </div>
  </div>

</div>

<div class="toast-container" id="toastContainer"></div>

<script src="{{ asset('js/utils.js') }}"></script>
<script src="{{ asset('js/crud.js') }}"></script>

<script>
  (async () => {
    const s = await CRUD.getStats();
    document.getElementById('statTotalPeserta').textContent = s.totalPeserta;
    document.getElementById('statSertifikatTerbit').textContent = s.terbit;
    document.getElementById('statMenunggu').textContent = s.menunggu;
    document.getElementById('statTotalEvent').textContent = s.totalEvent;
  })();
</script>
</body>
</html>