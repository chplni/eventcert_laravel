<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Peserta — EventCert</title>
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
      <a href="/dashboard" class="nav-item">Dashboard</a>
      <a href="/peserta" class="nav-item active">Data Peserta</a>
      <a href="/sertifikat" class="nav-item">Sertifikat</a>
      <a href="/tentang" class="nav-item">Tentang Aplikasi</a>
      <a href="/logout" class="nav-item" onclick="return confirm('Yakin logout?')">🚪 Logout</a>
    </div>
  </nav>

  <div class="page-header">
    <h2>✏️ Edit Peserta</h2>
    <p>Perbarui informasi peserta di bawah ini.</p>
  </div>

  <div class="form-card">
    <form action="/edit" method="POST">
      @csrf
      
      <!-- Inputan Hidden -->
      <input type="hidden" name="sertifikat_id" value="{{ $data->id }}">
      <input type="hidden" name="peserta_id" value="{{ $data->peserta_id }}">

      <div class="form-group">
        <label>Nama Lengkap Peserta *</label>
        <input type="text" name="nama" value="{{ $data->nama }}" required>
      </div>
      
      <div class="form-group">
        <label>Email Peserta *</label>
        <input type="email" name="email" value="{{ $data->email }}" required>
      </div>

      <div class="form-group">
        <label>Pilih Event *</label>
        <select name="event_id" class="filter-select" style="width:100%; padding:14px 20px; border-radius:40px;" required>
          @foreach($events as $ev)
            <option value="{{ $ev->id }}" {{ $data->event_id == $ev->id ? 'selected' : '' }}>
              {{ $ev->nama_event }} ({{ date('d M Y', strtotime($ev->tanggal)) }})
            </option>
          @endforeach
        </select>
      </div>

      <div class="nomor-preview">
        <span>🔢 Nomor Sertifikat:</span>
        <strong>{{ $data->no_sertifikat }}</strong>
      </div>

      <div class="form-actions">
        <a href="/peserta" class="btn btn-outline">Batal</a>
        <button type="submit" class="btn btn-primary">💾 Simpan Perubahan</button>
      </div>
    </form>
  </div>

</div>
<div class="toast-container" id="toastContainer"></div>
<script src="{{ asset('js/utils.js') }}"></script>
<script src="{{ asset('js/crud.js') }}"></script>
</body>
</html>