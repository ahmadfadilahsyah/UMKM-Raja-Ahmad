<?php if (!isset($_SESSION)) session_start(); ?>

<!--
  ============================================================
  GOOGLE FONTS — Sora + Nunito
  ============================================================
-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Nunito:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- ============================================================
     NAVBAR & MODAL CSS
     ============================================================ -->
<style>
  /* ── Design tokens ──────────────────── */
  :root {
    --gold:        #b87c2e;
    --gold-light:  #d4a557;
    --gold-dark:   #8c5c1e;
    --gold-tint:   #fdf4e7;
    --brown-deep:  #3b2410;
    --surface:     #ffffff;
    --surface-2:   #f8f5f0;
    --border-soft: rgba(0,0,0,.07);
    --text-1:      #1a1209;
    --text-2:      #5c4a30;
    --text-3:      #9b8a72;
    --shadow-nav:  0 4px 20px rgba(59,36,16,.08);
    --radius-sm:   8px;
    --radius-md:   12px;
    --radius-lg:   18px;
    --radius-xl:   24px;
    --transition:  all .25s cubic-bezier(.4,0,.2,1);
    --font-head:   'Sora', sans-serif;
    --font-body:   'Nunito', sans-serif;
    --nav-h:       64px;
  }

  /* ── Base reset ─────────────────────────────────────────────── */
  *, *::before, *::after { box-sizing: border-box; }
  body { font-family: var(--font-body); margin: 0; }

  /* ═══════════════════════════════════════════════════════════════
     TOP BAR 
  ═══════════════════════════════════════════════════════════════ */
  .ra-topbar {
    background: var(--brown-deep);
    padding: 6px 0;
    font-size: .75rem;
    color: rgba(255,255,255,.7);
  }
  .ra-topbar__inner {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 16px;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 16px;
  }
  .ra-topbar__greeting {
    display: flex;
    align-items: center;
    gap: 8px;
    color: rgba(255,255,255,.9);
  }
  .ra-topbar__avatar {
    width: 24px;
    height: 24px;
    background: var(--gold);
    border-radius: 50%;
    display: grid;
    place-items: center;
    font-size: .7rem;
    font-weight: 700;
    color: #fff;
    flex-shrink: 0;
  }
  .ra-topbar__name { font-weight: 700; letter-spacing: 0.02em; }
  .ra-topbar__role {
    background: rgba(184,124,46,.35);
    color: var(--gold-light);
    padding: 2px 8px;
    border-radius: 20px;
    font-weight: 700;
    letter-spacing: .03em;
    font-size: .68rem;
  }
  .ra-topbar__sep {
    width: 1px;
    height: 14px;
    background: rgba(255,255,255,.2);
  }
  .ra-topbar__logout {
    color: rgba(255,255,255,.7);
    transition: var(--transition);
    display: flex;
    align-items: center;
    gap: 6px;
    text-decoration: none;
    font-weight: 600;
  }
  .ra-topbar__logout:hover { color: #fff; transform: translateX(2px); }
  .ra-topbar__login-hint { display: flex; align-items: center; gap: 6px; }
  .ra-topbar__login-btn {
    background: var(--gold);
    color: #fff;
    border: none;
    border-radius: 20px;
    padding: 4px 14px;
    font-family: var(--font-body);
    font-size: .75rem;
    font-weight: 700;
    cursor: pointer;
    transition: var(--transition);
    text-decoration: none;
    display: inline-block;
  }
  .ra-topbar__login-btn:hover { 
    background: var(--gold-light); 
    color: var(--brown-deep); 
    box-shadow: 0 2px 8px rgba(184,124,46,.4);
  }

  /* ═══════════════════════════════════════════════════════════════
     MAIN NAVBAR
  ═══════════════════════════════════════════════════════════════ */
  .ra-navbar {
    position: sticky;
    top: 0;
    z-index: 200;
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(8px);
    border-bottom: 1px solid var(--border-soft);
    box-shadow: var(--shadow-nav);
    height: var(--nav-h);
  }
  .ra-navbar__inner {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 16px;
    display: flex;
    align-items: center;
    gap: 12px;
    height: 100%;
  }

  /* ── Logo ───────────────────────────────────────────────────── */
  .ra-navbar__logo {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    flex-shrink: 0;
    margin-right: 12px;
  }
  .ra-navbar__logo-mark {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, var(--gold-light) 0%, var(--gold-dark) 100%);
    border-radius: var(--radius-sm);
    display: grid;
    place-items: center;
    color: #fff;
    font-size: 1rem;
    flex-shrink: 0;
    box-shadow: 0 2px 10px rgba(184,124,46,.3);
  }
  .ra-navbar__logo-text {
    font-family: var(--font-head);
    font-size: 1.15rem;
    font-weight: 800;
    color: var(--text-1);
    letter-spacing: -.02em;
    line-height: 1.1;
  }
  .ra-navbar__logo-sub {
    font-family: var(--font-body);
    font-size: .65rem;
    font-weight: 700;
    color: var(--gold);
    letter-spacing: .08em;
    text-transform: uppercase;
    display: block;
  }

  /* ── Nav links ──────────────────────────────────────────────── */
  .ra-nav {
    display: flex;
    align-items: center;
    gap: 4px;
    list-style: none;
    margin: 0;
    padding: 0;
    flex: 1;
    height: 100%;
  }
  .ra-nav__item { position: relative; height: 100%; display: flex; align-items: center; }
  .ra-nav__link {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 14px;
    border-radius: var(--radius-sm);
    font-size: .9rem;
    font-weight: 600;
    color: var(--text-2);
    text-decoration: none;
    white-space: nowrap;
    transition: var(--transition);
    position: relative;
  }
  .ra-nav__link i { font-size: .85rem; opacity: .7; transition: var(--transition); }
  .ra-nav__link:hover {
    background: var(--gold-tint);
    color: var(--gold-dark);
  }
  .ra-nav__link:hover i { opacity: 1; transform: scale(1.1); }
  
  /* Active underline indicator */
  .ra-nav__link.active {
    color: var(--gold-dark);
    background: var(--gold-tint);
  }
  .ra-nav__link.active::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 14px;
    right: 14px;
    height: 3px;
    background: var(--gold);
    border-radius: 3px 3px 0 0;
  }

  /* Admin-only badge accent */
  .ra-nav__link--admin { position: relative; }
  .ra-nav__link--admin::before {
    content: '●';
    position: absolute;
    top: 4px;
    right: 4px;
    font-size: .45rem;
    color: var(--gold);
  }

  /* ── Hamburger toggle ───────────────────────────────────────── */
  .ra-navbar__toggler {
    display: none;
    margin-left: auto;
    background: none;
    border: 1.5px solid var(--border-soft);
    border-radius: var(--radius-sm);
    width: 42px;
    height: 42px;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 5px;
    cursor: pointer;
    padding: 0;
    transition: var(--transition);
  }
  .ra-navbar__toggler:hover { background: var(--gold-tint); border-color: var(--gold); }
  .ra-navbar__toggler span {
    display: block;
    width: 20px;
    height: 2px;
    background: var(--text-2);
    border-radius: 2px;
    transition: var(--transition);
  }
  .ra-navbar__toggler.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
  .ra-navbar__toggler.open span:nth-child(2) { opacity: 0; transform: scaleX(0); }
  .ra-navbar__toggler.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

  /* ── Collapse panel (mobile) ────────────────────────────────── */
  .ra-navbar__collapse {
    display: flex;
    align-items: center;
    gap: 8px;
    flex: 1;
    height: 100%;
  }

  /* ── Responsive ─────────────────────────────────────────────── */
  @media (max-width: 900px) {
    .ra-navbar__toggler { display: flex; }
    .ra-navbar { height: auto; }
    .ra-navbar__inner { flex-wrap: wrap; padding: 12px 16px; }
    .ra-navbar__logo { flex: 1; }
    .ra-navbar__collapse {
      display: none;
      flex-direction: column;
      align-items: stretch;
      width: 100%;
      padding-bottom: 16px;
      border-top: 1px solid var(--border-soft);
      margin-top: 12px;
      padding-top: 12px;
    }
    .ra-navbar__collapse.open { display: flex; animation: slideDown 0.3s ease forwards; }
    .ra-nav { flex-direction: column; align-items: stretch; gap: 4px; width: 100%; height: auto; }
    .ra-nav__item { height: auto; }
    .ra-nav__link { padding: 12px 16px; border-radius: var(--radius-sm); }
    .ra-nav__link.active::after { bottom: 4px; left: 16px; right: 16px; height: 2px; border-radius: 2px; }
    .ra-topbar__inner { justify-content: center; }
  }

  @keyframes slideDown {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
  }

  /* ═══════════════════════════════════════════════════════════════
     LOGIN MODAL
  ═══════════════════════════════════════════════════════════════ */
  .ra-modal .modal-dialog { max-width: 420px; }
  .ra-modal .modal-content {
    border: none;
    border-radius: var(--radius-xl);
    overflow: hidden;
    box-shadow: 0 32px 64px rgba(59,36,16,.2);
  }

  /* ── Modal header ───────────────────── */
  .ra-modal__header {
    background: linear-gradient(135deg, var(--brown-deep) 0%, #4a2d16 50%, var(--gold-dark) 100%);
    padding: 32px 32px 24px;
    position: relative;
    overflow: hidden;
  }
  .ra-modal__header::before,
  .ra-modal__header::after {
    content: '';
    position: absolute;
    border-radius: 50%;
    border: 1.5px solid rgba(255,255,255,.06);
  }
  .ra-modal__header::before { width: 200px; height: 200px; top: -70px; right: -50px; }
  .ra-modal__header::after  { width: 120px; height: 120px; bottom: -40px; left: 20px; }

  .ra-modal__logo {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 10px;
    position: relative;
    z-index: 1;
  }
  .ra-modal__logo-icon {
    width: 48px;
    height: 48px;
    background: rgba(255,255,255,.1);
    border: 1px solid rgba(255,255,255,.2);
    border-radius: var(--radius-md);
    display: grid;
    place-items: center;
    color: var(--gold-light);
    font-size: 1.2rem;
    backdrop-filter: blur(8px);
  }
  .ra-modal__logo-text {
    font-family: var(--font-head);
    font-size: 1.3rem;
    font-weight: 800;
    color: #fff;
    letter-spacing: -.02em;
  }
  .ra-modal__logo-sub {
    font-size: .75rem;
    color: rgba(255,255,255,.6);
    letter-spacing: .08em;
    text-transform: uppercase;
    font-weight: 700;
  }
  .ra-modal__tagline {
    font-size: .85rem;
    color: rgba(255,255,255,.7);
    margin: 0;
    font-family: var(--font-body);
    position: relative;
    z-index: 1;
  }
  .ra-modal__close {
    position: absolute;
    top: 16px;
    right: 16px;
    width: 32px;
    height: 32px;
    background: rgba(255,255,255,.1);
    border: none;
    border-radius: 50%;
    color: rgba(255,255,255,.8);
    font-size: .9rem;
    cursor: pointer;
    display: grid;
    place-items: center;
    transition: var(--transition);
    z-index: 2;
  }
  .ra-modal__close:hover { background: rgba(255,255,255,.25); color: #fff; transform: rotate(90deg); }

  /* ── Modal body ─────────────────────────────────────────────── */
  .ra-modal__body {
    padding: 32px 32px 20px;
    background: var(--surface);
  }

  /* Field group */
  .ra-field { margin-bottom: 20px; }
  .ra-field__label {
    display: block;
    font-size: .85rem;
    font-weight: 700;
    color: var(--text-2);
    margin-bottom: 8px;
    letter-spacing: .02em;
  }
  .ra-field__wrap {
    position: relative;
    display: flex;
    align-items: center;
  }
  .ra-field__icon {
    position: absolute;
    left: 14px;
    color: var(--text-3);
    font-size: .9rem;
    pointer-events: none;
    transition: var(--transition);
  }
  .ra-field__input {
    width: 100%;
    border: 1.5px solid #e5ddd3;
    border-radius: var(--radius-md);
    padding: 12px 14px 12px 40px;
    font-family: var(--font-body);
    font-size: .95rem;
    color: var(--text-1);
    background: var(--surface-2);
    transition: var(--transition);
    outline: none;
  }
  .ra-field__input:focus {
    border-color: var(--gold);
    background: var(--surface);
    box-shadow: 0 0 0 4px rgba(184,124,46,.1);
  }
  .ra-field__input:focus + .ra-field__icon { color: var(--gold); }
  .ra-field__input::placeholder { color: var(--text-3); }

  /* Password toggle */
  .ra-field__eye {
    position: absolute;
    right: 12px;
    background: none;
    border: none;
    color: var(--text-3);
    cursor: pointer;
    font-size: .9rem;
    padding: 4px;
    transition: var(--transition);
  }
  .ra-field__eye:hover { color: var(--gold); }

  /* CAPTCHA row */
  .ra-captcha {
    display: flex;
    gap: 12px;
    align-items: center;
    margin-top: 8px;
  }
  .ra-captcha__input-wrap { flex: 1; position: relative; }
  .ra-captcha__img-wrap {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-shrink: 0;
  }
  .ra-captcha__img {
    height: 46px;
    border-radius: var(--radius-sm);
    border: 1.5px solid #e5ddd3;
    object-fit: cover;
  }
  .ra-captcha__refresh {
    width: 38px;
    height: 38px;
    background: var(--surface-2);
    border: 1.5px solid #e5ddd3;
    border-radius: var(--radius-sm);
    color: var(--text-2);
    font-size: 1rem;
    cursor: pointer;
    display: grid;
    place-items: center;
    transition: var(--transition);
    flex-shrink: 0;
  }
  .ra-captcha__refresh:hover {
    background: var(--gold-tint);
    border-color: var(--gold);
    color: var(--gold-dark);
    transform: rotate(180deg);
  }

  /* Divider */
  .ra-modal__divider {
    height: 1px;
    background: var(--border-soft);
    margin: 0 32px;
  }

  /* ── Modal footer ───────────────────────────────────────────── */
  .ra-modal__footer {
    padding: 20px 32px 32px;
    background: var(--surface);
  }
  .ra-modal__submit {
    width: 100%;
    background: linear-gradient(135deg, var(--gold-light) 0%, var(--gold-dark) 100%);
    color: #fff;
    border: none;
    border-radius: var(--radius-md);
    padding: 14px 20px;
    font-family: var(--font-head);
    font-size: 1rem;
    font-weight: 700;
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    letter-spacing: .02em;
    box-shadow: 0 6px 16px rgba(184,124,46,.25);
  }
  .ra-modal__submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(184,124,46,.35);
  }
  .ra-modal__submit:active { transform: scale(.98); }
  
  /* Loading state */
  .ra-modal__submit.loading { opacity: .8; pointer-events: none; }
  .ra-modal__submit.loading .btn-text { display: none; }
  .ra-modal__submit .btn-spinner { display: none; }
  .ra-modal__submit.loading .btn-spinner { display: inline-block; }

  /* Forgot link */
  .ra-modal__forgot {
    display: block;
    text-align: center;
    margin-top: 16px;
    font-size: .8rem;
    color: var(--text-3);
  }
  .ra-modal__forgot a {
    color: var(--gold);
    font-weight: 700;
    text-decoration: none;
    transition: var(--transition);
  }
  .ra-modal__forgot a:hover { color: var(--gold-dark); text-decoration: underline; }

  /* ── Spinner ────────────────────────────────────────────────── */
  @keyframes spin { to { transform: rotate(360deg); } }
  .ra-spinner {
    width: 18px;
    height: 18px;
    border: 2.5px solid rgba(255,255,255,.4);
    border-top-color: #fff;
    border-radius: 50%;
    animation: spin .7s linear infinite;
    display: inline-block;
  }
</style>

<!-- ── Top Bar ───────────────────────────────────────────────── -->
<div class="ra-topbar">
  <div class="ra-topbar__inner">
    <?php if (isset($_SESSION['user_id'])): ?>
      <span class="ra-topbar__greeting">
        <!-- Avatar initials -->
        <span class="ra-topbar__avatar" aria-hidden="true">
          <?= strtoupper(substr(htmlspecialchars($_SESSION['username']), 0, 1)) ?>
        </span>
        Halo, <strong class="ra-topbar__name"><?= htmlspecialchars($_SESSION['username']) ?></strong>
        <span class="ra-topbar__role"><?= htmlspecialchars($_SESSION['role']) ?></span>
      </span>
      <span class="ra-topbar__sep" aria-hidden="true"></span>
      <a href="proses/logout.php" class="ra-topbar__logout" title="Keluar dari akun">
        <i class="fas fa-sign-out-alt fa-xs" aria-hidden="true"></i> Logout
      </a>
    <?php else: ?>
      <span class="ra-topbar__login-hint">
        <i class="fas fa-lock fa-xs" aria-hidden="true"></i>
        Akses penuh tersedia setelah login
      </span>
      <a href="#" class="ra-topbar__login-btn"
         data-bs-toggle="modal" data-bs-target="#loginModal">
        Masuk Sekarang
      </a>
    <?php endif; ?>
  </div>
</div>

<!-- ── Main Navbar ───────────────────────────────────────────── -->
<nav class="ra-navbar" aria-label="Navigasi utama">
  <div class="ra-navbar__inner">

    <!-- Logo -->
    <a href="?menu=home" class="ra-navbar__logo">
      <span class="ra-navbar__logo-mark"><i class="fas fa-store" aria-hidden="true"></i></span>
      <span>
        <span class="ra-navbar__logo-text">Raja Ahmad</span>
        <span class="ra-navbar__logo-sub">UMKM Marketplace</span>
      </span>
    </a>

    <!-- Hamburger -->
    <button class="ra-navbar__toggler" id="navToggler" aria-label="Toggle navigasi" aria-expanded="false" aria-controls="navCollapse">
      <span></span>
      <span></span>
      <span></span>
    </button>

    <!-- Collapsible menu -->
    <div class="ra-navbar__collapse" id="navCollapse">
      <ul class="ra-nav" role="list">

        <!-- Beranda — always visible -->
        <li class="ra-nav__item">
          <a class="ra-nav__link" href="?menu=home">
            <i class="fas fa-home" aria-hidden="true"></i> Beranda
          </a>
        </li>

        <?php if (isset($_SESSION['user_id']) && hasRole(['Admin','Pemilik','Staf'])): ?>

          <li class="ra-nav__item">
            <a class="ra-nav__link" href="?menu=dashboard">
              <i class="fas fa-chart-bar" aria-hidden="true"></i> Dashboard
            </a>
          </li>

          <li class="ra-nav__item">
            <a class="ra-nav__link" href="?menu=produk">
              <i class="fas fa-box" aria-hidden="true"></i> Produk
            </a>
          </li>

          <?php if (hasRole(['Admin','Pemilik'])): ?>
            <li class="ra-nav__item">
              <a class="ra-nav__link ra-nav__link--admin" href="?menu=staf">
                <i class="fas fa-users" aria-hidden="true"></i> Staf
              </a>
            </li>
          <?php endif; ?>

          <li class="ra-nav__item">
            <a class="ra-nav__link" href="?menu=transaksi_masuk">
              <i class="fas fa-arrow-circle-down" aria-hidden="true"></i> Barang Masuk
            </a>
          </li>

          <li class="ra-nav__item">
            <a class="ra-nav__link" href="?menu=laporan">
              <i class="fas fa-chart-line" aria-hidden="true"></i> Laporan
            </a>
          </li>

        <?php endif; ?>
      </ul>
    </div><!-- /collapse -->

  </div>
</nav>

<!-- ── Login Modal ───────────────────────────────────────────── -->
<div class="modal fade ra-modal" id="loginModal" tabindex="-1"
     aria-labelledby="loginModalLabel" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Header -->
      <div class="ra-modal__header">
        <div class="ra-modal__logo">
          <span class="ra-modal__logo-icon"><i class="fas fa-crown" aria-hidden="true"></i></span>
          <span>
            <div class="ra-modal__logo-text" id="loginModalLabel">Raja Ahmad</div>
            <div class="ra-modal__logo-sub">UMKM Marketplace</div>
          </span>
        </div>
        <p class="ra-modal__tagline">Masuk untuk mengakses dashboard & laporan</p>
        <!-- Custom close button -->
        <button class="ra-modal__close" data-bs-dismiss="modal" aria-label="Tutup">
          <i class="fas fa-times" aria-hidden="true"></i>
        </button>
      </div>

      <!-- Form -->
      <form action="proses/login.php" method="POST" id="loginForm" novalidate>
        <div class="ra-modal__body">

          <!-- Username -->
          <div class="ra-field">
            <label class="ra-field__label" for="login_username">Username</label>
            <div class="ra-field__wrap">
              <i class="fas fa-user ra-field__icon" aria-hidden="true"></i>
              <input
                type="text"
                id="login_username"
                name="username"
                class="ra-field__input"
                placeholder="Masukkan username Anda"
                autocomplete="username"
                required
              >
            </div>
          </div>

          <!-- Password -->
          <div class="ra-field">
            <label class="ra-field__label" for="login_password">Password</label>
            <div class="ra-field__wrap">
              <i class="fas fa-lock ra-field__icon" aria-hidden="true"></i>
              <input
                type="password"
                id="login_password"
                name="password"
                class="ra-field__input"
                placeholder="Masukkan password Anda"
                autocomplete="current-password"
                required
              >
              <!-- Show/hide toggle -->
              <button type="button" class="ra-field__eye" id="togglePwd" aria-label="Tampilkan password">
                <i class="far fa-eye" aria-hidden="true"></i>
              </button>
            </div>
          </div>

          <!-- CAPTCHA -->
          <div class="ra-field">
            <label class="ra-field__label" for="captcha_input">Kode Verifikasi</label>
            <div class="ra-captcha">
              <!-- Input -->
              <div class="ra-captcha__input-wrap">
                <div class="ra-field__wrap">
                  <i class="fas fa-shield-alt ra-field__icon" aria-hidden="true"></i>
                  <input
                    type="text"
                    id="captcha_input"
                    name="captcha_input"
                    class="ra-field__input"
                    placeholder="4 karakter"
                    maxlength="8"
                    autocomplete="off"
                    required
                  >
                </div>
              </div>
              <!-- Image + refresh -->
              <div class="ra-captcha__img-wrap">
                <img
                  src="proses/captcha.php"
                  id="captcha_img"
                  class="ra-captcha__img"
                  alt="Kode CAPTCHA"
                  width="100"
                  height="46"
                >
                <button
                  type="button"
                  class="ra-captcha__refresh"
                  id="refreshCaptcha"
                  aria-label="Muat ulang CAPTCHA"
                  title="Perbarui kode"
                >
                  <i class="fas fa-sync-alt" aria-hidden="true"></i>
                </button>
              </div>
            </div>
          </div>

        </div><!-- /modal-body -->

        <div class="ra-modal__divider" role="separator"></div>

        <!-- Footer -->
        <div class="ra-modal__footer">
          <button type="submit" class="ra-modal__submit" id="loginSubmit">
            <span class="btn-spinner"><span class="ra-spinner"></span></span>
            <span class="btn-text">
              <i class="fas fa-sign-in-alt" aria-hidden="true"></i>
              Masuk ke Dashboard
            </span>
          </button>
          <p class="ra-modal__forgot">
            Lupa password?
            <a href="mailto:admin@rajaahmad.id">Hubungi Administrator</a>
          </p>
        </div>

      </form>
    </div><!-- /modal-content -->
  </div>
</div><!-- /loginModal -->

<!-- ============================================================
     JAVASCRIPT
     ============================================================ -->
<script>
document.addEventListener("DOMContentLoaded", function () {
  'use strict';

  /* ── Mobile navbar toggle ── */
  var toggler  = document.getElementById('navToggler');
  var collapse = document.getElementById('navCollapse');

  if (toggler && collapse) {
    toggler.addEventListener('click', function () {
      var isOpen = collapse.classList.toggle('open');
      toggler.classList.toggle('open', isOpen);
      toggler.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });
  }

  /* ── Mark active nav link based on URL param ── */
  var currentMenu = new URLSearchParams(window.location.search).get('menu') || 'home';
  document.querySelectorAll('.ra-nav__link').forEach(function (link) {
    if (link.href.includes('menu=' + currentMenu)) {
      link.classList.add('active');
      link.setAttribute('aria-current', 'page');
    }
  });

  /* ── Password show / hide toggle ── */
  var togglePwd = document.getElementById('togglePwd');
  var pwdInput  = document.getElementById('login_password');
  if (togglePwd && pwdInput) {
    togglePwd.addEventListener('click', function () {
      var isText = pwdInput.type === 'text';
      pwdInput.type = isText ? 'password' : 'text';
      var icon = this.querySelector('i');
      icon.classList.toggle('fa-eye',      isText);
      icon.classList.toggle('fa-eye-slash', !isText);
      this.setAttribute('aria-label', isText ? 'Tampilkan password' : 'Sembunyikan password');
    });
  }

  /* ── CAPTCHA refresh ── */
  var refreshBtn  = document.getElementById('refreshCaptcha');
  var captchaImg  = document.getElementById('captcha_img');
  if (refreshBtn && captchaImg) {
    refreshBtn.addEventListener('click', function () {
      captchaImg.src = 'proses/captcha.php?' + Date.now();
    });
  }

  /* ── Login form — loading state on submit ── */
  var loginForm   = document.getElementById('loginForm');
  var loginSubmit = document.getElementById('loginSubmit');
  if (loginForm && loginSubmit) {
    loginForm.addEventListener('submit', function () {
      loginSubmit.classList.add('loading');
    });
  }

  /* ── Reset modal state when closed ── */
  var loginModal = document.getElementById('loginModal');
  if (loginModal) {
    loginModal.addEventListener('hidden.bs.modal', function () {
      loginForm && loginForm.reset();
      loginSubmit && loginSubmit.classList.remove('loading');
      if (pwdInput) pwdInput.type = 'password';
      if (togglePwd) {
        var icon = togglePwd.querySelector('i');
        icon.classList.add('fa-eye');
        icon.classList.remove('fa-eye-slash');
      }
      if (captchaImg) captchaImg.src = 'proses/captcha.php?' + Date.now();
    });
  }
});
</script>