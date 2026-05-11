<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Detail Buku</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
html, body {
  height: 100%;
}

body {
  display: flex;
  flex-direction: column;
  background: #f4f6f9;
  font-family: 'Segoe UI', sans-serif;
}

.main-content {
  flex: 1;
}

/* HEADER */
.header {
  background: #1b4332;
  color: white;
  padding: 15px 30px;
}

.logo {
  font-weight: bold;
  color: #1b4332;
}

/* COVER */
.book-cover {
  width: 100%;
  border-radius: 12px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.15);
}

/* BADGE */
.badge-custom {
  padding: 10px 14px;
  font-size: 13px;
  border-radius: 10px;
}

/* BREADCRUMB */
.breadcrumb-custom a {
  text-decoration: none;
  color: #1b4332;
  font-weight: 500;
}

.breadcrumb-custom span {
  color: #888;
}

/* FOOTER */
.footer {
  background: white;
  padding: 20px;
  text-align: center;
  border-top: 1px solid #eee;
}

.social-icons a {
  color: #333;
  font-size: 18px;
  margin: 0 8px;
  transition: 0.3s;
}

.social-icons a:hover {
  transform: scale(1.2);
}

.social-icons a.instagram:hover { color: #E1306C; }
.social-icons a.whatsapp:hover { color: #25D366; }
.social-icons a.tiktok:hover { color: #000; }
.social-icons a.twitter:hover { color: #1DA1F2; }
.social-icons a.facebook:hover { color: #1877F2; }
</style>

</head>

<body>

<!-- HEADER -->
<div class="header">
  <h5 class="mb-0">📚 Perpustakaan Umum</h5>
</div>

<div class="main-content">
<div class="container">

  <!-- BREADCRUMB -->
  <div class="mt-3 breadcrumb-custom">
    <a href="/">Pencarian</a>
    <span> / </span>
    <span>{{ $book->judul }}</span>
  </div>

  <!-- CONTENT -->
  <div class="mt-4">
    <div class="row g-4">

      <!-- COVER -->
      <div class="col-md-3">
        @if($book->cover)
          <img src="/images/cover/{{ $book->cover }}" class="book-cover" alt="{{ $book->judul }}">
        @else
          <img src="https://via.placeholder.com/300x420?text=No+Cover" class="book-cover">
        @endif
      </div>

      <!-- DETAIL -->
      <div class="col-md-9">

        <h2 class="fw-bold">{{ $book->judul }}</h2>
        <p class="text-muted mb-3">{{ $book->pengarang }}</p>

        <hr>

        <div class="row">
          <div class="col-md-6">
            <p><strong>Kategori:</strong><br> {{ $book->kategori ?? '-' }}</p>
            <p><strong>Penerbit:</strong><br> {{ $book->penerbit }}</p>
            <p><strong>Tahun:</strong><br> {{ $book->tahun ?? '-' }}</p>
          </div>

          <div class="col-md-6">
            <p><strong>Lokasi Buku:</strong></p>

            <div class="d-flex gap-2 flex-wrap">
              <span class="badge bg-secondary badge-custom">
                {{ $book->rack->nama_rak ?? '-' }}
              </span>

              @if($book->jumlah_buku > 0)
                  <span class="badge bg-success badge-custom">
                      ✔ Tersedia ({{ $book->jumlah_buku }} buku)
                  </span>
              @else
                  <span class="badge bg-danger badge-custom">
                      ✖ Tidak Tersedia
                  </span>
              @endif
            </div>
          </div>
        </div>

        <!-- YOLO RESULT -->
        <div class="mt-4">
          <h5>📍 Lokasi Rak (AI Detection)</h5>
          <div id="yolo" class="mt-2">
            <p class="text-muted">Memuat lokasi rak...</p>
          </div>
        </div>

      </div>
    </div>
  </div>

</div>
</div>

<!-- FOOTER -->
<div class="footer">

  <div class="social-icons mb-2">

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
const flaskBaseUrl = 'http://127.0.0.1:5000';

fetch(`${flaskBaseUrl}/detect`)
  .then(res => {
    if (!res.ok) throw new Error();
    return res.json();
  })
  .then(data => {
    const imageUrl = `${flaskBaseUrl}/static/${data.image}`;

    document.getElementById("yolo").innerHTML = `
      <img src="${imageUrl}" class="img-fluid rounded shadow" style="max-width:300px;">
    `;
  })
  .catch(() => {
    document.getElementById("yolo").innerHTML = `
      <div class="alert alert-warning">
        YOLO belum dijalankan atau gambar tidak tersedia.
      </div>
    `;
  });
</script>

</body>
</html>