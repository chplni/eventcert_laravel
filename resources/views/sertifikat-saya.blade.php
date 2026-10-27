<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sertifikat Saya — EventCert</title>
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
      <a href="/dashboard-peserta" class="nav-item">Dashboard</a>
      <a href="/sertifikat-saya" class="nav-item active">Sertifikat Saya</a>
      <a href="/tentang" class="nav-item">Tentang</a>
      <a href="/logout" class="nav-item" onclick="return confirm('Yakin logout?')">🚪 Logout</a>
    </div>
  </nav>

  <div class="page-header">
    <h2>📄 Sertifikat Saya</h2>
    <p>Semua sertifikat yang telah diterbitkan untuk Anda.</p>
  </div>

  @if(count($data_sertifikat) === 0)
    <div class="empty-state">
      <div class="icon">📭</div>
      <h3>Belum Ada Sertifikat</h3>
      <p>Belum ada sertifikat yang diterbitkan untuk akun Anda.</p>
    </div>
  @else
    <div class="cert-grid">
      @foreach($data_sertifikat as $p)
        <div class="cert-item">
          <span class="cert-item-no">{{ $p->no_sertifikat }}</span>
          <div class="cert-item-name">{{ $p->nama }}</div>
          <div class="cert-item-event">📌 {{ $p->event }}</div>
          <div class="cert-item-date">📅 {{ \Carbon\Carbon::parse($p->tanggal)->translatedFormat('d F Y') }}</div>
          <div class="cert-item-actions">
            <button class="btn btn-primary" 
                    data-action="lihat" 
                    data-nama="{{ $p->nama }}"
                    data-event="{{ $p->event }}"
                    data-tanggal="{{ $p->tanggal }}"
                    data-no="{{ $p->no_sertifikat }}">
              👁️ Lihat Sertifikat
            </button>
          </div>
        </div>
      @endforeach
    </div>
  @endif

</div>

<!-- MODAL SERTIFIKAT -->
<div class="modal-overlay" id="modalSertifikat">
  <div class="modal-content" style="max-width:800px;">
    <div class="modal-header">
      <h3>📄 Sertifikat</h3>
      <button class="modal-close" data-close-modal="modalSertifikat">&times;</button>
    </div>
    <div id="certificatePreviewContainer"></div>
    <div class="form-actions" style="margin-top:20px;">
      <button type="button" class="btn btn-outline" data-close-modal="modalSertifikat">Tutup</button>
      <button type="button" class="btn btn-primary" id="btnPrintSertifikat">🖨️ Cetak / Simpan PDF</button>
    </div>
  </div>
</div>

<script src="{{ asset('js/utils.js') }}"></script>
<script src="{{ asset('js/certificate.js') }}"></script>
<script>
  document.querySelectorAll('[data-action="lihat"]').forEach(btn => {
    btn.addEventListener('click', () => {
      const data = {
        nama: btn.dataset.nama,
        event: btn.dataset.event,
        tanggal: btn.dataset.tanggal,
        noSertifikat: btn.dataset.no
      };
      Certificate.render(data);
      document.getElementById('modalSertifikat').classList.add('active');
      document.body.style.overflow = 'hidden';
    });
  });

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