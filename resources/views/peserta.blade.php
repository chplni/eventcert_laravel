<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Peserta — EventCert</title>
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
    <h2>👥 Data Peserta</h2>
    <p>Kelola seluruh peserta event yang terdaftar.</p>
  </div>

  <div class="section-header">
    <h2>Daftar Peserta</h2>
    <a href="/tambah" class="btn btn-primary btn-sm">➕ Tambah Peserta</a>
  </div>

  <div class="filter-bar">
    <input type="text" class="search-input" id="searchInput" placeholder="🔍 Cari nama peserta atau event...">
    <select class="filter-select" id="filterStatus">
      <option value="all">Semua Status</option>
      <option value="terverifikasi">Terverifikasi</option>
      <option value="menunggu">Menunggu</option>
    </select>
  </div>

  <div class="table-wrapper">
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Peserta</th>
          <th>Event</th>
          <th>Tanggal</th>
          <th>No. Sertifikat</th>
          <th>Status</th>
          <th>Tindakan</th>
        </tr>
      </thead>
      <tbody id="tableBody">
        @forelse ($data_peserta as $index => $p)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>
              <strong>{{ $p->nama }}</strong><br>
              <small>{{ $p->email }}</small>
            </td>
            <td>{{ $p->event }}</td>
            <td>{{ \Carbon\Carbon::parse($p->tanggal)->translatedFormat('d F Y') }}</td>
            <td><code>{{ $p->no_sertifikat }}</code></td>
            <td>
              @if($p->status == 'terverifikasi')
                <span class="badge badge-verified">✅ Terverifikasi</span>
              @else
                <span class="badge badge-pending">⏳ Menunggu</span>
              @endif
            </td>
            <td>
              <div class="action-cell">
                <!-- Tombol Lihat (Modal) -->
                <button class="btn-icon" data-action="lihat" 
                        data-nama="{{ $p->nama }}" 
                        data-event="{{ $p->event }}" 
                        data-tanggal="{{ $p->tanggal }}" 
                        data-no="{{ $p->no_sertifikat }}" 
                        title="Lihat Sertifikat">👁️</button>

                                <!-- Tombol Terbitkan -->
                @if($p->status == 'menunggu')
                    <form action="/terbitkan/{{ $p->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Terbitkan sertifikat untuk peserta ini?');">
                        @csrf
                        <button type="submit" class="btn-icon" title="Terbitkan Sertifikat">📤</button>
                    </form>
                @endif
                
                <!-- Tombol Edit -->
                <a href="/edit/{{ $p->id }}" class="btn-icon" title="Edit">✏️</a>
                
                <!-- Tombol Hapus -->
                <form action="/hapus/{{ $p->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus peserta ini?');">
                  @csrf
                  <button type="submit" class="btn-icon" title="Hapus">🗑️</button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" style="text-align:center; padding: 40px; color: #a16207;">
              📭 Belum Ada Data Peserta
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
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

<!-- SCRIPT PENDUKUNG -->
<script src="{{ asset('js/utils.js') }}"></script>
<script src="{{ asset('js/certificate.js') }}"></script>
<script>
  // 1. Fitur Pencarian (Search) & Filter
  document.getElementById('searchInput').addEventListener('input', function(e) {
    let keyword = e.target.value.toLowerCase();
    let rows = document.querySelectorAll('#tableBody tr');
    rows.forEach(row => {
      let text = row.innerText.toLowerCase();
      row.style.display = text.includes(keyword) ? '' : 'none';
    });
  });

  // 2. Event Listener untuk Tombol Lihat (Mata)
  document.querySelectorAll('[data-action="lihat"]').forEach(btn => {
    btn.addEventListener('click', () => {
      const data = {
        nama: btn.getAttribute('data-nama'),
        event: btn.getAttribute('data-event'),
        tanggal: btn.getAttribute('data-tanggal'),
        noSertifikat: btn.getAttribute('data-no')
      };
      
      Certificate.render(data);
      document.getElementById('modalSertifikat').classList.add('active');
      document.body.style.overflow = 'hidden';
    });
  });

  // 3. Fungsi Tutup Modal (Tombol X, Tombol Tutup, Klik Background, atau Escape)
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

  // 4. Tombol Cetak
  document.getElementById('btnPrintSertifikat').addEventListener('click', () => window.print());
</script>
</body>
</html>