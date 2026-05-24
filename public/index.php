<?php
/**
 * Raja Ahmad Marketplace — Home Page
 * Optimized & elevated UI — clean, modern, professional
 */

// Ambil 8 produk terbaru untuk ditampilkan di grid
$query_produk  = "SELECT * FROM produk ORDER BY id DESC LIMIT 8";
$result_produk = mysqli_query($conn, $query_produk);
?>

<!-- ============================================================
     GOOGLE FONTS — Sora (headings) + Nunito (body)
     ============================================================ -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Nunito:wght@400;500;600&display=swap" rel="stylesheet">

<!-- ============================================================
     GLOBAL DESIGN TOKENS & BASE RESET
     ============================================================ -->
<style>
  /* ── Design Tokens ─────────────────────────────────────────── */
  :root {
    --gold:        #b87c2e;
    --gold-light:  #d4a557;
    --gold-dark:   #8c5c1e;
    --gold-tint:   #fdf4e7;
    --cream:       #faf7f2;
    --brown-deep:  #3b2410;
    --surface:     #ffffff;
    --surface-2:   #f8f5f0;
    --border:      rgba(184,124,46,.18);
    --border-soft: rgba(0,0,0,.06);
    --text-1:      #1a1209;
    --text-2:      #5c4a30;
    --text-3:      #9b8a72;
    --shadow-xs:   0 1px 3px rgba(0,0,0,.06);
    --shadow-sm:   0 2px 8px rgba(0,0,0,.08);
    --shadow-md:   0 4px 20px rgba(0,0,0,.1);
    --shadow-card: 0 2px 12px rgba(184,124,46,.08);
    --radius-sm:   8px;
    --radius-md:   12px;
    --radius-lg:   18px;
    --radius-xl:   24px;
    --transition:  all .25s cubic-bezier(.4,0,.2,1);
    --font-head:   'Sora', sans-serif;
    --font-body:   'Nunito', sans-serif;
  }

  /* ── Base ───────────────────────────────────────────────────── */
  *, *::before, *::after { box-sizing: border-box; }

  body {
    font-family: var(--font-body);
    background: var(--cream);
    color: var(--text-1);
    margin: 0;
  }

  a { text-decoration: none; color: inherit; }

  img { display: block; max-width: 100%; }

  /* ── Utility ────────────────────────────────────────────────── */
  .container { max-width: 1200px; margin: 0 auto; padding: 0 16px; }
  .section-title {
    font-family: var(--font-head);
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--text-1);
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .section-title::before {
    content: '';
    display: inline-block;
    width: 4px;
    height: 1.1em;
    background: var(--gold);
    border-radius: 2px;
  }
  .link-gold {
    color: var(--gold);
    font-size: .85rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 4px;
    transition: var(--transition);
  }
  .link-gold:hover { color: var(--gold-dark); gap: 8px; }
</style>


<!-- ============================================================
     HEADER — LOGO · SEARCH · CART
     ============================================================ -->
<header class="ra-header">
  <div class="container">
    <div class="ra-header__inner">

      <!-- Search (sekarang memanjang penuh) -->
      <div class="ra-header__search">
        <div class="ra-search">
          <i class="fas fa-search ra-search__icon" aria-hidden="true"></i>
          <input
            type="text"
            id="searchInput"
            class="ra-search__input"
            placeholder="Cari produk, merek, dan toko..."
            autocomplete="off"
          >
          <button id="searchBtn" class="ra-search__btn" aria-label="Cari">
            Cari
          </button>
        </div>
      </div>

      <!-- Actions -->
      <nav class="ra-header__actions" aria-label="Quick actions">
        <a href="#" class="ra-action-btn" aria-label="Wishlist">
          <i class="fas fa-heart" aria-hidden="true"></i>
        </a>
        <a href="#" class="ra-action-btn ra-action-btn--cart" aria-label="Keranjang belanja">
          <i class="fas fa-shopping-bag" aria-hidden="true"></i>
          <span class="ra-action-btn__badge">3</span>
        </a>
      </nav>

    </div>
  </div>
</header>

<style>
  /* ── Header ─────────────────────────────────────────────────── */
  .ra-header__inner {
    display: grid;
    /* Ganti ke 2 kolom: search fleksibel + actions tetap */
    grid-template-columns: 1fr auto;
    align-items: center;
    gap: 20px;
    padding: 12px 0;
  }

  /* Logo */
  .ra-header__logo {
    display: flex;
    align-items: center;
    gap: 8px;
    white-space: nowrap;
  }
  .ra-header__logo-icon {
    width: 36px;
    height: 36px;
    background: var(--gold);
    border-radius: var(--radius-sm);
    display: grid;
    place-items: center;
    color: #fff;
    font-size: .9rem;
    flex-shrink: 0;
  }
  .ra-header__logo-text {
    font-family: var(--font-head);
    font-size: 1.15rem;
    font-weight: 800;
    color: var(--text-1);
    letter-spacing: -.02em;
  }
  .ra-header__logo-text em {
    font-style: normal;
    color: var(--gold);
  }

  /* Search */
  .ra-search {
    display: flex;
    align-items: center;
    background: var(--surface-2);
    border: 1.5px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 0 4px 0 14px;
    transition: var(--transition);
  }
  .ra-search:focus-within {
    border-color: var(--gold);
    background: var(--surface);
    box-shadow: 0 0 0 3px rgba(184,124,46,.12);
  }
  .ra-search__icon {
    color: var(--text-3);
    font-size: .85rem;
    flex-shrink: 0;
    margin-right: 8px;
  }
  .ra-search__input {
    flex: 1;
    border: none;
    background: transparent;
    font-family: var(--font-body);
    font-size: .9rem;
    color: var(--text-1);
    outline: none;
    padding: 9px 0;
    min-width: 0;
  }
  .ra-search__input::placeholder { color: var(--text-3); }
  .ra-search__btn {
    flex-shrink: 0;
    background: var(--gold);
    color: #fff;
    border: none;
    border-radius: var(--radius-xl);
    padding: 7px 18px;
    font-family: var(--font-body);
    font-size: .85rem;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
  }
  .ra-search__btn:hover { background: var(--gold-dark); transform: scale(1.02); }
  .ra-search__btn:active { transform: scale(.98); }

  /* Actions */
  .ra-header__actions { display: flex; align-items: center; gap: 8px; }
  .ra-action-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: var(--surface-2);
    display: grid;
    place-items: center;
    color: var(--text-2);
    font-size: 1rem;
    position: relative;
    transition: var(--transition);
  }
  .ra-action-btn:hover {
    background: var(--gold-tint);
    color: var(--gold);
    transform: translateY(-1px);
  }
  .ra-action-btn--cart { background: var(--gold-tint); color: var(--gold); }
  .ra-action-btn__badge {
    position: absolute;
    top: -2px;
    right: -2px;
    width: 18px;
    height: 18px;
    background: #e74c3c;
    color: #fff;
    font-size: .65rem;
    font-weight: 700;
    border-radius: 50%;
    display: grid;
    place-items: center;
    border: 2px solid var(--surface);
  }

  /* Responsive header */
  @media (max-width: 640px) {
    .ra-header__inner {
      grid-template-columns: auto 1fr auto;
      gap: 10px;
    }
    .ra-search__btn { padding: 7px 12px; font-size: .8rem; }
  }
</style>


<!-- ============================================================
     KATEGORI — HORIZONTAL SCROLLABLE ICON CHIPS
     ============================================================ -->
<section class="ra-kategori" aria-label="Kategori produk">
  <div class="container">
    <div class="ra-kategori__track">

      <a href="#" class="ra-kat-chip">
        <span class="ra-kat-chip__icon" style="--chip-bg:#fff3e0;--chip-fg:#e65100;">
          <i class="fas fa-mobile-alt" aria-hidden="true"></i>
        </span>
        <span class="ra-kat-chip__label">Elektronik</span>
      </a>

      <a href="#" class="ra-kat-chip">
        <span class="ra-kat-chip__icon" style="--chip-bg:#e8f5e9;--chip-fg:#1b5e20;">
          <i class="fas fa-laptop" aria-hidden="true"></i>
        </span>
        <span class="ra-kat-chip__label">Komputer</span>
      </a>

      <a href="#" class="ra-kat-chip">
        <span class="ra-kat-chip__icon" style="--chip-bg:#fce4ec;--chip-fg:#880e4f;">
          <i class="fas fa-tshirt" aria-hidden="true"></i>
        </span>
        <span class="ra-kat-chip__label">Fashion</span>
      </a>

      <a href="#" class="ra-kat-chip">
        <span class="ra-kat-chip__icon" style="--chip-bg:#e3f2fd;--chip-fg:#0d47a1;">
          <i class="fas fa-shoe-prints" aria-hidden="true"></i>
        </span>
        <span class="ra-kat-chip__label">Sepatu</span>
      </a>

      <a href="#" class="ra-kat-chip">
        <span class="ra-kat-chip__icon" style="--chip-bg:#f3e5f5;--chip-fg:#4a148c;">
          <i class="fas fa-apple-alt" aria-hidden="true"></i>
        </span>
        <span class="ra-kat-chip__label">Makanan</span>
      </a>

      <a href="#" class="ra-kat-chip">
        <span class="ra-kat-chip__icon" style="--chip-bg:#e0f7fa;--chip-fg:#006064;">
          <i class="fas fa-home" aria-hidden="true"></i>
        </span>
        <span class="ra-kat-chip__label">Rumah Tangga</span>
      </a>

      <a href="#" class="ra-kat-chip">
        <span class="ra-kat-chip__icon" style="--chip-bg:#fff8e1;--chip-fg:#e65100;">
          <i class="fas fa-gamepad" aria-hidden="true"></i>
        </span>
        <span class="ra-kat-chip__label">Gaming</span>
      </a>

      <a href="#" class="ra-kat-chip">
        <span class="ra-kat-chip__icon" style="--chip-bg:#e8f5e9;--chip-fg:#33691e;">
          <i class="fas fa-heartbeat" aria-hidden="true"></i>
        </span>
        <span class="ra-kat-chip__label">Kesehatan</span>
      </a>

    </div>
  </div>
</section>

<style>
  /* ── Kategori ───────────────────────────────────────────────── */
  .ra-kategori {
    background: var(--surface);
    padding: 14px 0;
    border-bottom: 1px solid var(--border-soft);
  }
  .ra-kategori__track {
    display: flex;
    gap: 10px;
    overflow-x: auto;
    scrollbar-width: none;
    padding-bottom: 2px;
  }
  .ra-kategori__track::-webkit-scrollbar { display: none; }

  .ra-kat-chip {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px;
    flex-shrink: 0;
    padding: 6px 10px;
    border-radius: var(--radius-md);
    transition: var(--transition);
    cursor: pointer;
  }
  .ra-kat-chip:hover { background: var(--gold-tint); transform: translateY(-2px); }
  .ra-kat-chip__icon {
    width: 48px;
    height: 48px;
    background: var(--chip-bg);
    color: var(--chip-fg);
    border-radius: var(--radius-md);
    display: grid;
    place-items: center;
    font-size: 1.1rem;
    transition: var(--transition);
  }
  .ra-kat-chip:hover .ra-kat-chip__icon { transform: scale(1.06); }
  .ra-kat-chip__label {
    font-size: .72rem;
    font-weight: 600;
    color: var(--text-2);
    white-space: nowrap;
    text-align: center;
  }
  .ra-kat-chip:hover .ra-kat-chip__label { color: var(--gold-dark); }
</style>


<!-- ============================================================
     CAROUSEL — PROMO BANNER
     ============================================================ -->
<section class="ra-banner" aria-label="Promo banner">
  <div class="container">
    <div id="promoCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">

      <!-- Indicator dots -->
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#promoCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#promoCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#promoCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>

      <div class="carousel-inner ra-banner__inner">
        <div class="carousel-item active">
          <img
            src="https://placehold.co/1200x320/f8c471/5d3a1a?text=Diskon+50%25+Produk+Raja+Ahmad"
            class="d-block w-100 ra-banner__img"
            alt="Diskon 50% Produk Raja Ahmad"
          >
        </div>
        <div class="carousel-item">
          <img
            src="https://placehold.co/1200x320/abebc6/145a32?text=Gratis+Ongkir+Seluruh+Indonesia"
            class="d-block w-100 ra-banner__img"
            alt="Gratis Ongkir Seluruh Indonesia"
          >
        </div>
        <div class="carousel-item">
          <img
            src="https://placehold.co/1200x320/f5b7b1/641e16?text=Belanja+Produk+UMKM+Lokal"
            class="d-block w-100 ra-banner__img"
            alt="Belanja Produk UMKM Lokal"
          >
        </div>
      </div>

      <!-- Nav arrows — custom styled -->
      <button class="carousel-control-prev ra-banner__nav" type="button" data-bs-target="#promoCarousel" data-bs-slide="prev" aria-label="Previous slide">
        <i class="fas fa-chevron-left" aria-hidden="true"></i>
      </button>
      <button class="carousel-control-next ra-banner__nav" type="button" data-bs-target="#promoCarousel" data-bs-slide="next" aria-label="Next slide">
        <i class="fas fa-chevron-right" aria-hidden="true"></i>
      </button>

    </div>
  </div>
</section>

<style>
  /* ── Banner ─────────────────────────────────────────────────── */
  .ra-banner { padding: 16px 0; }
  .ra-banner__inner { border-radius: var(--radius-lg); overflow: hidden; }
  .ra-banner__img {
    height: 280px;
    object-fit: cover;
    border-radius: var(--radius-lg);
  }

  /* Custom nav buttons */
  .ra-banner__nav {
    width: 38px;
    height: 38px;
    background: rgba(255,255,255,.9) !important;
    border-radius: 50% !important;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-1) !important;
    opacity: 0;
    transition: var(--transition);
  }
  .ra-banner:hover .ra-banner__nav { opacity: 1; }
  .ra-banner__nav:hover { background: var(--surface) !important; box-shadow: var(--shadow-sm); }
  .carousel-control-prev.ra-banner__nav { left: 12px; }
  .carousel-control-next.ra-banner__nav { right: 12px; }
  .ra-banner__nav i { font-size: .8rem; }

  /* Indicator dots */
  .carousel-indicators [data-bs-target] {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: rgba(255,255,255,.6);
    border: none;
    transition: var(--transition);
  }
  .carousel-indicators .active {
    background: #fff;
    width: 22px;
    border-radius: 3px;
  }

  @media (max-width: 640px) {
    .ra-banner__img { height: 160px; }
  }
</style>


<!-- ============================================================
     PROMO STRIP — 2 BENEFIT CARDS
     ============================================================ -->
<section class="ra-promo-strip" aria-label="Promo benefit">
  <div class="container">
    <div class="ra-promo-strip__grid">

      <div class="ra-promo-card ra-promo-card--shipping">
        <span class="ra-promo-card__icon"><i class="fas fa-truck-fast" aria-hidden="true"></i></span>
        <div>
          <strong>Gratis Ongkir Xtra</strong>
          <p>Minimal belanja Rp 50.000</p>
        </div>
      </div>

      <div class="ra-promo-card ra-promo-card--cashback">
        <span class="ra-promo-card__icon"><i class="fas fa-percent" aria-hidden="true"></i></span>
        <div>
          <strong>Cashback 20%</strong>
          <p>Setiap pembelian produk Raja Ahmad</p>
        </div>
      </div>

    </div>
  </div>
</section>

<style>
  /* ── Promo Strip ────────────────────────────────────────────── */
  .ra-promo-strip { padding: 0 0 16px; }
  .ra-promo-strip__grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
  }
  .ra-promo-card {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 16px 20px;
    border-radius: var(--radius-lg);
    border: 1.5px solid transparent;
    transition: var(--transition);
  }
  .ra-promo-card:hover { transform: translateY(-2px); box-shadow: var(--shadow-md); }
  .ra-promo-card--shipping {
    background: linear-gradient(135deg, #fff8e1 0%, #fff3cd 100%);
    border-color: #ffe082;
    color: #5d4037;
  }
  .ra-promo-card--cashback {
    background: linear-gradient(135deg, #e8f5e9 0%, #dcedc8 100%);
    border-color: #a5d6a7;
    color: #1b5e20;
  }
  .ra-promo-card__icon {
    width: 48px;
    height: 48px;
    background: rgba(255,255,255,.7);
    border-radius: var(--radius-md);
    display: grid;
    place-items: center;
    font-size: 1.3rem;
    flex-shrink: 0;
  }
  .ra-promo-card--shipping .ra-promo-card__icon { color: #e65100; }
  .ra-promo-card--cashback .ra-promo-card__icon { color: #2e7d32; }
  .ra-promo-card strong {
    display: block;
    font-family: var(--font-head);
    font-size: .95rem;
    font-weight: 700;
    margin-bottom: 2px;
  }
  .ra-promo-card p {
    margin: 0;
    font-size: .78rem;
    opacity: .75;
    line-height: 1.4;
  }

  @media (max-width: 480px) {
    .ra-promo-strip__grid { grid-template-columns: 1fr; }
    .ra-promo-card { padding: 14px 16px; }
  }
</style>


<!-- ============================================================
     PRODUK TERBARU — PRODUCT GRID
     ============================================================ -->
<section class="ra-produk" aria-labelledby="produk-heading">
  <div class="container">

    <!-- Section header -->
    <div class="ra-produk__header">
      <h2 class="section-title" id="produk-heading">🔥 Produk Terbaru</h2>
      <a href="#" class="link-gold">
        Lihat Semua <i class="fas fa-arrow-right fa-xs" aria-hidden="true"></i>
      </a>
    </div>

    <!-- Grid -->
    <div class="ra-produk__grid">

      <?php if (mysqli_num_rows($result_produk) > 0): ?>
        <?php while ($produk = mysqli_fetch_assoc($result_produk)): ?>

          <article class="ra-card">
            <!-- Image wrapper with wishlist overlay -->
            <div class="ra-card__img-wrap">
              <img
                src="assets/uploads/<?= htmlspecialchars($produk['gambar']) ?>"
                class="ra-card__img"
                alt="<?= htmlspecialchars($produk['nama_produk']) ?>"
                loading="lazy"
                onerror="this.src='https://placehold.co/300x220/f8f4ee/b87c2e?text=Raja+Ahmad'"
              >
              <!-- Wishlist button -->
              <button class="ra-card__wish" aria-label="Tambah ke wishlist">
                <i class="far fa-heart" aria-hidden="true"></i>
              </button>
              <!-- New badge -->
              <span class="ra-card__badge">Baru</span>
            </div>

            <!-- Card body -->
            <div class="ra-card__body">
              <h3 class="ra-card__title"><?= htmlspecialchars($produk['nama_produk']) ?></h3>

              <div class="ra-card__price">
                Rp <?= number_format($produk['harga'], 0, ',', '.') ?>
              </div>

              <!-- Rating + sold -->
              <div class="ra-card__meta">
                <span class="ra-card__stars" aria-label="Rating 4.5 bintang">
                  <i class="fas fa-star" aria-hidden="true"></i>
                  <i class="fas fa-star" aria-hidden="true"></i>
                  <i class="fas fa-star" aria-hidden="true"></i>
                  <i class="fas fa-star" aria-hidden="true"></i>
                  <i class="fas fa-star-half-alt" aria-hidden="true"></i>
                  <span class="ra-card__rating-val">4.5</span>
                </span>
                <span class="ra-card__sold">99+ terjual</span>
              </div>

              <!-- CTA -->
              <button class="ra-card__cta">
                <i class="fas fa-cart-plus" aria-hidden="true"></i> Beli Sekarang
              </button>
            </div>
          </article>

        <?php endwhile; ?>
      <?php else: ?>
        <div class="ra-empty">
          <i class="fas fa-box-open fa-3x" aria-hidden="true"></i>
          <p>Belum ada produk tersedia.</p>
        </div>
      <?php endif; ?>

    </div>
  </div>
</section>

<style>
  /* ── Product Section ────────────────────────────────────────── */
  .ra-produk { padding: 24px 0 40px; }
  .ra-produk__header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 16px;
  }

  /* Grid */
  .ra-produk__grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;
  }

  /* Card */
  .ra-card {
    background: var(--surface);
    border-radius: var(--radius-lg);
    border: 1px solid var(--border-soft);
    overflow: hidden;
    transition: var(--transition);
    cursor: pointer;
    display: flex;
    flex-direction: column;
  }
  .ra-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-card), 0 8px 30px rgba(0,0,0,.1);
    border-color: var(--border);
  }

  /* Image */
  .ra-card__img-wrap {
    position: relative;
    overflow: hidden;
    background: var(--surface-2);
  }
  .ra-card__img {
    width: 100%;
    height: 190px;
    object-fit: cover;
    transition: transform .4s cubic-bezier(.4,0,.2,1);
  }
  .ra-card:hover .ra-card__img { transform: scale(1.06); }

  /* Wish button */
  .ra-card__wish {
    position: absolute;
    top: 8px;
    right: 8px;
    width: 32px;
    height: 32px;
    background: rgba(255,255,255,.9);
    border: none;
    border-radius: 50%;
    display: grid;
    place-items: center;
    color: var(--text-3);
    font-size: .85rem;
    cursor: pointer;
    opacity: 0;
    transform: scale(.85);
    transition: var(--transition);
    backdrop-filter: blur(4px);
  }
  .ra-card:hover .ra-card__wish { opacity: 1; transform: scale(1); }
  .ra-card__wish:hover { color: #e74c3c; }
  .ra-card__wish.active { color: #e74c3c; background: #fff0f0; }

  /* Badge */
  .ra-card__badge {
    position: absolute;
    top: 8px;
    left: 8px;
    background: var(--gold);
    color: #fff;
    font-size: .65rem;
    font-weight: 700;
    padding: 3px 8px;
    border-radius: 20px;
    letter-spacing: .03em;
    text-transform: uppercase;
  }

  /* Body */
  .ra-card__body {
    padding: 12px;
    display: flex;
    flex-direction: column;
    flex: 1;
    gap: 6px;
  }
  .ra-card__title {
    font-family: var(--font-head);
    font-size: .85rem;
    font-weight: 600;
    color: var(--text-1);
    margin: 0;
    line-height: 1.35;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
  .ra-card__price {
    font-family: var(--font-head);
    font-size: 1rem;
    font-weight: 700;
    color: var(--gold-dark);
    letter-spacing: -.01em;
  }
  .ra-card__meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 4px;
    flex-wrap: wrap;
  }
  .ra-card__stars {
    color: #f39c12;
    font-size: .72rem;
    display: flex;
    align-items: center;
    gap: 2px;
  }
  .ra-card__rating-val {
    color: var(--text-2);
    margin-left: 2px;
    font-size: .72rem;
    font-weight: 600;
  }
  .ra-card__sold {
    font-size: .7rem;
    color: var(--text-3);
    white-space: nowrap;
  }

  /* CTA */
  .ra-card__cta {
    margin-top: auto;
    width: 100%;
    background: var(--gold-tint);
    color: var(--gold-dark);
    border: 1.5px solid var(--border);
    border-radius: var(--radius-sm);
    padding: 8px;
    font-family: var(--font-body);
    font-size: .78rem;
    font-weight: 700;
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    margin-top: 4px;
  }
  .ra-card__cta:hover {
    background: var(--gold);
    color: #fff;
    border-color: var(--gold);
    transform: scale(1.01);
  }

  /* Empty state */
  .ra-empty {
    grid-column: 1/-1;
    text-align: center;
    padding: 60px 20px;
    color: var(--text-3);
  }
  .ra-empty i { margin-bottom: 12px; }
  .ra-empty p { margin: 0; font-size: .9rem; }

  /* Grid responsive breakpoints */
  @media (max-width: 900px) {
    .ra-produk__grid { grid-template-columns: repeat(3, 1fr); }
  }
  @media (max-width: 600px) {
    .ra-produk__grid { grid-template-columns: repeat(2, 1fr); gap: 10px; }
    .ra-card__img { height: 155px; }
  }
</style>


<!-- ============================================================
     KATEGORI POPULER — FOOTER LINK LIST
     ============================================================ -->
<aside class="ra-kat-footer" aria-label="Kategori populer">
  <div class="container">
    <h2 class="ra-kat-footer__heading">KATEGORI POPULER</h2>
    <ul class="ra-kat-footer__list">
      <li><a href="#">Elektronik</a></li>
      <li><a href="#">Komputer &amp; Aksesoris</a></li>
      <li><a href="#">Handphone &amp; Aksesoris</a></li>
      <li><a href="#">Pakaian Pria</a></li>
      <li><a href="#">Sepatu Pria</a></li>
      <li><a href="#">Tas Pria</a></li>
      <li><a href="#">Aksesoris Fashion</a></li>
      <li><a href="#">Jam Tangan</a></li>
      <li><a href="#">Kesehatan</a></li>
      <li><a href="#">Hobi &amp; Koleksi</a></li>
    </ul>
  </div>
</aside>

<style>
  /* ── Category Footer ────────────────────────────────────────── */
  .ra-kat-footer {
    background: var(--surface);
    border-top: 1px solid var(--border-soft);
    padding: 24px 0 32px;
    margin-top: 8px;
  }
  .ra-kat-footer__heading {
    font-family: var(--font-head);
    font-size: .7rem;
    font-weight: 700;
    letter-spacing: .1em;
    color: var(--text-3);
    margin: 0 0 14px;
  }
  .ra-kat-footer__list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-wrap: wrap;
    gap: 8px 10px;
  }
  .ra-kat-footer__list a {
    font-size: .82rem;
    color: var(--text-2);
    padding: 5px 12px;
    background: var(--surface-2);
    border: 1px solid var(--border-soft);
    border-radius: 20px;
    transition: var(--transition);
  }
  .ra-kat-footer__list a:hover {
    background: var(--gold-tint);
    color: var(--gold-dark);
    border-color: var(--border);
    transform: translateY(-1px);
  }
</style>


<!-- ============================================================
     JAVASCRIPT — Search + Wishlist toggle
     ============================================================ -->
<script>
(function () {
  'use strict';

  /* ── Search ── */
  const searchBtn   = document.getElementById('searchBtn');
  const searchInput = document.getElementById('searchInput');

  function doSearch() {
    const kw = searchInput.value.trim();
    if (!kw) {
      searchInput.focus();
      searchInput.classList.add('ra-search--shake');
      setTimeout(() => searchInput.classList.remove('ra-search--shake'), 500);
      return;
    }
    // TODO: ganti dengan redirect ke halaman hasil pencarian
    // window.location.href = `?menu=search&q=${encodeURIComponent(kw)}`;
    alert('Mencari: ' + kw);
  }

  searchBtn.addEventListener('click', doSearch);
  searchInput.addEventListener('keydown', function (e) {
    if (e.key === 'Enter') doSearch();
  });

  /* ── Wishlist toggle ── */
  document.querySelectorAll('.ra-card__wish').forEach(function (btn) {
    btn.addEventListener('click', function (e) {
      e.stopPropagation();
      this.classList.toggle('active');
      const icon = this.querySelector('i');
      if (this.classList.contains('active')) {
        icon.classList.replace('far', 'fas');
        this.setAttribute('aria-label', 'Hapus dari wishlist');
      } else {
        icon.classList.replace('fas', 'far');
        this.setAttribute('aria-label', 'Tambah ke wishlist');
      }
    });
  });

})();
</script>

<style>
  /* Shake animation for empty search */
  @keyframes shake {
    0%,100% { transform: translateX(0); }
    20%,60%  { transform: translateX(-6px); }
    40%,80%  { transform: translateX(6px); }
  }
  .ra-search--shake { animation: shake .4s ease; }

  /* Entrance animation for product cards */
  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: translateY(0); }
  }
  .ra-card {
    animation: fadeUp .4s ease both;
  }
  /* Stagger each card via nth-child */
  .ra-card:nth-child(1)  { animation-delay: .05s; }
  .ra-card:nth-child(2)  { animation-delay: .10s; }
  .ra-card:nth-child(3)  { animation-delay: .15s; }
  .ra-card:nth-child(4)  { animation-delay: .20s; }
  .ra-card:nth-child(5)  { animation-delay: .25s; }
  .ra-card:nth-child(6)  { animation-delay: .30s; }
  .ra-card:nth-child(7)  { animation-delay: .35s; }
  .ra-card:nth-child(8)  { animation-delay: .40s; }
</style>