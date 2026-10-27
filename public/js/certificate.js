// ===== SERTIFIKAT: render & cetak =====
const Certificate = (() => {

  function render(p) {
    const c = document.getElementById('certificatePreviewContainer');
    c.innerHTML = `
      <div class="certificate-preview">
        <div class="cert-logo">
          <div class="logo-icon" style="width:32px;height:32px;font-size:1rem;">📜</div>
          <span>EventCert</span>
        </div>

        <h2 class="cert-title">SERTIFIKAT PENGHARGAAN</h2>
        <p class="cert-subtitle">Diberikan kepada</p>

        <div style="text-align:center;">
          <span class="cert-name">${Utils.escapeHtml(p.nama)}</span>
        </div>

        <p class="cert-desc">
          Sebagai penghargaan atas partisipasi dan kontribusi dalam kegiatan<br>
          <strong>${Utils.escapeHtml(p.event)}</strong><br>
          yang diselenggarakan pada ${Utils.formatTanggal(p.tanggal)}
        </p>

        <div class="cert-meta">
          <div>
            <div style="font-size:0.7rem;letter-spacing:1px;">NOMOR SERTIFIKAT</div>
            <strong>${Utils.escapeHtml(p.noSertifikat)}</strong>
          </div>
          <div class="cert-signature">
            <div style="height:40px;"></div>
            <strong>Penyelenggara Event</strong>
          </div>
        </div>
      </div>
    `;
  }

  return { render };
})();