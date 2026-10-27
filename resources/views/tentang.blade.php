<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tentang Aplikasi — EventCert</title>
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
    @if(session('role') === 'peserta')
        <a href="/dashboard" class="nav-item">Dashboard</a>
        <a href="/sertifikat-saya" class="nav-item">Sertifikat Saya</a>
    @else
        <a href="/dashboard" class="nav-item">Dashboard</a>
        <a href="/peserta" class="nav-item">Data Peserta</a>
        <a href="/sertifikat" class="nav-item">Sertifikat</a>
    @endif

    <a href="/tentang" class="nav-item active">Tentang Aplikasi</a>
    <a href="/logout" class="nav-item" onclick="return confirm('Yakin logout?')">🚪 Logout</a>
</div>
  </nav>

  <div class="page-header">
    <h2>ℹ️ Tentang Aplikasi</h2>
    <p>Informasi lengkap mengenai EventCert.</p>
  </div>

  <div class="about-card">

    <!-- Header aplikasi -->
    <div class="about-logo">
      <div class="logo-icon" style="width:80px;height:80px;font-size:2.5rem;border-radius:22px;">📜</div>
      <h3>EventCert</h3>
      <span class="about-version">✨ Versi 1.0</span>
    </div>

    <!-- Deskripsi -->
    <p class="about-desc">
      <strong>EventCert</strong> adalah platform manajemen dan penerbitan sertifikat digital
      yang dirancang untuk memudahkan penyelenggara event dalam mengelola peserta,
      menerbitkan sertifikat, dan mencetaknya secara profesional — semua dalam satu aplikasi.
    </p>

    <!-- Fitur Utama -->
    <div class="about-section">
      <h4>✨ Fitur Utama</h4>
      <div class="feature-grid">

        <div class="feature-item">
          <span class="feature-icon">🔐</span>
          <div>
            <strong>Login & Logout</strong>
            <p>Autentikasi dengan session & multi-role</p>
          </div>
        </div>

        <div class="feature-item">
          <span class="feature-icon">📝</span>
          <div>
            <strong>Manajemen Peserta</strong>
            <p>Tambah, edit, hapus data peserta</p>
          </div>
        </div>

        <div class="feature-item">
          <span class="feature-icon">🔢</span>
          <div>
            <strong>Penomoran Otomatis</strong>
            <p>Format EC-TAHUN-0001</p>
          </div>
        </div>

        <div class="feature-item">
          <span class="feature-icon">🖨️</span>
          <div>
            <strong>Cetak Sertifikat</strong>
            <p>Pratinjau & cetak profesional</p>
          </div>
        </div>

        <div class="feature-item">
          <span class="feature-icon">🔍</span>
          <div>
            <strong>Pencarian & Filter</strong>
            <p>Cari, filter status, urutkan data</p>
          </div>
        </div>

        <div class="feature-item">
          <span class="feature-icon">💾</span>
          <div>
            <strong>Database MySQL</strong>
            <p>Data tersimpan permanen</p>
          </div>
        </div>

        <div class="feature-item">
          <span class="feature-icon">📊</span>
          <div>
            <strong>Statistik Dashboard</strong>
            <p>Ringkasan data real-time</p>
          </div>
        </div>

        <div class="feature-item">
          <span class="feature-icon">👥</span>
          <div>
            <strong>Multi-Role</strong>
            <p>Admin & Peserta dengan portal terpisah</p>
          </div>
        </div>

      </div>
    </div>

    <!-- Teknologi -->
    <div class="about-section">
      <h4>🛠️ Teknologi yang Digunakan</h4>
      <div class="tech-list">
        <span class="tech-badge">PHP 7+ (PDO)</span>
        <span class="tech-badge">MySQL</span>
        <span class="tech-badge">HTML5</span>
        <span class="tech-badge">CSS3</span>
        <span class="tech-badge">JavaScript ES6</span>
        <span class="tech-badge">Session Auth</span>
      </div>
      <p class="tech-note">
        Dibuat tanpa framework atau library eksternal — murni kode PHP & JavaScript asli.
      </p>
    </div>

    <!-- Info Aplikasi -->
    <div class="about-section">
      <h4>📋 Informasi Aplikasi</h4>
      <div class="info-grid">
        <div class="info-row">
          <span>Nama Aplikasi</span>
          <strong>EventCert</strong>
        </div>
        <div class="info-row">
          <span>Versi</span>
          <strong>1.0.0</strong>
        </div>
        <div class="info-row">
          <span>Jenis</span>
          <strong>Web Application</strong>
        </div>
        <div class="info-row">
          <span>Kategori</span>
          <strong>Manajemen Sertifikat Digital</strong>
        </div>
        <div class="info-row">
          <span>Bahasa</span>
          <strong>Indonesia</strong>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <div class="about-footer">
     <p>© {{ date('Y') }} EventCert — Platform Manajemen Sertifikat Digital</p>
      <p style="margin-top:6px;font-size:0.75rem;opacity:0.5;">
        Dibuat untuk memudahkan penyelenggara event
      </p>
    </div>

  </div>

</div>
</body>
</html>