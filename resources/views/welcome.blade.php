<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EventCert — Platform Manajemen Sertifikat Digital</title>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<style>
  /* ===== CSS KHUSUS LANDING PAGE 3D ===== */
  body {
    background-color: #0d0500;
    background-image: 
      radial-gradient(circle at 10% 20%, rgba(249, 115, 22, 0.15), transparent 30%),
      radial-gradient(circle at 90% 80%, rgba(234, 88, 12, 0.10), transparent 30%);
    background-attachment: fixed;
    margin: 0;
    overflow-x: hidden;
    font-family: var(--font-main);
    color: #fed7aa;
  }

  .landing-nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 24px 8%;
    position: absolute;
    top: 0; left: 0; right: 0;
    z-index: 100;
  }

  .landing-logo-nav {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 1.5rem;
    font-weight: 800;
    color: #ffedd5;
  }

  .landing-logo-nav span {
    background: linear-gradient(135deg, #ea580c, #f97316);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .hero-section {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 120px 8% 50px;
    position: relative;
    gap: 40px;
  }

  /* BAGIAN TEKS KIRI */
  .hero-text {
    flex: 1;
    max-width: 650px;
    z-index: 50;
    position: relative;
    animation: slideRight 1s ease-out;
  }

  .badge-tag {
    display: inline-block;
    padding: 8px 16px;
    background: rgba(249, 115, 22, 0.15);
    border: 1px solid rgba(249, 115, 22, 0.3);
    border-radius: 30px;
    color: #fdba74;
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 24px;
    backdrop-filter: blur(10px);
  }

  /* Judul Utama EventCert */
  .hero-text h1 {
    font-size: 4.5rem;
    font-weight: 800;
    line-height: 1.1;
    letter-spacing: -0.03em;
    margin-bottom: 15px;
    background: linear-gradient(135deg, #ffffff 0%, #fdba74 50%, #f97316 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  /* Sub-judul Mengelola... */
  .hero-text h2 {
    font-size: 2rem;
    font-weight: 700;
    line-height: 1.3;
    color: #fdba74;
    margin-bottom: 24px;
  }

  .hero-text p {
    font-size: 1.15rem;
    line-height: 1.7;
    color: #fdba74;
    opacity: 0.85;
    margin-bottom: 40px;
  }

  /* TOMBOL */
  .hero-buttons {
    display: flex;
    gap: 16px;
    position: relative;
    z-index: 100;
  }

  .btn-hero {
    padding: 16px 36px;
    border-radius: 50px;
    font-size: 1.05rem;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    position: relative;
    z-index: 100;
    cursor: pointer;
  }

  .btn-hero-primary {
    background: linear-gradient(135deg, #ea580c, #f97316);
    color: white;
    box-shadow: 0 10px 30px rgba(249, 115, 22, 0.4);
  }

  .btn-hero-primary:hover {
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 15px 40px rgba(249, 115, 22, 0.6);
  }

  .btn-hero-outline {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(253, 186, 116, 0.3);
    color: #ffedd5;
    backdrop-filter: blur(10px);
  }

  .btn-hero-outline:hover {
    background: rgba(255, 255, 255, 0.1);
    transform: translateY(-3px);
  }

  /* BAGIAN KANAN (ILUSTRASI 3D) */
  .hero-visual {
    flex: 1;
    position: relative;
    height: 500px;
    display: flex;
    justify-content: center;
    align-items: center;
    perspective: 1000px;
    z-index: 10;
  }

  .stacked-cards {
    position: relative;
    width: 320px;
    height: 200px;
    transform-style: preserve-3d;
    animation: float 6s ease-in-out infinite;
  }

  .card-3d {
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 20px;
    padding: 25px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .card-back {
    background: rgba(26, 13, 0, 0.7);
    border: 1px solid rgba(253, 186, 116, 0.15);
    backdrop-filter: blur(10px);
    transform: translateZ(-50px) translateY(-40px) rotateX(10deg);
  }

  .card-middle {
    background: rgba(42, 21, 0, 0.8);
    border: 1px solid rgba(249, 115, 22, 0.2);
    backdrop-filter: blur(15px);
    transform: translateZ(0) translateY(0) rotateX(5deg);
  }

  .card-front {
    background: linear-gradient(135deg, rgba(249, 115, 22, 0.1), rgba(234, 88, 12, 0.05));
    border: 1px solid rgba(249, 115, 22, 0.4);
    backdrop-filter: blur(20px);
    transform: translateZ(50px) translateY(40px) rotateX(0deg);
  }

  .card-front::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 6px;
    background: linear-gradient(90deg, #ea580c, #f97316, #fdba74);
    border-radius: 20px 20px 0 0;
  }

  .card-logo {
    font-size: 1.5rem;
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 800;
    color: #ffedd5;
  }

  .card-details {
    margin-top: auto;
  }

  .card-details h4 {
    font-size: 1.3rem;
    color: #ffffff;
    margin: 0 0 8px 0;
  }

  .card-details p {
    font-size: 0.85rem;
    color: #fdba74;
    margin: 0;
    display: flex;
    justify-content: space-between;
  }

  @keyframes slideRight {
    from { opacity: 0; transform: translateX(-50px); }
    to { opacity: 1; transform: translateX(0); }
  }

  @keyframes float {
    0% { transform: translateY(0px) rotateY(-5deg); }
    50% { transform: translateY(-20px) rotateY(5deg); }
    100% { transform: translateY(0px) rotateY(-5deg); }
  }

  @media (max-width: 992px) {
    .hero-section {
      flex-direction: column;
      text-align: center;
      padding-top: 150px;
    }
    .hero-text h1 { font-size: 3.5rem; }
    .hero-text h2 { font-size: 1.5rem; }
    .hero-buttons { justify-content: center; }
    .hero-visual { margin-top: 60px; transform: scale(0.9); }
  }
</style>
</head>
<body>

  <nav class="landing-nav">
    <div class="landing-logo-nav">
      <div class="logo-icon" style="width:40px;height:40px;font-size:1.2rem;">📜</div>
      <span>EventCert</span>
    </div>
    <div>
      <a href="/login" class="btn btn-outline" style="padding: 8px 20px; font-size: 0.9rem;">Login Admin/Peserta</a>
    </div>
  </nav>

  <section class="hero-section">
    
    <div class="hero-text">
      <div class="badge-tag">✨ Platform Manajemen Sertifikat Digital</div>
      
      <h1>EventCert</h1>
      
      <h2>Mengelola dan Menerbitkan Sertifikat Peserta Event</h2>
      
      <p>Buat, kelola, dan cetak sertifikat peserta event Anda dengan mudah, cepat, dan profesional. Semua dalam satu platform cerdas.</p>
      
      <div class="hero-buttons">
        <a href="/login" class="btn-hero btn-hero-primary">🔐 Masuk Aplikasi</a>
        <a href="/register" class="btn-hero btn-hero-outline">📝 Daftar Peserta</a>
      </div>
    </div>

    <div class="hero-visual">
      <div class="stacked-cards">
        
        <div class="card-3d card-back">
          <div class="card-logo">📜 EventCert</div>
        </div>

        <div class="card-3d card-middle">
          <div class="card-logo">📜 EventCert</div>
        </div>

        <div class="card-3d card-front">
          <div class="card-logo">📜 EventCert</div>
          <div class="card-details">
            <h4>SERTIFIKAT PENGHARGAAN</h4>
            <p>
              <span>EC-2025-0001</span>
              <span>✅ Terverifikasi</span>
            </p>
          </div>
        </div>

      </div>
    </div>

  </section>

</body>
</html>