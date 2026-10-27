<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sertifikat — EventCert</title>
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
      <a href="/peserta" class="nav-item">Data Peserta</a>
      <a href="/sertifikat" class="nav-item active">Sertifikat</a>
      <a href="/tentang" class="nav-item">Tentang Aplikasi</a>
      <a href="/logout" class="nav-item" onclick="return confirm('Yakin logout?')">🚪 Logout</a>
    </div>
  </nav>

  <div class="page-header">
    <h2>📄 Daftar Sertifikat</h2>
    <p>Semua sertifikat yang telah diterbitkan.</p>
  </div>

  <div class="filter-bar">
    <input type="text" class="search-input" id="searchSertifikat" placeholder="🔍 Cari nomor sertifikat atau nama...">
  </div>

  <div class="cert-grid" id="certGrid">
    @forelse ($data_sertifikat as $p)
      <div class="cert-item">
        <span class="cert-item-no">{{ $p->no_sertifikat }}</span>
        <div class="cert-item-name">{{ $p->nama }}</div>
        <div class="cert-item-event">📌 {{ $p->event }}</div>
        <div class="cert-item-date">📅 {{ \Carbon\Carbon::parse($p->tanggal)->translatedFormat('d F Y') }}</div>
        <div class="cert-item-actions">
          <!-- Tombol Lihat -->
          <button class="btn btn-outline" data-action="lihat" 
                  data-nama="{{ $p->nama }}" 
                  data-event="{{ $p->event }}" 
                  data-tanggal="{{ $p->tanggal }}" 
                  data-no="{{ $p->no_sertifikat }}">👁️ Lihat</button>
          
          <!-- Tombol Cetak -->
          <button class="btn btn-primary" data-action="cetak" 
                  data-nama="{{ $p->nama }}" 
                  data-event="{{ $p->event }}" 
                  data-tanggal="{{ $p->tanggal }}" 
                  data-no="{{ $p->no_sertifikat }}">🖨️ Cetak</button>
        </div>
      </div>
    @empty
      <div class="empty-state" style="grid-column: 1/-1;">
        <div class="icon">📄</div>
        <h3>Belum Ada Sertifikat Terbit</h3>
        <p>Sertifikat yang sudah diterbitkan akan muncul di sini.</p>
      </div>
    @endforelse
  </div>

</div>

<!-- MODAL SERTIFIKAT -->
<div class="modal-overlay" id="modalSertifikat">
  <div class="modal-content" style="max-width:800px;">
    <div class="modal-header">
      <h3>📄 Pratinjau Sertifikat</h3>
      <button class="modal-close" data-close-modal="modalSertifikat">&times;</button>
    </div>
    <div id="certificatePreviewContainer"></div>
    <div class="form-actions" style="margin-top:20px;">
      <button type="button" class="btn btn-outline" data-close-modal="modalSertifikat">Tutup</button>
      <button type="button" class="btn btn-primary" id="btnPrintSertifikat">🖨️ Cetak</button>
    </div>
  </div>
</div>

<div class="toast-container" id="toastContainer"></div>

<script src="{{ asset('js/utils.js') }}"></script>
<script src="{{ asset('js/certificate.js') }}"></script>
<script>
  // 1. Fitur Pencarian (Search)
  document.getElementById('searchSertifikat').addEventListener('input', function(e) {
    let keyword = e.target.value.toLowerCase();
    let items = document.querySelectorAll('.cert-item');
    
    items.forEach(item => {
      let text = item.innerText.toLowerCase();
      if (text.includes(keyword)) {
        item.style.display = 'flex';
      } else {
        item.style.display = 'none';
      }
    });
  });

  // 2. Event Listener untuk Tombol Lihat & Cetak
  document.querySelectorAll('[data-action="lihat"], [data-action="cetak"]').forEach(btn => {
    btn.addEventListener('click', () => {
      const data = {
        nama: btn.getAttribute('data-nama'),
        event: btn.getAttribute('data-event'),
        tanggal: btn.getAttribute('data-tanggal'),
        noSertifikat: btn.getAttribute('data-no')
      };
      
      // Render desain sertifikat ke dalam modal
      Certificate.render(data);
      
      // Buka modal
      document.getElementById('modalSertifikat').classList.add('active');
      document.body.style.overflow = 'hidden';

      // Jika yang diklik tombol "Cetak", langsung munculkan dialog print
      if (btn.getAttribute('data-action') === 'cetak') {
        setTimeout(() => window.print(), 400);
      }
    });
  });

  // 3. Fungsi Tutup Modal
  document.querySelectorAll('[data-close-modal]').forEach(btn => {
    btn.addEventListener('click', () => {
      document.getElementById(btn.dataset.closeModal).classList.remove('active');
      document.body.style.overflow = '';
    });
  });

  document.getElementById('modalSertifikat').addEventListener('click', (e) => {
    if (e.target.id === 'modalSertifikat') {
      e.target.classList.remove('active');
      document.body.style.overflow = '';
    }
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      document.querySelectorAll('.modal-overlay.active').forEach(m => m.classList.remove('active'));
      document.body.style.overflow = '';
    }
  });

  document.getElementById('btnPrintSertifikat').addEventListener('click', () => window.print());
</script>
</body>
</html>