const Utils = (() => {
  function escapeHtml(t) {
    if (!t) return '';
    const d = document.createElement('div');
    d.textContent = t;
    return d.innerHTML;
  }
  function formatTanggal(iso) {
    if (!iso) return '-';
    try {
      const d = new Date(iso);
      if (isNaN(d)) return iso;
      return d.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
    } catch { return iso; }
  }
  function showToast(msg, type = 'success') {
    const c = document.getElementById('toastContainer');
    if (!c) return;
    const t = document.createElement('div');
    t.className = `toast ${type}`;
    t.innerHTML = `${type === 'success' ? '✅' : '❌'} ${escapeHtml(msg)}`;
    c.appendChild(t);
    setTimeout(() => {
      t.style.opacity = '0';
      t.style.transition = 'opacity 0.3s';
      setTimeout(() => t.remove(), 300);
    }, 2800);
  }
  return { escapeHtml, formatTanggal, showToast };
})();