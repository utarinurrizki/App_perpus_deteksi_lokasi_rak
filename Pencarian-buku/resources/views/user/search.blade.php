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

body {
  background: #f4f6f9;
  font-family: 'Segoe UI', sans-serif;
}

/* NAVBAR */
.navbar {
  background: white;
  padding: 12px 30px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.logo {
  font-weight: bold;
  color: #1b4332;
}

/* HERO */
.hero {
  background: linear-gradient(135deg, #1b4332, #2d6a4f);
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
  background: #40916c;
  color: white;
  padding: 0 20px;
  border-radius: 50px;
  transition: 0.3s;
}

.search-btn:hover {
  background: #2d6a4f;
}

/* RESULT */
.result-card {
  background: white;
  border-radius: 12px;
  padding: 15px;
  margin-bottom: 15px;
  transition: 0.3s;
}

.result-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 20px rgba(0,0,0,0.08);
}

/* COVER */
.book-img {
  width: 100%;
  height: 140px;
  object-fit: cover;
  border-radius: 8px;
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
<div class="navbar">
  <div class="logo">📚 PERPUSTAKAAN UMUM</div>
</div>

<!-- HERO -->
<div class="hero">
  <h1>PERPUSTAKAAN UMUM</h1>
  <p>Sarana Pencarian Buku Perpustakaan Umum</p>

  <div class="search-box">
    <input 
      type="text" 
      id="keyword"
      class="search-input"
      placeholder="Cari judul, pengarang..."
    >
    <button class="search-btn" onclick="cari()">🔍</button>
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

// ENTER
document.getElementById("keyword").addEventListener("keypress", function(e){
  if(e.key === "Enter") cari();
});

function cari(){
  let keyword = document.getElementById("keyword").value;

  if(keyword === ""){
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
        : 'https://via.placeholder.com/180x140?text=No+Cover';

      html += `
        <div class="result-card row align-items-center">

          <div class="col-md-2">
            <img src="${cover}" class="book-img">
          </div>

          <div class="col-md-7">
            <h5 class="fw-bold">${buku.judul}</h5>
            <p class="text-muted mb-1">${buku.pengarang}</p>

            <small>
              <strong>Penerbit:</strong> ${buku.penerbit} <br>
              <strong>Tahun:</strong> ${buku.tahun ?? '-'} <br>
              <strong>Kategori:</strong> ${buku.kategori ?? '-'}
            </small>
          </div>

          <div class="col-md-3 text-end">
            <span class="badge bg-secondary badge-custom">
              Rak ${buku.rack?.nama_rak ?? '-'}
            </span>

            <br><br>

            <button onclick="detail(${buku.id})" class="btn btn-success btn-sm">
              Detail
            </button>
          </div>

        </div>
      `;
    });

    document.getElementById("hasil").innerHTML = html;

  });
}

function detail(id){
  window.location.href = "/detail/" + id;
}

</script>

</body>
</html>