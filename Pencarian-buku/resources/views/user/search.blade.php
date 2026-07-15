<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Perpustakaan | Search</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
html, body {
  height: 100%;
}

body {
  display: flex;
  flex-direction: column;
}

.main-content {
  flex: 1;
}

:root {
  --navy: #3B5998;
  --navy-dark: #2C4A7C;
  --navy-darker: #2C3E50;
  --sage: #A8D08D;
  --sage-dark: #8FBF9A;
  --bg-page: #F4F7F6;
  --card: #FFFFFF;
  --border: #E5E9EC;
  --text: #2C3E50;
  --text-muted: #6B7B8C;
}

body {
  background: var(--bg-page);
  font-family: 'Segoe UI', sans-serif;
  color: var(--text);
}

/* NAVBAR */
.navbar {
  background: white;
  padding: 12px 30px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.logo {
  font-weight: bold;
  color: var(--navy);
  font-size: 20px;
}

/* HERO */
.hero {
  background: linear-gradient(135deg, var(--navy), var(--navy-dark));
  color: white;
  padding: 80px 20px;
  text-align: center;
}

.hero h1 {
  font-size: 42px;
  letter-spacing: 3px;
}

.hero p {
  opacity: 0.9;
}

/* SEARCH BOX */
.search-box {
  max-width: 600px;
  margin: 30px auto 0;
  position: relative;
}

.search-input {
  width: 100%;
  padding: 15px 50px 15px 20px;
  border-radius: 50px;
  border: none;
  outline: none;
  font-size: 16px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.15);
}

.search-btn {
  position: absolute;
  right: 5px;
  top: 5px;
  bottom: 5px;
  border: none;
  background: var(--navy);
  color: white;
  padding: 0 20px;
  border-radius: 50px;
  transition: 0.3s;
}

.search-btn:hover {
  background: var(--navy-dark);
}

/* RESULT — kartu dapat diklik (bukan gaya tautan biru bawaan browser) */
.result-card-link {
  margin-bottom: 15px;
  color: #1a1a1a;
  text-decoration: none;
}
.result-card-link:visited,
.result-card-link:hover,
.result-card-link:active {
  color: #1a1a1a;
  text-decoration: none;
}
.result-card-link .biblio-title {
  color: #0d1f17;
}
.result-card-link .biblio-author {
  color: #333;
}
.result-card-link .biblio-line {
  color: #2c2c2c;
}
.result-card-link .text-success {
  color: var(--sage-dark) !important;
}
.result-card-link .text-muted {
  color: #6c757d !important;
}
.result-card-link:focus-visible {
  outline: 3px solid var(--navy);
  outline-offset: 2px;
  border-radius: 14px;
}

.result-card {
  background: var(--card);
  border-radius: 12px;
  padding: 18px;
  transition: 0.25s;
  border: 1px solid var(--border);
  box-shadow: 0 2px 8px rgba(44, 62, 80, 0.04);
  cursor: pointer;
}

.result-card-link:hover .result-card {
  transform: translateY(-2px);
  box-shadow: 0 12px 28px rgba(59, 89, 152, 0.12);
  border-color: rgba(59, 89, 152, 0.35);
}

/* COVER — tidak memotong sampul (mirip katalog fisik) */
.book-cover-cell {
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(180deg, #eef1f5 0%, #e4e9ef 100%);
  border-radius: 10px;
  padding: 10px;
  min-height: 190px;
}

.book-img {
  max-width: 100%;
  max-height: 200px;
  width: auto;
  height: auto;
  object-fit: contain;
  border-radius: 6px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.12);
}

/* Deskripsi bibliografis (gaya ringkas mengikuti pola ISBD / katalog OPAC) */
.biblio-block {
  font-family: Georgia, 'Times New Roman', serif;
  color: #1a1a1a;
  line-height: 1.55;
}

.biblio-title {
  font-size: 1.15rem;
  font-weight: 700;
  margin-bottom: 0.35rem;
  letter-spacing: 0.02em;
}

.biblio-author {
  font-size: 0.98rem;
  margin-bottom: 0.65rem;
  font-style: italic;
  color: #333;
}

.biblio-line {
  font-size: 0.88rem;
  margin-bottom: 0.15rem;
  color: #2c2c2c;
}

.biblio-line .sep {
  color: #6c757d;
  margin: 0 0.25em;
}

/* Strip lokasi rak + petunjuk (di bawah kategori) */
.result-meta-strip {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: space-between;
  gap: 0.65rem 1rem;
  margin-top: 0.9rem;
  padding-top: 0.85rem;
  border-top: 1px solid #e4e9ee;
}

.rack-pill {
  display: inline-flex;
  align-items: center;
  gap: 0.45rem;
  background: linear-gradient(145deg, var(--navy-dark) 0%, var(--navy) 100%);
  color: #fff;
  padding: 0.4rem 1rem;
  border-radius: 999px;
  font-size: 0.8rem;
  font-weight: 600;
  letter-spacing: 0.03em;
  box-shadow: 0 3px 10px rgba(59, 89, 152, 0.22);
}

.rack-pill .fa-layer-group {
  opacity: 0.9;
  font-size: 0.75rem;
}

.hint-open {
  display: inline-flex;
  align-items: center;
  gap: 0.4rem;
  color: var(--text-muted);
  font-size: 0.78rem;
  background: #eef2f8;
  padding: 0.4rem 0.85rem;
  border-radius: 10px;
  border: 1px solid var(--border);
}

.result-card-link:hover .hint-open {
  background: #e8f0e4;
  border-color: var(--sage);
  color: var(--navy-darker);
}

@media (max-width: 575px) {
  .result-meta-strip {
    flex-direction: column;
    align-items: stretch;
  }
  .hint-open {
    justify-content: center;
  }
}

/* BADGE */
.badge-custom {
  padding: 6px 10px;
  font-size: 12px;
  border-radius: 6px;
}

/* FOOTER */
.footer {
  background: white;
  padding: 25px 20px;
  text-align: center;
  border-top: 1px solid #eee;
}

.social-icons {
  margin-bottom: 10px;
}

.social-icons a {
  color: #333;
  font-size: 20px;
  margin: 0 10px;
  transition: 0.3s;
}

/* Hover warna sesuai brand */
.social-icons a:hover {
  transform: scale(1.2);
}

.social-icons a.instagram:hover {
  color: #E1306C;
}

.social-icons a.whatsapp:hover {
  color: #25D366;
}

.social-icons a.tiktok:hover {
  color: #761b1b;
}

.social-icons a.twitter:hover {
  color: #1DA1F2;
}

.social-icons a.facebook:hover {
  color: #1877F2;
}

</style>
</head>

<body>

<!-- NAVBAR -->
<div class="logo d-flex align-items-center gap-2">
  <img 
    src="https://png.pngtree.com/png-vector/20250211/ourmid/pngtree-colorful-book-stack-logo-design-perfect-for-education-or-library-projects-vector-png-image_15444285.png" 
    alt="Logo Perpustakaan"
    style="width:45px; height:45px; object-fit:contain;"
  >
  <span>PERPUSTAKAAN UMUM</span>
</div>

<!-- HERO -->
<div class="hero">
  <h1>PERPUSTAKAAN UMUM</h1>
  <p>Temukan buku favorit Anda Dengan Cepat dan Mudah</p>

  <div class="search-box">
    <input 
      type="text" 
      id="keyword"
      class="search-input"
      placeholder="Ketik judul atau pengarang..."
    >
    <button class="search-btn" onclick="cari()">
      <i class="fa-solid fa-magnifying-glass"></i>
    </button>
  </div>
</div>

<div class="main-content">
  <div class="container mt-4">

  <!-- INFO -->
  <div id="infoHasil" class="mb-3 text-muted text-center"></div>

  <!-- LOADING -->
  <div id="loading" class="text-center d-none">
    <div class="spinner-border text-success"></div>
  </div>

  <!-- HASIL -->
  <div id="hasil"></div>

</div>
</div>

<!-- FOOTER -->
<div class="footer">
  <div class="social-icons">

    <a href="https://instagram.com/perpusbogor/" target="_blank" class="instagram">
      <i class="fab fa-instagram"></i>
    </a>

    <a href="https://api.whatsapp.com/send/?phone=6282114281622&text&type=phone_number&app_absent=0" target="_blank" class="whatsapp">
      <i class="fab fa-whatsapp"></i>
    </a>

    <a href="https://tiktok.com/@perpusbogor" target="_blank" class="tiktok">
      <i class="fab fa-tiktok"></i>
    </a>

    <a href="https://x.com/diskarpus" target="_blank" class="twitter">
      <i class="fab fa-twitter"></i>
    </a>

    <a href="https://www.facebook.com/diskarpuskotabogor" target="_blank" class="facebook">
      <i class="fab fa-facebook"></i>
    </a>

  </div>
  <small>Copyright © 2026 Perpustakaan Umum</small>
</div>

<script>

function escHtml(t) {
  if (t == null || t === '') return '';
  const d = document.createElement('div');
  d.textContent = t;
  return d.innerHTML;
}

// ENTER
document.getElementById("keyword").addEventListener("keypress", function(e){
  if(e.key === "Enter") cari();
});

// AUTO SEARCH SAAT MENGETIK
let searchTimeout;

document.getElementById("keyword").addEventListener("input", function () {

  clearTimeout(searchTimeout);

  let keyword = this.value.trim();

  // kosongkan hasil jika input kosong
  if(keyword === ""){
    document.getElementById("hasil").innerHTML = "";
    document.getElementById("infoHasil").innerHTML = "";
    return;
  }

  // delay 300ms agar tidak request setiap huruf
  searchTimeout = setTimeout(() => {
    cari();
  }, 300);

});

function cari(){
  let keyword = document.getElementById("keyword").value;

  if(keyword.trim() === ""){
    alert("Masukkan kata kunci!");
    return;
  }

  document.getElementById("loading").classList.remove("d-none");
  document.getElementById("hasil").innerHTML = "";
  document.getElementById("infoHasil").innerHTML = "";

  fetch('/search?keyword='+keyword)
  .then(res=>res.json())
  .then(data=>{

    document.getElementById("loading").classList.add("d-none");

    document.getElementById("infoHasil").innerHTML = `
      Ditemukan <strong>${data.length}</strong> buku
    `;

    if(data.length === 0){
      document.getElementById("hasil").innerHTML = `
        <div class="alert alert-danger text-center">
          Buku tidak ditemukan
        </div>
      `;
      return;
    }

    let html = "";

    data.forEach(buku=>{

      const cover = buku.cover 
        ? `/images/cover/${buku.cover}` 
        : 'https://via.placeholder.com/180x240?text=No+Cover';

      const rackName = buku.rack?.nama_rak ?? '-';
      const penerbit = buku.penerbit ?? '—';
      const tahun = buku.tahun ?? 'n.p.';
      const kategori = buku.kategori ?? '—';

      html += `
        <a href="/pencarian-buku/detail/${buku.id}" class="result-card-link d-block" aria-label="Buka detail buku">
        <div class="result-card row align-items-stretch">

          <div class="col-md-2">
            <div class="book-cover-cell h-100">
              <img src="${cover}" class="book-img" alt="Sampul ${escHtml(buku.judul)}">
            </div>
          </div>

          <div class="col-md-10 py-1">
            <div class="biblio-block">
              <div class="biblio-title">${escHtml(buku.judul)}</div>
              <div class="biblio-author">${escHtml(buku.pengarang)}</div>
              <div class="biblio-line">${escHtml(penerbit)}<span class="sep">,</span> ${escHtml(String(tahun))}.</div>
              <div class="biblio-line"><span class="text-muted">Kategori</span><span class="sep">:</span> ${escHtml(kategori)}.</div>
            </div>
            <div class="result-meta-strip">
              <span class="rack-pill"><i class="fas fa-layer-group"></i>${escHtml(rackName)}</span>
              <span class="hint-open"><i class="far fa-hand-pointer"></i><span>Klik untuk detail buku</span></span>
            </div>
          </div>

        </div>
        </a>
      `;
    });

    document.getElementById("hasil").innerHTML = html;

  });
}

</script>

</body>
</html>