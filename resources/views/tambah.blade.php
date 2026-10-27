<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Peserta — EventCert</title>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="app-container">

  <!-- 1. NAVBAR -->
  <nav class="navbar">
    <div class="logo-area">
      <div class="logo-icon">📜</div>
      <span>EventCert</span>
    </div>
    <div class="nav-menu">
      <a href="/dashboard" class="nav-item">Dashboard</a>
      <a href="/peserta" class="nav-item active">Data Peserta</a>
      <a href="/sertifikat" class="nav-item">Sertifikat</a>
      <a href="/tentang" class="nav-item">Tentang Aplikasi</a>
      <a href="/logout" class="nav-item" onclick="return confirm('Yakin logout?')">🚪 Logout</a>
    </div>
  </nav>

  <!-- 2. JUDUL HALAMAN -->
  <div class="page-header">
    <h2>➕ Tambah Peserta Baru</h2>
    <p>Isi data peserta di bawah ini.</p>
  </div>

  <!-- 3. FORM CARD -->
  <div class="form-card">
    <form action="/tambah" method="POST">
      @csrf

      <!-- Input Nama -->
      <div class="form-group">
        <label>Nama Lengkap Peserta *</label>
        <input type="text" name="nama" placeholder="Masukkan nama lengkap" required>
      </div>
      
      <!-- Input Email -->
      <div class="form-group">
        <label>Email Peserta *</label>
        <input type="email" name="email" placeholder="contoh@email.com" required>
      </div>

      <!-- Dropdown Pilih Event -->
      <div class="form-group">
        <label>Pilih Event *</label>
        <select name="event_id" class="filter-select" style="width:100%; padding:14px 20px; border-radius:40px;" required>
          <option value="">-- Pilih Event --</option>
          @foreach ($events as $ev)
            <option value="{{ $ev->id }}">{{ $ev->nama_event }} ({{ date('d M Y', strtotime($ev->tanggal)) }})</option>
          @endforeach
        </select>
      </div>

      <!-- Input Tanggal -->
      <div class="form-group">
        <label>Tanggal Pelaksanaan *</label>
        <input type="date" name="tanggal" required>
      </div>

      <!-- Preview Nomor Sertifikat -->
      <div class="nomor-preview">
        <span>🔢 Nomor Sertifikat akan dibuat otomatis</span>
        <strong>EC-{{ date('Y') }}-XXXX</strong>
      </div>

      <!-- Tombol Aksi -->
      <div class="form-actions">
        <a href="/peserta" class="btn btn-outline">Batal</a>
        <button type="submit" class="btn btn-primary">💾 Simpan Peserta</button>
      </div>
    </form>
  </div>

</div>
</body>
</html>