// ===== CRUD via API PHP =====
const CRUD = (() => {
  const API = 'api/peserta.php';

  async function request(url, options = {}) {
    const res = await fetch(url, { credentials: 'same-origin', ...options });
    if (res.status === 401) { location.href = 'auth/login.php'; throw new Error('Session habis'); }
    const data = await res.json();
    if (!res.ok) throw new Error(data.error || 'Gagal');
    return data;
  }

  function toQuery(opts) {
    const p = new URLSearchParams({ action: 'list' });
    if (opts.search) p.set('search', opts.search);
    if (opts.status && opts.status !== 'all') p.set('status', opts.status);
    if (opts.sort) { p.set('sort', opts.sort); p.set('dir', opts.dir || 'asc'); }
    return p.toString();
  }

  const query    = (o) => request(`${API}?${toQuery(o)}`);
  const getById  = (id) => request(`${API}?action=detail&id=${id}`);
  const getStats = () => request(`${API}?action=stats`);

  async function create(data) {
    return request(`${API}?action=create`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data)
    });
  }
  async function update(data) {
    return request(`${API}?action=update`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data)
    });
  }
  async function terbitkan(id) {
    return request(`${API}?action=terbitkan`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ id })
    });
  }
  async function remove(id) {
    return request(`${API}?action=delete`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ id })
    });
  }

  return { query, getById, getStats, create, update, terbitkan, remove };
})();