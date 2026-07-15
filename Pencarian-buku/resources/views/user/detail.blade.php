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
  display: flex;
  flex-direction: column;
  background: var(--bg-page);
  font-family: 'Segoe UI', system-ui, sans-serif;
  color: var(--text);
}

.main-content {
  flex: 1;
}

/* HEADER */
.header{
  background:linear-gradient(90deg, var(--navy) 0%, var(--navy-dark) 100%);
  padding:16px 30px;
  border-bottom:1px solid var(--border);
  box-shadow:
    0 2px 10px rgba(0,0,0,0.04);
  display:flex;
  align-items:center;
  position:sticky;
  top:0;
  z-index:999;
}

.logo {
  font-weight: 700;
  color: var(--navy);
  font-size: 20px;
}

/* Kartu katalog */
.catalog-sheet {
  background: var(--card);
  border-radius: 14px;
  box-shadow: 0 4px 24px rgba(44, 62, 80, 0.08);
  border: 1px solid var(--border);
  overflow: hidden;
}

.catalog-sheet-inner {
  padding: 2rem 2rem 2.25rem;
}

@media (max-width: 767px) {
  .catalog-sheet-inner {
    padding: 1.25rem;
  }
}

/* COVER — tampil utuh seperti kartu katalog */
.cover-frame {
  background: linear-gradient(165deg, #e8ecf2 0%, #dce3eb 100%);
  border-radius: 12px;
  padding: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 280px;
  border: 1px solid var(--border);
}

.book-cover {
  max-width: 100%;
  max-height: 420px;
  width: auto;
  height: auto;
  object-fit: contain;
  border-radius: 8px;
  box-shadow: 0 8px 28px rgba(0,0,0,0.18);
}

/* Deskripsi bibliografis (penampilan mirip catatan ISBD ringkas) */
.biblio-detail {
  font-family: Georgia, 'Times New Roman', serif;
  color: #1a1a1a;
  line-height: 1.6;
}

.biblio-detail .title-proper {
  font-size: 1.65rem;
  font-weight: 700;
  letter-spacing: 0.02em;
  margin-bottom: 0.5rem;
  color: var(--navy-darker);
}

.biblio-detail .statement-resp {
  font-size: 1.05rem;
  font-style: italic;
  margin-bottom: 1rem;
  color: #333;
}

.biblio-detail .isbd-line {
  font-size: 0.95rem;
  margin-bottom: 0.35rem;
  padding-left: 0.15rem;
}

.biblio-detail .sep {
  color: #6c757d;
}

/* BADGE */
.badge-custom {
  padding: 10px 14px;
  font-size: 13px;
  border-radius: 10px;
}

.panel-location {
  background: #f8fafb;
  border-radius: 12px;
  padding: 1.25rem 1.35rem;
  border: 1px solid var(--border);
}

.panel-location h6 {
  font-size: 0.75rem;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  color: var(--text-muted);
  margin-bottom: 0.75rem;
}

.panel-ai {
  margin-top: 1.75rem;
  padding-top: 1.5rem;
  border-top: 1px dashed var(--border);
}

.panel-ai h5 {
  font-size: 1rem;
  font-weight: 600;
  color: var(--navy);
}

/* Pratinjau AI: kotak + pill seperti kartu hasil pencarian */
.yolo-preview-wrap {
  position: relative;
  display: inline-block;
  max-width: min(100%, 900px);
  line-height: 0;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 8px 28px rgba(27, 67, 50, 0.18);
  border: 1px solid var(--border);
  background: #eef2f8;
}

.yolo-preview-wrap img {
  width: 100%;
  height: auto;
  display: block;
  vertical-align: top;
}

.yolo-bbox {
  position: absolute;
  box-sizing: border-box;
  border: 2px solid rgba(255, 255, 255, 0.95);
  border-radius: 6px;
  box-shadow:
    0 0 0 1px rgba(27, 67, 50, 0.55),
    0 0 14px rgba(0, 0, 0, 0.25);
  pointer-events: none;
}

.yolo-rack-pill {
  position: absolute;
  transform: translate(-100%, -8px);
  display: inline-flex;
  align-items: center;
  gap: 0.4rem;
  background: linear-gradient(145deg, var(--navy-dark) 0%, var(--navy) 100%);
  color: #fff;
  padding: 0.42rem 1rem;
  border-radius: 999px;
  font-size: 0.8rem;
  font-weight: 600;
  letter-spacing: 0.03em;
  box-shadow: 0 4px 14px rgba(59, 89, 152, 0.35);
  white-space: nowrap;
  max-width: 90%;
  overflow: hidden;
  text-overflow: ellipsis;
  font-family: 'Segoe UI', system-ui, sans-serif;
  pointer-events: none;
}

.yolo-rack-pill .fa-layer-group {
  font-size: 0.72rem;
  opacity: 0.9;
}

.yolo-rack-pill-fallback {
  left: 50%;
  bottom: 12px;
  top: auto;
  transform: translateX(-50%);
}

.yolo-stream-card{
    background:#fff;
    border-radius:14px;
    overflow:hidden;
    border:1px solid #e5e9ec;
    box-shadow:0 8px 25px rgba(0,0,0,.08);
}

.yolo-stream-header{
    background:#3B5998;
    color:#fff;
    padding:12px 18px;
    font-weight:600;
}

.yolo-stream-video{
    width:100%;
    height:auto;
    display:block;
    background:#000;
}

.live-badge{
    display:inline-flex;
    align-items:center;
    gap:8px;
    background:#dc3545;
    color:#fff;
    padding:5px 12px;
    border-radius:999px;
    font-size:12px;
    font-weight:600;
}

.live-dot{
    width:8px;
    height:8px;
    background:#fff;
    border-radius:50%;
}

/* Tabel ringkas data bibliografi (selaras form admin) */
.catalog-meta {
  margin-top: 1.5rem;
  padding-top: 1.25rem;
  border-top: 1px solid var(--border);
}

.catalog-meta .meta-row {
  display: grid;
  grid-template-columns: minmax(130px, 180px) 1fr;
  gap: 0.35rem 1.25rem;
  padding: 0.5rem 0;
  border-bottom: 1px solid #eef1f3;
  font-size: 0.95rem;
  align-items: baseline;
}

@media (max-width: 575px) {
  .catalog-meta .meta-row {
    grid-template-columns: 1fr;
    gap: 0.15rem;
  }
}

.catalog-meta .meta-label {
  color: var(--text-muted);
  font-weight: 600;
  font-size: 0.8rem;
  text-transform: uppercase;
  letter-spacing: 0.04em;
  font-family: 'Segoe UI', system-ui, sans-serif;
}

.catalog-meta .meta-val {
  color: #1a1a1a;
  font-family: Georgia, 'Times New Roman', serif;
}

/* BREADCRUMB */
.breadcrumb-custom {
  font-size: 0.9rem;
}

.breadcrumb-custom a {
  text-decoration: none;
  color: var(--navy);
  font-weight: 500;
}

.breadcrumb-custom a:hover {
  text-decoration: underline;
}

.breadcrumb-custom span {
  color: #888;
}

/* rack */
.rack-location-card{
    background:#ffffff;
    border:1px solid #e5e9ec;
    border-radius:12px;
    padding:18px;
    margin-top:20px;
}

.rack-location-title{
    color:#3B5998;
    font-weight:700;
    margin-bottom:15px;
}

.location-item{
    display:flex;
    justify-content:space-between;
    padding:10px 0;
    border-bottom:1px solid #eef1f3;
}

.location-item:last-child{
    border-bottom:none;
}

.location-label{
    color:#6B7B8C;
    font-weight:600;
}

.location-value{
    font-weight:700;
    color:#2C3E50;
}

/* FOOTER */
.footer {
  background: var(--card);
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

.badge.bg-secondary {
  background-color: var(--navy) !important;
}
.badge.bg-success {
  background-color: var(--sage-dark) !important;
  color: var(--navy-darker) !important;
}
</style>

</head>

<body>

<!-- HEADER -->
<div class="header d-flex align-items-center gap-1">

  <img 
    src="https://png.pngtree.com/png-vector/20250211/ourmid/pngtree-colorful-book-stack-logo-design-perfect-for-education-or-library-projects-vector-png-image_15444285.png"
    alt="Logo Perpustakaan"
    style="
      width:50px;
      height:50px;
      object-fit:contain;
    "
  >

  <h5 class="mb-0 text-white fw-bold">
    Perpustakaan Umum
  </h5>

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
  <div class="mt-4 mb-5">
    <div class="catalog-sheet">
      <div class="catalog-sheet-inner">
        <div class="row g-4 g-lg-5 align-items-start">

          <!-- COVER -->
          <div class="col-md-4 col-lg-3">
            <div class="cover-frame">
              @if($book->cover)
                <img src="/images/cover/{{ $book->cover }}" class="book-cover" alt="{{ $book->judul }}">
              @else
                <img src="https://via.placeholder.com/300x420?text=No+Cover" class="book-cover" alt="">
              @endif
            </div>
          </div>

          <!-- DETAIL -->
          <div class="col-md-8 col-lg-9">

            <div class="biblio-detail">
              <h1 class="title-proper h3 mb-0">{{ $book->judul }}</h1>
              <p class="statement-resp mb-0">{{ $book->pengarang }}</p>
            </div>

            @php
              $rack = $book->rack;
              $tersedia = ($book->jumlah_buku ?? 0) > 0;
              $statusTeks = $tersedia ? 'Tersedia' : 'Tidak tersedia';
            @endphp
            <div class="catalog-meta">
              <div class="meta-row">
                <div class="meta-label">Penerbit</div>
                <div class="meta-val">{{ $book->penerbit ?: '—' }}</div>
              </div>
              @php
                  $pengarang = strtoupper(substr($book->pengarang, 0, 3));
                  $judulkode = strtoupper(substr(trim($book->judul), 0, 1));

                  $noPanggil = ($book->rack->nama_rak ?? '-') . ' ' . $pengarang . ' ' . $judulkode;
              @endphp
              <div class="meta-row">
                <div class="meta-label"> No.Panggil</div>
                <div class="meta-val">{{ $noPanggil }}</div>
              </div>
              <div class="meta-row">
                <div class="meta-label"> No.Klasifikasi</div>
                <div class="meta-val">{{ $rack?->nama_rak ?? '—' }}</div>
              </div>
                <!-- {{-- <div class="meta-row">
                  <div class="meta-label">Lokasi rak</div>
                  <div class="meta-val">{{ $rack?->lokasi ?? '—' }}</div>
                </div>
              </div> --}} -->
              <div class="meta-row">
                <div class="meta-label">Zona</div>
                <div class="meta-val">{{ $rack->zona ?? '—' }}</div>
              </div>
              <div class="meta-row">
                <div class="meta-label">Baris</div>
                <div class="meta-val">{{ $rack->baris ?? '—' }}</div>
              </div>
              <div class="meta-row">
                <div class="meta-label">Sekat</div>
                <div class="meta-val">{{ $rack->sekat_mulai ?? '—'}}

                        @if($rack->sekat_mulai != $rack->sekat_selesai)
                            - {{ $rack->sekat_selesai }}
                        @endif
                    </div>
              </div>
              <div class="meta-row">
                <div class="meta-label">Tahun terbit</div>
                <div class="meta-val">{{ $book->tahun ?? '—' }}</div>
              </div>
              <div class="meta-row">
                <div class="meta-label">ISBN</div>
                <div class="meta-val">{{ $book->isbn ?: '—' }}</div>
              </div>
              <div class="meta-row">
                <div class="meta-label">Edisi</div>
                <div class="meta-val">{{ $book->edisi ?: '—' }}</div>
              </div>
              <div class="meta-row">
                <div class="meta-label">Jumlah halaman</div>
                <div class="meta-val">{{ $book->jumlah_halaman ?: '—' }}</div>
              </div>
              <div class="meta-row">
                <div class="meta-label">Kategori</div>
                <div class="meta-val">{{ $book->kategori ?: '—' }}</div>
              </div>
              <div class="meta-row">
                <div class="meta-label">Status ketersediaan</div>
                <div class="meta-val">{{ $statusTeks }} <span class="text-muted small"></span></div>
              </div>
              <div class="meta-row">
                <div class="meta-label">Jumlah eksemplar</div>
                <div class="meta-val">{{ $book->jumlah_buku ?? 0 }} buku</div>
              </div>

            <!-- <div class="panel-location mt-4">
              <h6 class="mb-3">Ringkasan lokasi & ketersediaan</h6>
              <div class="d-flex gap-2 flex-wrap align-items-center">
                <span class="badge bg-secondary badge-custom">
                  {{ $rack?->nama_rak ?? '—' }}
                </span>

                @if($tersedia)
                  <span class="badge bg-success badge-custom">
                    Tersedia ({{ $book->jumlah_buku }})
                  </span>
                @else
                  <span class="badge bg-danger badge-custom">
                    Tidak tersedia
                  </span>
                @endif
              </div>
            </div>

            @if($rack) -->

            <!-- <div class="rack-location-card">

                <h5 class="rack-location-title">
                    <i class="fas fa-map-marker-alt me-2"></i>
                    Lokasi Rak Buku
                </h5>

                <div class="location-item">
                    <span class="location-label">Nama Rak</span>
                    <span class="location-value">
                        {{ $rack->nama_rak }}
                    </span>
                </div>

                <div class="location-item">
                    <span class="location-label">Zona</span>
                    <span class="location-value">
                        {{ $rack->zona }}
                    </span>
                </div>

                <div class="location-item">
                    <span class="location-label">Baris</span>
                    <span class="location-value">
                        {{ $rack->baris }}
                    </span>
                </div>

                <div class="location-item">
                    <span class="location-label">Sekat</span>
                    <span class="location-value">

                        {{ $rack->sekat_mulai }}

                        @if($rack->sekat_mulai != $rack->sekat_selesai)
                            - {{ $rack->sekat_selesai }}
                        @endif

                    </span>
                </div>

            </div>

            @endif -->

            <div class="panel-ai">
              <!-- <h5 class="mb-3"><i class="fas fa-map-marker-alt me-2" style="color: var(--navy);"></i>Lokasi rak (AI)</h5> -->
              <div id="yolo">

                <div class="yolo-stream-card">
            
                    <div class="yolo-stream-header d-flex justify-content-between align-items-center">
            
                        <span>
                            Deteksi Lokasi Rak
                        </span>
            
                        <span class="live-badge">
                            <span class="live-dot"></span>
                            LIVE
                        </span>
            
                    </div>
            
                    <img
                        id="streamVideo"
                        class="yolo-stream-video"
                        src=""
                        alt="YOLO Stream"
                    >
            
                </div>
            
            </div>
            </div>

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

  const flaskBaseUrl =
      "http://127.0.0.1:5000";
  
  const namaRak =
      @json(optional($book->rack)->nama_rak ?? '');
  
  if(!namaRak)
  {
      document.getElementById("yolo").innerHTML =
      `
      <div class="alert alert-warning">
          Data rak tidak tersedia.
      </div>
      `;
  }
  else
  {
      const streamUrl =
          `${flaskBaseUrl}/stream/${
              encodeURIComponent(namaRak)
          }`;
  
      document
          .getElementById("streamVideo")
          .src = streamUrl;
  }
  
  </script>

</body>
</html>