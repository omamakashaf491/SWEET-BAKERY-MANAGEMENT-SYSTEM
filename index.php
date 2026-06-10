<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sweet Delights Bakery — Single Page Storefront</title>
  
  <!-- SEO Meta Tags -->
  <meta name="description" content="Sweet Delights Bakery — Crafting joy one bake at a time. Freshly made cakes for Birthday, Wedding, Anniversary, and Custom occasions in Rawalpindi & Islamabad."/>
  <meta name="keywords" content="bakery, cakes, custom cakes, wedding cakes, rawalpindi, islamabad"/>

  <!-- Google Fonts & Font Awesome -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

  <style>
    /* ══════════════════════════════════════════
       CORE DESIGN SYSTEM & UTILITIES (style.css)
       ══════════════════════════════════════════ */
    *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
    :root {
      --rose:#f2c4b8; --blush:#e8957a; --deep:#c0614a;
      --cream:#fff8f5; --light:#fde8e2; --text:#3a2a25;
      --muted:#8a6b63; --white:#ffffff;
    }
    html { scroll-behavior:smooth; }
    body { font-family:'Poppins',sans-serif; background:var(--cream); color:var(--text); overflow-x:hidden; }

    /* ─── SPA VIEW CONTROL ── */
    .spa-view { display: none; }
    .spa-view.active { display: block; animation: fadeInView 0.4s ease; }
    @keyframes fadeInView {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* ─── NAVBAR ── */
    nav {
      position:sticky; top:0; z-index:999;
      background:var(--white);
      display:flex; align-items:center; justify-content:space-between;
      padding:14px 6%;
      box-shadow:0 2px 18px rgba(0,0,0,.06);
    }
    .logo { display:flex; align-items:center; gap:10px; text-decoration:none; }
    .logo-badge {
      width:56px; height:56px;
      border:2px solid var(--blush);
      border-radius:50% 45% 50% 45%/45% 50% 45% 50%;
      display:grid; place-items:center;
      font-family:'Playfair Display',serif;
      font-size:9px; color:var(--deep);
      text-align:center; line-height:1.3; flex-shrink:0;
    }
    .logo-text { font-family:'Playfair Display',serif; font-size:17px; color:var(--deep); font-weight:700; line-height:1.2; }
    .nav-links { display:flex; gap:4px; list-style:none; }
    .nav-links a {
      text-decoration:none; color:var(--text);
      font-weight:500; font-size:14px;
      padding:9px 16px; border-radius:50px; transition:all .3s;
      cursor: pointer;
    }
    .nav-links a:hover { background:var(--light); color:var(--deep); }
    .nav-links a.active { background:var(--light); color:var(--deep); font-weight:700; }
    .nav-right { display:flex; align-items:center; gap:14px; }
    .cart-btn { position:relative; background:none; border:none; font-size:22px; cursor:pointer; color:var(--text); }
    .cart-count {
      position:absolute; top:-6px; right:-8px;
      background:var(--blush); color:#fff;
      font-size:10px; width:18px; height:18px;
      border-radius:50%; display:grid; place-items:center; font-weight:700;
    }
    .hamburger { display:none; flex-direction:column; gap:5px; cursor:pointer; background:none; border:none; }
    .hamburger span { width:26px; height:2px; background:var(--text); border-radius:2px; transition:.3s; }
    .mobile-menu {
      display:none; flex-direction:column;
      background:var(--white); padding:0 6% 20px;
      box-shadow:0 8px 20px rgba(0,0,0,.08);
      position:sticky; top:85px; z-index:998;
    }
    .mobile-menu.open { display:flex; }
    .mobile-menu a {
      padding:14px 0; border-bottom:1px solid var(--light);
      text-decoration:none; color:var(--text); font-weight:500; font-size:15px;
      cursor: pointer;
    }
    .mobile-menu a.active { color:var(--deep); font-weight:700; }

    /* ─── UTILITIES ── */
    .section-header { text-align:center; margin-bottom:48px; }
    .section-header span { color:var(--blush); font-size:13px; font-weight:600; letter-spacing:3px; text-transform:uppercase; }
    .section-header h2 { font-family:'Playfair Display',serif; font-size:clamp(28px,4vw,44px); color:var(--text); margin-top:8px; }
    .btn-primary {
      display:inline-block; background:rgba(255,255,255,.22); color:var(--white);
      border:2px solid rgba(255,255,255,.6); padding:13px 36px; border-radius:50px;
      font-size:15px; font-weight:600; cursor:pointer; text-decoration:none;
      backdrop-filter:blur(6px); transition:all .3s; font-family:'Poppins',sans-serif;
    }
    .btn-primary:hover { background:var(--white); color:var(--deep); border-color:var(--white); }
    .btn-outline {
      display:inline-block; background:transparent; color:var(--deep);
      border:2px solid var(--blush); padding:11px 32px; border-radius:50px;
      font-size:14px; font-weight:600; cursor:pointer; text-decoration:none;
      transition:all .3s; font-family:'Poppins',sans-serif;
    }
    .btn-outline:hover { background:var(--blush); color:var(--white); }
    .btn-submit {
      width:100%; padding:15px;
      background:linear-gradient(135deg,var(--blush),var(--deep));
      color:var(--white); border:none; border-radius:12px;
      font-family:'Poppins',sans-serif; font-size:16px; font-weight:600;
      cursor:pointer; transition:opacity .3s,transform .2s;
    }
    .btn-submit:hover { opacity:.88; transform:translateY(-2px); }

    /* ─── PRODUCT CARDS ── */
    .products-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(250px,1fr)); gap:28px; }
    .product-card { background:var(--white); border-radius:20px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,.07); transition:transform .3s,box-shadow .3s; }
    .product-card:hover { transform:translateY(-6px); box-shadow:0 12px 36px rgba(0,0,0,.12); }
    .product-card img { width:100%; height:200px; object-fit:cover; background:var(--rose); display:block; }
    .product-info { padding:18px 20px 20px; }
    .product-category { font-size:11px; color:var(--blush); font-weight:600; letter-spacing:2px; text-transform:uppercase; }
    .product-name { font-family:'Playfair Display',serif; font-size:18px; margin:6px 0 2px; }
    .product-flavor { font-size:11px; color:var(--muted); margin-bottom:8px; }
    .product-flavor i { font-size:8px; margin-right:2px; }
    .product-desc { font-size:13px; color:var(--muted); line-height:1.6; margin-bottom:14px; }
    .product-footer { display:flex; align-items:center; justify-content:space-between; }
    .product-price { font-size:18px; font-weight:700; color:var(--deep); }
    .btn-card { background:var(--light); color:var(--deep); border:none; padding:9px 18px; border-radius:50px; font-size:13px; font-weight:600; cursor:pointer; transition:all .3s; font-family:'Poppins',sans-serif; }
    .btn-card:hover { background:var(--blush); color:var(--white); }
    .filter-bar { display:flex; gap:12px; justify-content:center; flex-wrap:wrap; margin-bottom:40px; }
    .filter-btn { padding:9px 24px; border-radius:50px; border:2px solid var(--rose); background:transparent; color:var(--muted); font-size:14px; font-weight:500; cursor:pointer; transition:all .3s; font-family:'Poppins',sans-serif; }
    .filter-btn.active, .filter-btn:hover { background:var(--blush); color:var(--white); border-color:var(--blush); }

    /* ─── TESTIMONIALS ── */
    .testimonials-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:24px; }
    .testimonial-card { background:var(--light); border-radius:20px; padding:28px; }
    .stars { color:#f5a623; margin-bottom:14px; font-size:16px; }
    .testimonial-card p { font-size:14px; color:var(--muted); line-height:1.8; margin-bottom:20px; font-style:italic; }
    .reviewer { display:flex; align-items:center; gap:12px; }
    .reviewer-avatar { width:44px; height:44px; border-radius:50%; background:linear-gradient(135deg,var(--blush),var(--deep)); display:grid; place-items:center; color:var(--white); font-weight:700; font-size:16px; flex-shrink:0; }
    .reviewer-name { font-weight:600; font-size:14px; }
    .reviewer-date { font-size:12px; color:var(--muted); }

    /* ─── CART SIDEBAR ── */
    .cart-overlay { position:fixed; inset:0; background:rgba(0,0,0,.45); z-index:1998; opacity:0; pointer-events:none; transition:opacity .3s; }
    .cart-overlay.open { opacity:1; pointer-events:all; }
    .cart-sidebar { position:fixed; top:0; right:-420px; width:400px; height:100vh; background:var(--white); z-index:1999; display:flex; flex-direction:column; transition:right .35s cubic-bezier(.4,0,.2,1); box-shadow:-8px 0 32px rgba(0,0,0,.12); }
    .cart-sidebar.open { right:0; }
    .cart-header { padding:24px; border-bottom:1px solid var(--light); display:flex; justify-content:space-between; align-items:center; }
    .cart-header h3 { font-family:'Playfair Display',serif; font-size:22px; }
    .close-cart { background:none; border:none; font-size:22px; cursor:pointer; color:var(--muted); }
    .cart-items { flex:1; overflow-y:auto; padding:20px 24px; }
    .cart-empty { text-align:center; padding:60px 0; color:var(--muted); }
    .cart-empty i { font-size:48px; margin-bottom:16px; opacity:.4; display:block; }
    .cart-item { display:flex; gap:14px; align-items:center; padding:14px 0; border-bottom:1px solid var(--light); }
    .cart-item-img { width:64px; height:64px; border-radius:12px; background:var(--light); object-fit:cover; flex-shrink:0; }
    .cart-item-info { flex:1; }
    .cart-item-name { font-weight:600; font-size:13px; }
    .cart-item-sub { font-size:11px; color:var(--muted); }
    .cart-item-price { color:var(--blush); font-weight:700; font-size:14px; margin-top:2px; }
    .qty-controls { display:flex; align-items:center; gap:10px; margin-top:6px; }
    .qty-btn { width:26px; height:26px; border-radius:50%; border:1px solid var(--rose); background:none; cursor:pointer; font-size:14px; color:var(--text); display:grid; place-items:center; transition:all .2s; }
    .qty-btn:hover { background:var(--blush); color:var(--white); border-color:var(--blush); }
    .qty-val { font-weight:600; font-size:14px; }
    .remove-item { background:none; border:none; color:var(--muted); cursor:pointer; font-size:16px; transition:color .2s; }
    .remove-item:hover { color:var(--deep); }
    .cart-footer { padding:20px 24px 28px; border-top:1px solid var(--light); }
    .cart-total { display:flex; justify-content:space-between; font-size:18px; font-weight:700; margin-bottom:16px; }
    .cart-total span:last-child { color:var(--blush); }

    /* ─── FOOTER ── */
    footer { background:var(--text); color:rgba(255,255,255,.7); padding:60px 6% 30px; }
    .footer-grid { display:grid; grid-template-columns:2fr 1fr 1fr 1fr; gap:40px; margin-bottom:40px; }
    .footer-logo { width:52px; height:52px; border:2px solid rgba(255,255,255,.3); border-radius:50% 45% 50% 45%/45% 50% 45% 50%; display:grid; place-items:center; font-family:'Playfair Display',serif; font-size:9px; color:var(--rose); text-align:center; line-height:1.3; text-decoration:none; }
    .footer-brand p { font-size:14px; line-height:1.8; margin-top:14px; }
    .footer-socials { display:flex; gap:12px; margin-top:20px; }
    .social-link { width:38px; height:38px; border-radius:50%; border:1px solid rgba(255,255,255,.2); display:grid; place-items:center; color:rgba(255,255,255,.6); font-size:15px; text-decoration:none; transition:all .3s; }
    .social-link:hover { background:var(--blush); border-color:var(--blush); color:var(--white); }
    .footer-col h4 { color:var(--white); font-size:15px; font-weight:600; margin-bottom:18px; }
    .footer-col ul { list-style:none; }
    .footer-col ul li { margin-bottom:10px; }
    .footer-col ul li a { color:rgba(255,255,255,.6); text-decoration:none; font-size:14px; transition:color .3s; }
    .footer-col ul li a:hover { color:var(--rose); }
    .footer-bottom { border-top:1px solid rgba(255,255,255,.1); padding-top:24px; display:flex; justify-content:space-between; font-size:13px; }

    /* ─── TOAST ── */
    .toast { position:fixed; bottom:30px; left:50%; transform:translateX(-50%) translateY(80px); background:var(--text); color:var(--white); padding:14px 28px; border-radius:50px; font-size:14px; font-weight:500; z-index:2999; transition:transform .4s cubic-bezier(.4,0,.2,1); box-shadow:0 8px 24px rgba(0,0,0,.2); white-space:nowrap; pointer-events: none; }
    .toast.show { transform:translateX(-50%) translateY(0); }

    /* ─── PAGE HERO ── */
    .page-hero { padding:80px 6%; text-align:center; color:var(--white); }
    .page-hero h1 { font-family:'Playfair Display',serif; font-size:clamp(36px,6vw,72px); margin-bottom:14px; }
    .page-hero p { font-size:17px; opacity:.9; max-width:600px; margin:0 auto; }

    /* ══════════════════════════════════════════
       SECTION SPECIFIC STYLES FROM SOURCE PAGES
       ══════════════════════════════════════════ */
    /* --- Home View --- */
    .hero { position:relative; background:linear-gradient(135deg,#d9786a 0%,#e8957a 40%,#f2b5a3 70%,#f9ddd8 100%); min-height:88vh; display:flex; align-items:center; overflow:hidden; padding:60px 6%; }
    .hero-content { position:relative; z-index:2; max-width:500px; }
    .hero-eyebrow { color:rgba(255,255,255,.85); font-size:13px; font-weight:600; letter-spacing:3px; text-transform:uppercase; margin-bottom:14px; }
    .hero-content h1 { font-family:'Playfair Display',serif; font-size:clamp(48px,7vw,88px); font-weight:900; color:#fff; line-height:1.05; text-shadow:0 4px 24px rgba(0,0,0,.15); }
    .hero-content p { margin:18px 0 32px; color:rgba(255,255,255,.88); font-size:16px; line-height:1.7; }
    .hero-image { position:absolute; right:0; top:50%; transform:translateY(-50%); width:58%; max-width:700px; z-index:1; }
    .hero-image img { width:100%; height:88vh; object-fit:cover; }
    .hero-overlay { position:absolute; inset:0; background:linear-gradient(90deg,rgba(192,97,74,.85) 0%,rgba(192,97,74,.4) 45%,transparent 70%); z-index:1; }
    
    .cat-strip { padding:50px 6%; background:#fff; display:grid; grid-template-columns:repeat(4,1fr); gap:20px; }
    .cat-card { background:var(--light); border-radius:20px; padding:28px 20px; text-align:center; cursor:pointer; transition:all .3s; text-decoration:none; }
    .cat-card:hover { background:var(--blush); transform:translateY(-4px); box-shadow:0 10px 28px rgba(192,97,74,.2); }
    .cat-card:hover h4, .cat-card:hover p { color:#fff; }
    .cat-card i { font-size:30px; color:var(--blush); margin-bottom:12px; display:block; transition:color .3s; }
    .cat-card:hover i { color:rgba(255,255,255,.9); }
    .cat-card h4 { font-family:'Playfair Display',serif; font-size:16px; margin-bottom:6px; color:var(--text); }
    .cat-card p { font-size:12px; color:var(--muted); }

    .home-picks { padding:80px 6%; background:var(--light); }
    .picks-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:24px; }
    .view-all-wrap { text-align:center; margin-top:40px; }

    .cta-banner { margin:0 6% 80px; border-radius:28px; background:linear-gradient(135deg,var(--blush),var(--deep)); padding:60px 48px; display:flex; align-items:center; justify-content:space-between; gap:24px; }
    .cta-banner h2 { font-family:'Playfair Display',serif; font-size:clamp(22px,3vw,36px); color:#fff; max-width:520px; }
    .home-reviews { padding:80px 6%; background:#white; }
    .delivery-strip { padding:30px 6%; background:var(--deep); display:flex; justify-content:center; gap:40px; flex-wrap:wrap; }
    .delivery-item { display:flex; align-items:center; gap:12px; color:#fff; font-size:14px; font-weight:500; }
    .delivery-item i { font-size:20px; opacity:.85; }

    /* --- Menu View --- */
    .menu-wrap { padding:80px 6%; background:var(--light); min-height:60vh; }
    .menu-stats { display:flex; justify-content:center; gap:32px; flex-wrap:wrap; padding:32px 6%; background:#fff; border-bottom:1px solid var(--light); }
    .menu-stat { text-align:center; min-width: 120px; }
    .menu-stat strong { display:block; font-family:'Playfair Display',serif; font-size:28px; color:var(--blush); }
    .menu-stat span { font-size:13px; color:var(--muted); }
    .no-results { text-align:center; padding:60px 0; color:var(--muted); font-size:16px; grid-column: 1 / -1; }

    /* --- Offers View --- */
    .offers-wrap { padding:80px 6%; background:var(--white); }
    .promo-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(300px,1fr)); gap:28px; margin-bottom:70px; }
    .promo-card { border-radius:24px; padding:36px; color:#fff; position:relative; overflow:hidden; }
    .promo-card::after { content:''; position:absolute; width:180px; height:180px; border-radius:50%; background:rgba(255,255,255,.1); top:-40px; right:-40px; }
    .promo-card h3 { font-family:'Playfair Display',serif; font-size:24px; margin-bottom:10px; }
    .promo-card p { font-size:14px; opacity:.88; margin-bottom:22px; line-height:1.7; }
    .promo-badge { display:inline-block; background:rgba(255,255,255,.22); border:2px solid rgba(255,255,255,.5); padding:8px 22px; border-radius:50px; font-weight:700; font-size:14px; cursor:pointer; transition:all .3s; }
    .promo-badge:hover { background:rgba(255,255,255,.4); }
    .promo-validity { font-size:12px; margin-top:12px; opacity:.7; }
    .featured-wrap { padding:80px 6%; background:var(--light); }
    .offer-hero-banner { background:linear-gradient(135deg,#d9786a,#c0614a); border-radius:28px; margin:40px 6% 40px; padding:60px 48px; color:#fff; text-align:center; }
    .offer-hero-banner h2 { font-family:'Playfair Display',serif; font-size:clamp(26px,4vw,48px); margin-bottom:12px; }
    .offer-hero-banner p { font-size:16px; opacity:.9; max-width:500px; margin:0 auto; }

    /* --- About View --- */
    .story-section { padding:80px 6%; display:flex; gap:60px; align-items:center; background:#fff; }
    .story-img { flex:1; border-radius:28px; overflow:hidden; box-shadow:0 16px 48px rgba(0,0,0,.12); }
    .story-img img { width:100%; height:440px; object-fit:cover; display:block; background:var(--rose); }
    .story-text { flex:1; }
    .story-text h2 { font-family:'Playfair Display',serif; font-size:clamp(26px,3vw,38px); margin-bottom:18px; }
    .story-text p { color:var(--muted); font-size:15px; line-height:1.9; margin-bottom:16px; }
    .stats-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:16px; margin-top:32px; }
    .stat-box { text-align:center; background:var(--light); border-radius:16px; padding:20px 10px; }
    .stat-box h3 { font-family:'Playfair Display',serif; font-size:30px; color:var(--blush); }
    .stat-box p { font-size:12px; color:var(--muted); margin-top:4px; }
    .values-section { padding:80px 6%; background:var(--light); }
    .values-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(240px,1fr)); gap:24px; }
    .value-card { background:#white; border-radius:20px; padding:32px; text-align:center; box-shadow:0 4px 16px rgba(0,0,0,.06); background:#fff; }
    .value-card i { font-size:36px; color:var(--blush); margin-bottom:16px; display:block; }
    .value-card h4 { font-family:'Playfair Display',serif; font-size:20px; margin-bottom:10px; }
    .value-card p { font-size:14px; color:var(--muted); line-height:1.7; }
    .team-section { padding:80px 6%; background:#fff; }
    .team-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(220px,1fr)); gap:28px; }
    .team-card { background:var(--light); border-radius:20px; overflow:hidden; text-align:center; }
    .team-avatar { height:200px; background:linear-gradient(135deg,var(--rose),var(--blush)); display:grid; place-items:center; font-size:64px; }
    .team-card-info { padding:20px; }
    .team-card-info .role { color:var(--blush); font-weight:600; font-size:11px; text-transform:uppercase; letter-spacing:2px; margin-bottom:6px; }
    .team-card-info h4 { font-family:'Playfair Display',serif; font-size:18px; margin-bottom:6px; }
    .team-card-info p { font-size:13px; color:var(--muted); line-height:1.6; }
    .reviews-section { padding:80px 6%; background:var(--light); }

    /* --- Gallery View --- */
    .gallery-wrap { padding:60px 6% 80px; background:var(--cream); }
    .gallery-filter { display:flex; gap:12px; justify-content:center; flex-wrap:wrap; margin-bottom:40px; }
    .gallery-filter button { padding:9px 24px; border-radius:50px; border:2px solid var(--rose); background:transparent; color:var(--muted); font-size:14px; font-weight:500; cursor:pointer; transition:all .3s; font-family:'Poppins',sans-serif; }
    .gallery-filter button.active, .gallery-filter button:hover { background:var(--blush); color:#fff; border-color:var(--blush); }
    .masonry { columns:3; column-gap:20px; }
    .masonry-item { break-inside:avoid; margin-bottom:20px; border-radius:16px; overflow:hidden; position:relative; cursor:pointer; }
    .masonry-item img { width:100%; display:block; transition:transform .4s; }
    .masonry-item:hover img { transform:scale(1.04); }
    .masonry-overlay { position:absolute; inset:0; background:rgba(192,97,74,.55); display:grid; place-items:center; opacity:0; transition:opacity .3s; }
    .masonry-item:hover .masonry-overlay { opacity:1; }
    .masonry-overlay span { color:#fff; font-weight:600; font-size:14px; }
    
    .lightbox { position:fixed; inset:0; background:rgba(0,0,0,.92); z-index:3000; display:none; place-items:center; }
    .lightbox.open { display:grid; }
    .lightbox img { max-width:90vw; max-height:85vh; border-radius:12px; object-fit:contain; }
    .lightbox-close { position:absolute; top:20px; right:28px; font-size:36px; color:#fff; cursor:pointer; background:none; border:none; line-height:1; }

    /* --- Contact & Custom Order View --- */
    .contact-body { padding:80px 6%; display:flex; gap:60px; align-items:flex-start; background:#fff; }
    .contact-info { flex:1; }
    .contact-info h2 { font-family:'Playfair Display',serif; font-size:clamp(24px,3vw,34px); margin-bottom:28px; }
    .contact-detail { display:flex; align-items:flex-start; gap:16px; margin-bottom:24px; }
    .contact-icon { width:48px; height:48px; background:var(--light); border-radius:50%; display:grid; place-items:center; color:var(--blush); font-size:18px; flex-shrink:0; }
    .contact-detail strong { display:block; margin-bottom:4px; font-size:15px; }
    .contact-detail p { font-size:14px; color:var(--muted); line-height:1.7; }
    .map-box { margin-top:36px; background:var(--light); border-radius:20px; height:220px; display:flex; flex-direction:column; align-items:center; justify-content:center; color:var(--muted); border:2px dashed var(--rose); }
    .map-box i { font-size:36px; margin-bottom:10px; color:var(--blush); }
    .map-box span { font-size:14px; }
    .order-form { flex:1; }
    .order-form h3 { font-family:'Playfair Display',serif; font-size:28px; margin-bottom:24px; }
    .form-group { margin-bottom:18px; }
    .form-group label { display:block; font-size:13px; font-weight:600; color:var(--muted); margin-bottom:7px; text-transform:uppercase; letter-spacing:1px; }
    .form-group input, .form-group select, .form-group textarea { width:100%; padding:13px 18px; border:2px solid var(--rose); border-radius:12px; font-family:'Poppins',sans-serif; font-size:14px; color:var(--text); background:var(--cream); outline:none; transition:border-color .3s; }
    .form-group input:focus, .form-group select:focus, .form-group textarea:focus { border-color:var(--blush); }
    .form-group textarea { resize:vertical; min-height:110px; }
    .form-row { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
    
    .tracking-section { padding:60px 6%; background:var(--light); }
    .tracking-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(200px,1fr)); gap:20px; }
    .tracking-card { background:#fff; border-radius:16px; padding:24px; text-align:center; box-shadow: 0 4px 10px rgba(0,0,0,0.02); }
    .tracking-status { display:inline-block; padding:4px 14px; border-radius:50px; font-size:12px; font-weight:600; margin-bottom:10px; }
    .status-delivered { background:#d4edda; color:#155724; }
    .status-transit   { background:#fff3cd; color:#856404; }
    .status-processing{ background:#cce5ff; color:#004085; }
    .tracking-card h4 { font-family:'Playfair Display',serif; font-size:16px; margin-bottom:4px; }
    .tracking-card p  { font-size:13px; color:var(--muted); }
    
    .faq-section { padding:80px 6%; background:#fff; }
    .faq-list { max-width:760px; margin:0 auto; }
    .faq-item { background:var(--light); border-radius:16px; margin-bottom:14px; overflow:hidden; }
    .faq-q { display:flex; justify-content:space-between; align-items:center; padding:20px 24px; cursor:pointer; font-weight:600; font-size:15px; user-select:none; }
    .faq-q i { color:var(--blush); transition:transform .3s; flex-shrink:0; margin-left:12px; }
    .faq-a { display:none; padding:0 24px 20px; font-size:14px; color:var(--muted); line-height:1.8; }
    .faq-item.open .faq-a { display:block; }
    .faq-item.open .faq-q i { transform:rotate(180deg); }

    /* --- Admin Store View (store.html) --- */
    .store-header-panel { background: white; border-bottom: 1px solid var(--light, #f5e6e0); padding: 24px 6%; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; }
    .store-tabs { display: flex; gap: 12px; padding: 12px 6%; background: var(--light, #f5e6e0); border-bottom: 1px solid rgba(0,0,0,0.05); }
    .store-tab { padding: 10px 20px; background: white; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 14px; transition: all 0.3s; color: var(--text); }
    .store-tab:hover { background: var(--blush, #c0614a); color: white; }
    .store-tab.active { background: var(--blush, #c0614a); color: white; }
    
    .store-content { padding: 40px 6%; min-height: 60vh; }
    .store-tab-pane { display: none; }
    .store-tab-pane.active { display: block; }
    
    .metrics-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; }
    .metric-card { background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); text-align: center; border-bottom: 3px solid var(--blush); }
    .metric-icon { font-size: 36px; margin-bottom: 12px; }
    .metric-label { font-size: 12px; text-transform: uppercase; color: var(--muted, #7d6d5f); font-weight: 700; letter-spacing: 0.5px; margin-bottom: 6px; }
    .metric-value { font-size: 32px; font-weight: 700; color: var(--blush, #c0614a); }
    
    .inventory-container { display: grid; grid-template-columns: 1fr 1.5fr; gap: 32px; }
    .form-panel { background: white; border-radius: 16px; padding: 24px; box-shadow: 0 4px 16px rgba(0,0,0,0.05); height: fit-content; }
    .form-buttons { display: flex; gap: 10px; margin-top: 16px; }
    .btn-save, .btn-reset { flex: 1; padding: 12px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 13px; transition: all 0.3s; }
    .btn-save { background: var(--blush, #c0614a); color: white; }
    .btn-save:hover { background: #a84d3a; }
    .btn-reset { background: var(--light, #f5e6e0); color: var(--deep, #3d2817); }
    .btn-reset:hover { background: #e8d4cc; }
    
    .table-panel { background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 16px rgba(0,0,0,0.05); }
    .inventory-table { width: 100%; border-collapse: collapse; }
    .inventory-table th { background: var(--light, #f5e6e0); padding: 14px; text-align: left; font-weight: 700; font-size: 12px; text-transform: uppercase; }
    .inventory-table td { padding: 12px 14px; border-bottom: 1px solid var(--light, #f5e6e0); font-size: 13px; }
    .inventory-table tr:hover { background: var(--cream); }
    .btn-edit { padding: 6px 12px; background: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 12px; margin-right: 4px; font-weight:600; }
    .btn-edit:hover { background: #45a049; }
    .btn-delete { padding: 6px 12px; background: #f44336; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 12px; font-weight:600; }
    .btn-delete:hover { background: #da190b; }
    
    .empty-state { text-align: center; padding: 60px 20px; color: var(--muted, #7d6d5f); grid-column: 1/-1; }
    .empty-state-icon { font-size: 48px; margin-bottom: 12px; }
    
    /* Global Checkout Modal */
    .modal-backdrop { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); z-index: 2000; align-items: center; justify-content: center; backdrop-filter: blur(4px); }
    .modal-backdrop.show { display: flex; }
    .modal-box { background: white; border-radius: 20px; padding: 32px; max-width: 520px; width: 90%; max-height: 90vh; overflow-y: auto; box-shadow: 0 12px 48px rgba(0,0,0,0.25); animation: zoomIn 0.3s ease; }
    @keyframes zoomIn { from { transform: scale(0.9); opacity: 0; } to { transform: scale(1); opacity: 1; } }
    .modal-title { font-size: 22px; font-weight: 700; margin-bottom: 20px; color: var(--text); font-family:'Playfair Display',serif; }
    .modal-field { margin-bottom: 16px; }
    .modal-label { display: block; font-size: 12px; font-weight: 700; margin-bottom: 6px; color: var(--muted); text-transform:uppercase; letter-spacing: 0.5px; }
    .modal-input { width: 100%; padding: 12px; border: 1px solid var(--rose); border-radius: 8px; font-size: 13px; outline:none; }
    .modal-input:focus { border-color: var(--blush); }
    .basket-items { background: var(--light, #f5e6e0); border-radius: 12px; padding: 16px; margin-bottom: 16px; max-height: 200px; overflow-y: auto; }
    .basket-item { display: flex; justify-content: space-between; padding: 8px 0; font-size: 13px; border-bottom: 1px solid rgba(255,255,255,0.6); }
    .basket-item:last-child { border-bottom: none; }
    .order-total { background: var(--blush, #c0614a); color: white; padding: 14px; border-radius: 8px; text-align: right; font-size: 16px; font-weight: 700; margin-bottom: 20px; }
    .modal-buttons { display: flex; gap: 12px; }
    .btn-cancel { flex: 1; padding: 14px; background: var(--light, #f5e6e0); color: var(--deep, #3d2817); border: none; border-radius: 8px; cursor: pointer; font-weight: 700; font-size: 14px; transition: background 0.3s; }
    .btn-cancel:hover { background: #e8d4cc; }

    /* Responsive Overrides */
    @media(max-width:900px) {
      .nav-links { display:none; }
      .hamburger { display:flex; }
      .footer-grid { grid-template-columns:1fr 1fr; }
      .story-section { flex-direction:column; gap:40px; }
      .inventory-container { grid-template-columns: 1fr; }
    }
    @media(max-width:600px) {
      .cart-sidebar { width:100%; right:-100%; }
      .footer-grid { grid-template-columns:1fr; }
      .footer-bottom { flex-direction:column; gap:10px; text-align:center; }
      .cat-strip { grid-template-columns:repeat(2,1fr); }
      .picks-grid { grid-template-columns:1fr; }
      .cta-banner { flex-direction:column; text-align:center; padding:40px 28px; }
      .hero-image { display:none; }
      .hero-overlay { display:none; }
      .delivery-strip { gap:20px; padding:24px 6%; }
      .stats-grid { grid-template-columns:repeat(2,1fr); }
    }
  </style>
</head>
<body>

  <!-- GLOBAL NAVBAR -->
  <nav>
    <a href="#" data-target="home" class="logo">
      <div class="logo-badge">Sweet<br>Delights</div>
      <div class="logo-text">Sweet Delights<br><span style="font-size:11px;font-weight:400;color:var(--muted)">Bakery</span></div>
    </a>
    <ul class="nav-links">
      <li><a href="#home" data-target="home" class="active">Home</a></li>
      <li><a href="#menu" data-target="menu">Menu</a></li>
      <li><a href="#offers" data-target="offers">Offers</a></li>
      <li><a href="#about" data-target="about">About</a></li>
      <li><a href="#gallery" data-target="gallery">Gallery</a></li>
      <li><a href="#contact" data-target="contact">Contact</a></li>
      <li><a href="#store" data-target="store" style="border: 2px dashed var(--blush); padding: 7px 14px; margin-left: 6px;">🏪 Admin Store</a></li>
    </ul>
    <div class="nav-right">
      <button class="cart-btn" onclick="toggleCart()">
        <i class="fas fa-shopping-basket"></i>
        <span class="cart-count" id="cartCount">0</span>
      </button>
      <button class="hamburger" onclick="toggleMobileMenu()"><span></span><span></span><span></span></button>
    </div>
  </nav>

  <!-- MOBILE NAVIGATION DRAWER -->
  <div class="mobile-menu" id="mobileMenu">
    <a href="#home" data-target="home" class="active">🏠 Home</a>
    <a href="#menu" data-target="menu">🎂 Menu</a>
    <a href="#offers" data-target="offers">🎁 Offers</a>
    <a href="#about" data-target="about">📖 About</a>
    <a href="#gallery" data-target="gallery">🖼️ Gallery</a>
    <a href="#contact" data-target="contact">📬 Contact</a>
    <a href="#store" data-target="store">🏪 Admin Store</a>
  </div>

  <!-- SINGLE PAGE VIEW ROOT -->
  <main id="spa-root">

    <!-- ─── 1. HOME VIEW ─── -->
    <div id="view-home" class="spa-view active">
      <!-- HERO -->
      <section class="hero">
        <div class="hero-content">
          <div class="hero-eyebrow">✦ Rawalpindi &amp; Islamabad ✦</div>
          <h1>Sweet<br>Delights<br>Bakery</h1>
          <p>Freshly baked cakes for every occasion.<br>Birthday, Wedding, Anniversary &amp; Custom orders.</p>
          <a href="#menu" data-target="menu" class="btn-primary">Explore Menu</a>
        </div>
        <div class="hero-image">
          <img src="https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=900&auto=format&fit=crop" alt="Chocolate Cake"/>
        </div>
        <div class="hero-overlay"></div>
      </section>

      <!-- DELIVERY STRIP -->
      <div class="delivery-strip">
        <div class="delivery-item"><i class="fas fa-truck"></i> Same-Day Delivery Available</div>
        <div class="delivery-item"><i class="fas fa-map-marker-alt"></i> Rawalpindi &amp; Islamabad</div>
        <div class="delivery-item"><i class="fas fa-credit-card"></i> Credit Card &amp; Cash on Delivery</div>
        <div class="delivery-item"><i class="fas fa-star"></i> Rated 5★ by our customers</div>
      </div>

      <!-- CATEGORY STRIP -->
      <div class="cat-strip">
        <div onclick="navigateToCategory(1)" class="cat-card">
          <i class="fas fa-birthday-cake"></i>
          <h4>Birthday Cakes</h4>
          <p>7 signature flavours</p>
        </div>
        <div onclick="navigateToCategory(2)" class="cat-card">
          <i class="fas fa-ring"></i>
          <h4>Wedding Cakes</h4>
          <p>Elegant tiered creations</p>
        </div>
        <div onclick="navigateToCategory(3)" class="cat-card">
          <i class="fas fa-heart"></i>
          <h4>Anniversary Cakes</h4>
          <p>Celebrate your milestones</p>
        </div>
        <div onclick="navigateToCategory(4)" class="cat-card">
          <i class="fas fa-magic"></i>
          <h4>Custom Cakes</h4>
          <p>Fully personalised orders</p>
        </div>
      </div>

      <!-- FAVOURITE PICKS -->
      <section class="home-picks">
        <div class="section-header">
          <span>Most Loved</span>
          <h2>Customer Favourites</h2>
        </div>
        <div class="picks-grid" id="homePicks"></div>
        <div class="view-all-wrap">
          <a href="#menu" data-target="menu" class="btn-outline">View Full Menu &rarr;</a>
        </div>
      </section>

      <!-- REVIEWS -->
      <section class="home-reviews">
        <div class="section-header">
          <span>Customer Love</span>
          <h2>What People Say</h2>
        </div>
        <div class="testimonials-grid" id="homeReviews"></div>
      </section>

      <!-- CTA BANNER -->
      <div class="cta-banner">
        <h2>Ready to place a custom order? We'd love to bake for you! 🎂</h2>
        <a href="#contact" data-target="contact" class="btn-primary">Order Now</a>
      </div>
    </div>


    <!-- ─── 2. MENU VIEW ─── -->
    <div id="view-menu" class="spa-view">
      <!-- PAGE HERO -->
      <div class="page-hero" style="background:linear-gradient(135deg,#d9786a,#e8957a,#f2b5a3)">
        <h1>Our Menu</h1>
        <p>Handcrafted cakes for every occasion — Birthday, Wedding, Anniversary &amp; Custom orders.</p>
      </div>

      <!-- STATS BAR -->
      <div class="menu-stats">
        <div class="menu-stat"><strong id="stats-total-products">25</strong><span>Cake Varieties</span></div>
        <div class="menu-stat"><strong>4</strong><span>Categories</span></div>
        <div class="menu-stat"><strong>5</strong><span>Distinct Flavours</span></div>
        <div class="menu-stat"><strong>Rs 2,200</strong><span>Starting Price</span></div>
      </div>

      <!-- MENU SECTION -->
      <div class="menu-wrap">
        <!-- Filter by Category -->
        <div class="filter-bar" id="filterBar">
          <button class="filter-btn active" onclick="filterMenu(0,this)">All Cakes</button>
          <button class="filter-btn" onclick="filterMenu(1,this)">🎂 Birthday Cakes</button>
          <button class="filter-btn" onclick="filterMenu(2,this)">💍 Wedding Cakes</button>
          <button class="filter-btn" onclick="filterMenu(3,this)">💕 Anniversary Cakes</button>
          <button class="filter-btn" onclick="filterMenu(4,this)">✨ Custom Cakes</button>
        </div>
        <div class="products-grid" id="menuGrid"></div>
      </div>
    </div>


    <!-- ─── 3. OFFERS VIEW ─── -->
    <div id="view-offers" class="spa-view">
      <div class="page-hero" style="background:linear-gradient(135deg,#c0614a,#e8957a,#f2b5a3)">
        <h1>Sweet Deals</h1>
        <p>Limited-time promotions on all categories. Use codes at checkout!</p>
      </div>

      <div style="height:60px"></div>
      <div class="offer-hero-banner">
        <h2>🎁 Exclusive Offers Just for You</h2>
        <p>Show the code at the counter or enter it online — savings are waiting!</p>
      </div>

      <!-- PROMO CODES -->
      <div class="offers-wrap">
        <div class="section-header"><span>Active Promotions</span><h2>Current Deals</h2></div>
        <div class="promo-grid" id="promoGrid"></div>
      </div>

      <!-- FEATURED CAKES -->
      <div class="featured-wrap">
        <div class="section-header"><span>Most Popular</span><h2>Featured Cakes</h2></div>
        <div class="products-grid" id="featuredGrid"></div>
      </div>
    </div>


    <!-- ─── 4. ABOUT VIEW ─── -->
    <div id="view-about" class="spa-view">
      <div class="page-hero" style="background:linear-gradient(135deg,#d9786a,#e8957a,#f2c4b8)">
        <h1>Our Story</h1>
        <p>From a home kitchen dream to Rawalpindi's favourite cake destination — this is Sweet Delights Bakery.</p>
      </div>

      <!-- STORY -->
      <section class="story-section">
        <div class="story-img">
          <img src="https://images.unsplash.com/photo-1486427944299-d1955d23e34d?w=700&auto=format&fit=crop" alt="Baking"/>
        </div>
        <div class="story-text">
          <span style="color:var(--blush);font-size:13px;font-weight:600;letter-spacing:3px;text-transform:uppercase">Est. 2015</span>
          <h2>Baked with Passion in Rawalpindi</h2>
          <p>Sweet Delights Bakery was born from a simple belief: that everyone deserves a beautifully crafted cake for life's most important moments. Farah Noor, our founder, started with just a handful of recipes and an unshakeable love for baking.</p>
          <p>Today we proudly serve customers across Rawalpindi, Islamabad, and Lahore — delivering Birthday Cakes, Wedding Cakes, Anniversary Cakes, and fully custom creations, all made fresh to order.</p>
          <p>Every cake that leaves our kitchen carries the same warmth, care, and artistry as the very first one we ever baked.</p>
          <div class="stats-grid">
            <div class="stat-box"><h3 id="about-stat-users">5</h3><p>Registered Users</p></div>
            <div class="stat-box"><h3 id="about-stat-products">25</h3><p>Cake Varieties</p></div>
            <div class="stat-box"><h3>4</h3><p>Categories</p></div>
            <div class="stat-box"><h3 id="about-stat-orders">6</h3><p>Orders Fulfilled</p></div>
            <div class="stat-box"><h3>5★</h3><p>Avg Rating</p></div>
            <div class="stat-box"><h3>Daily</h3><p>Fresh Baked</p></div>
          </div>
        </div>
      </section>

      <!-- VALUES -->
      <section class="values-section">
        <div class="section-header"><span>What We Stand For</span><h2>Our Values</h2></div>
        <div class="values-grid">
          <div class="value-card"><i class="fas fa-heart"></i><h4>Made with Love</h4><p>Every cake is prepared with genuine care — we bake as if we're baking for our own family.</p></div>
          <div class="value-card"><i class="fas fa-birthday-cake"></i><h4>Occasion-Ready</h4><p>From birthdays to weddings, we specialise in cakes that make your most special moments unforgettable.</p></div>
          <div class="value-card"><i class="fas fa-truck"></i><h4>Reliable Delivery</h4><p>Our dedicated riders — Ahmed, Bilal, Muhammad, Asim, Bilal A., and Abbas — ensure your cake arrives on time.</p></div>
          <div class="value-card"><i class="fas fa-award"></i><h4>Quality Always</h4><p>We never compromise. From the finest ingredients to the last fondant detail — standards are everything.</p></div>
        </div>
      </section>

      <!-- TEAM -->
      <section class="team-section">
        <div class="section-header"><span>The Hands Behind It All</span><h2>Meet Our Team</h2></div>
        <div class="team-grid" id="teamGrid"></div>
      </section>

      <!-- REVIEWS -->
      <section class="reviews-section">
        <div class="section-header"><span>Customer Love</span><h2>What Our Customers Say</h2></div>
        <div class="testimonials-grid" id="reviewsGrid"></div>
      </section>
    </div>


    <!-- ─── 5. GALLERY VIEW ─── -->
    <div id="view-gallery" class="spa-view">
      <div class="page-hero" style="background:linear-gradient(135deg,#b56a5a,#e8957a,#f2c4b8)">
        <h1>Our Gallery</h1>
        <p>A visual feast of every cake that has left our kitchen — from birthday classics to wedding masterpieces.</p>
      </div>

      <div class="gallery-wrap">
        <div class="gallery-filter">
          <button class="active" onclick="filterGallery('all',this)">All</button>
          <button onclick="filterGallery('birthday',this)">🎂 Birthday</button>
          <button onclick="filterGallery('wedding',this)">💍 Wedding</button>
          <button onclick="filterGallery('anniversary',this)">💕 Anniversary</button>
          <button onclick="filterGallery('custom',this)">✨ Custom</button>
          <button onclick="filterGallery('behind',this)">📸 Behind the Scenes</button>
        </div>
        <div class="masonry" id="galleryGrid"></div>
      </div>

      <!-- Lightbox Modal -->
      <div class="lightbox" id="lightbox" onclick="closeLightbox()">
        <button class="lightbox-close" onclick="closeLightbox()">✕</button>
        <img id="lightboxImg" src="" alt="Gallery Image"/>
      </div>
    </div>


    <!-- ─── 6. CONTACT VIEW ─── -->
    <div id="view-contact" class="spa-view">
      <div class="page-hero" style="background:linear-gradient(135deg,#c0614a,#d9786a,#f2b5a3)">
        <h1>Get In Touch</h1>
        <p>We'd love to hear from you — custom orders, questions, or just to say hello!</p>
      </div>

      <!-- CONTACT FORM PANEL -->
      <div style="padding:40px 6%; background:var(--cream);">
        <div style="max-width:820px; margin:0 auto; background:#fff; padding:32px; border-radius:16px; box-shadow:0 8px 24px rgba(0,0,0,.06)">
          <h3 style="margin-bottom:20px; font-family:'Playfair Display',serif; font-size:24px;">Send Us a Message</h3>
          <form id="contactForm" method="POST" onsubmit="submitContactForm(event)">
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:16px">
              <input name="name" type="text" placeholder="Your name" required style="width:100%; padding:12px 16px; border:2px solid var(--rose); border-radius:8px; outline:none; font-family:inherit;"/>
              <input name="email" type="email" placeholder="you@domain.com" required style="width:100%; padding:12px 16px; border:2px solid var(--rose); border-radius:8px; outline:none; font-family:inherit;"/>
            </div>
            <input name="subject" type="text" placeholder="Subject" style="width:100%; padding:12px 16px; border:2px solid var(--rose); border-radius:8px; margin-bottom:16px; outline:none; font-family:inherit;"/>
            <textarea name="message" placeholder="Write your message here" required style="width:100%; padding:12px 16px; border:2px solid var(--rose); border-radius:8px; min-height:120px; margin-bottom:16px; outline:none; font-family:inherit; resize:vertical;"></textarea>
            <div style="text-align:right"><button type="submit" class="btn-submit" style="width:auto; padding:12px 36px;">Send Message ✉️</button></div>
          </form>
        </div>
      </div>

      <!-- CONTACT DETAILS & MAP -->
      <div class="contact-body">
        <div class="contact-info">
          <h2>Visit Us or Reach Out</h2>
          <div class="contact-detail">
            <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
            <div><strong>Primary Location</strong><p>Rawalpindi, Punjab, Pakistan</p></div>
          </div>
          <div class="contact-detail">
            <div class="contact-icon"><i class="fas fa-map-pin"></i></div>
            <div><strong>Also Delivering To</strong><p>Islamabad &amp; Lahore</p></div>
          </div>
          <div class="contact-detail">
            <div class="contact-icon"><i class="fas fa-clock"></i></div>
            <div><strong>Opening Hours</strong><p>Mon–Sat: 8:00 AM – 9:00 PM<br>Sunday: 9:00 AM – 6:00 PM</p></div>
          </div>
          <div class="contact-detail">
            <div class="contact-icon"><i class="fas fa-phone"></i></div>
            <div><strong>Call Us</strong><p>0300-1234567</p></div>
          </div>
          <div class="contact-detail">
            <div class="contact-icon"><i class="fas fa-envelope"></i></div>
            <div><strong>Email</strong><p>hello@sweetdelightsbakery.pk</p></div>
          </div>
          <div class="contact-detail">
            <div class="contact-icon"><i class="fab fa-whatsapp"></i></div>
            <div><strong>WhatsApp Orders</strong><p>0311-1234567</p></div>
          </div>
          <div class="map-box">
            <i class="fas fa-map-marked-alt"></i>
            <span>Rawalpindi, Punjab, Pakistan</span>
          </div>
        </div>

        <!-- Custom Customisation Order Form -->
        <div class="order-form">
          <h3>Place a Custom Order 🎂</h3>
          <form id="orderForm" onsubmit="submitCustomOrder(event)">
            <div class="form-row">
              <div class="form-group"><label>Full Name</label><input type="text" placeholder="Ali Khan" required id="custName"/></div>
              <div class="form-group"><label>Phone / WhatsApp</label><input type="tel" placeholder="0300-0000000" required id="custPhone"/></div>
            </div>
            <div class="form-group"><label>Email Address</label><input type="email" placeholder="ali@gmail.com" id="custEmail"/></div>
            <div class="form-group">
              <label>Cake Category</label>
              <select required id="custCategory">
                <option value="">— Select Category —</option>
                <option>Birthday Cake</option>
                <option>Wedding Cake</option>
                <option>Anniversary Cake</option>
                <option>Custom Cake</option>
              </select>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label>Cake Flavour</label>
                <select id="custFlavor">
                  <option>Chocolate</option>
                  <option>Vanilla</option>
                  <option>Coffee</option>
                  <option>Red Velvet</option>
                  <option>Vanilla &amp; Lotus</option>
                </select>
              </div>
              <div class="form-group">
                <label>Size</label>
                <select id="custSize">
                  <option>2 Pound</option>
                  <option>3 Pound</option>
                  <option>4 Pound</option>
                </select>
              </div>
            </div>
            <div class="form-group"><label>Message on Cake</label><input type="text" placeholder="e.g. Happy Birthday Ali" id="custMsg"/></div>
            <div class="form-group">
              <label>Theme Colour</label>
              <select id="custColor">
                <option>Blue</option>
                <option>Pink</option>
                <option>Gold</option>
                <option>White</option>
                <option>Black</option>
                <option>Red</option>
                <option>Custom</option>
              </select>
            </div>
            <div class="form-group">
              <label>Delivery Address</label>
              <input type="text" placeholder="Rawalpindi / Islamabad / Lahore" required id="custAddress"/>
            </div>
            <div class="form-group"><label>Preferred Delivery Date</label><input type="date" required id="custDate"/></div>
            <div class="form-group">
              <label>Payment Method</label>
              <select id="custPayMethod">
                <option>Cash on Delivery</option>
                <option>Credit Card</option>
              </select>
            </div>
            <div class="form-group"><label>Special Instructions</label><textarea placeholder="Extra chocolate frosting, fondant decorations, allergies…" id="custInstructions"></textarea></div>
            <button type="submit" class="btn-submit">Send Order Request 🍰</button>
          </form>
        </div>
      </div>

      <!-- DELIVERY TRACKING -->
      <div class="tracking-section">
        <div class="section-header"><span>Live Updates</span><h2>Recent Deliveries</h2></div>
        <div class="tracking-grid" id="trackingGrid"></div>
      </div>

      <!-- FAQ SECTION -->
      <div class="faq-section">
        <div class="section-header"><span>FAQ</span><h2>Frequently Asked Questions</h2></div>
        <div class="faq-list">
          <div class="faq-item">
            <div class="faq-q" onclick="this.parentElement.classList.toggle('open')"><span>How far in advance should I order a custom cake?</span><i class="fas fa-chevron-down"></i></div>
            <div class="faq-a">We recommend placing custom cake orders at least 3–5 days in advance. For Wedding Cakes, please reach out at least 2 weeks ahead to ensure the best result.</div>
          </div>
          <div class="faq-item">
            <div class="faq-q" onclick="this.parentElement.classList.toggle('open')"><span>Which areas do you deliver to?</span><i class="fas fa-chevron-down"></i></div>
            <div class="faq-a">We currently deliver across Rawalpindi, Islamabad, and Lahore. Check out our current delivery statuses above for real-time updates.</div>
          </div>
          <div class="faq-item">
            <div class="faq-q" onclick="this.parentElement.classList.toggle('open')"><span>What payment methods do you accept?</span><i class="fas fa-chevron-down"></i></div>
            <div class="faq-a">We accept Credit Card payments and Cash on Delivery. Choose your preferred method when placing your order.</div>
          </div>
          <div class="faq-item">
            <div class="faq-q" onclick="this.parentElement.classList.toggle('open')"><span>Can I customise the message and colour theme?</span><i class="fas fa-chevron-down"></i></div>
            <div class="faq-a">Absolutely! You can specify a custom message on the cake, your preferred theme colour, and any special instructions in the order form above.</div>
          </div>
          <div class="faq-item">
            <div class="faq-q" onclick="this.parentElement.classList.toggle('open')"><span>What cake sizes and flavours are available?</span><i class="fas fa-chevron-down"></i></div>
            <div class="faq-a">We offer 2 Pound, 3 Pound, and 4 Pound sizes across Chocolate, Vanilla, Coffee, Red Velvet, and Vanilla &amp; Lotus flavours. Custom Cakes start at 4 Pound.</div>
          </div>
          <div class="faq-item">
            <div class="faq-q" onclick="this.parentElement.classList.toggle('open')"><span>How do I apply a discount code?</span><i class="fas fa-chevron-down"></i></div>
            <div class="faq-a">Add your items to the basket and you'll see a discount field at checkout. Enter your code from the Offers page and the discount applies automatically.</div>
          </div>
        </div>
      </div>
    </div>


    <!-- ─── 7. STORE ADMIN VIEW (store.html) ─── -->
    <div id="view-store" class="spa-view">
      <!-- Header -->
      <div class="store-header-panel">
        <h1 style="font-size: 24px; color: var(--deep, #3d2817); margin: 0; font-family:'Playfair Display',serif;">🍰 E-Commerce Store Control</h1>
        <p style="font-size: 13px; color: var(--muted)">Manage inventory, view metrics, and place mock client orders.</p>
      </div>

      <!-- Tab Navigation -->
      <div class="store-tabs">
        <button class="store-tab active" data-tab="marketplace" onclick="switchStoreTab('marketplace')">🛒 Marketplace</button>
        <button class="store-tab" data-tab="dashboard" onclick="switchStoreTab('dashboard')">📊 Dashboard</button>
        <button class="store-tab" data-tab="inventory" onclick="switchStoreTab('inventory')">📦 Manage Inventory</button>
      </div>

      <!-- Content Area -->
      <div class="store-content">
        
        <!-- Marketplace Tab -->
        <div id="store-tab-marketplace" class="store-tab-pane active">
          <h2 style="margin-bottom: 20px; color: var(--deep, #3d2817); font-family:'Playfair Display',serif;">Browse Our Products</h2>
          <div id="storeProductGrid" class="products-grid"></div>
        </div>

        <!-- Dashboard Tab -->
        <div id="store-tab-dashboard" class="store-tab-pane">
          <h2 style="margin-bottom: 20px; color: var(--deep, #3d2817); font-family:'Playfair Display',serif;">Store Analytics</h2>
          <div class="metrics-grid" id="storeMetricsContainer"></div>
        </div>

        <!-- Inventory Tab -->
        <div id="store-tab-inventory" class="store-tab-pane">
          <h2 style="margin-bottom: 20px; color: var(--deep, #3d2817); font-family:'Playfair Display',serif;">Inventory Management</h2>
          <div class="inventory-container">
            <!-- Form Panel -->
            <div class="form-panel">
              <h3 style="font-size: 16px; margin-bottom: 14px; color: var(--deep, #3d2817); font-family:'Playfair Display',serif;" id="invFormTitle">Add New Product</h3>
              <form id="productForm" onsubmit="submitProductForm(event)">
                <div class="form-group">
                  <label class="form-label">Product Name *</label>
                  <input type="text" name="name" class="form-input" placeholder="e.g., Chocolate Cake" required id="invName">
                </div>
                <div class="form-group">
                  <label class="form-label">Price (Rs) *</label>
                  <input type="number" name="price" class="form-input" placeholder="2500" step="0.01" required id="invPrice">
                </div>
                <div class="form-group">
                  <label class="form-label">Category</label>
                  <input type="text" name="category" class="form-input" placeholder="e.g., Birthday Cakes" id="invCategory">
                </div>
                <div class="form-group">
                  <label class="form-label">Image URL</label>
                  <input type="url" name="image_url" class="form-input" placeholder="https://..." id="invImgUrl">
                </div>
                <div class="form-group">
                  <label class="form-label">Description</label>
                  <textarea name="description" class="form-textarea" placeholder="Product details..." id="invDesc"></textarea>
                </div>
                <input type="hidden" name="id" id="invId">
                <div class="form-buttons">
                  <button type="submit" class="btn-save">Save Product</button>
                  <button type="button" class="btn-reset" onclick="resetInventoryForm()">Reset</button>
                </div>
              </form>
            </div>

            <!-- Table Panel -->
            <div class="table-panel">
              <table class="inventory-table">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody id="inventoryTableBody"></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>

  <!-- GLOBAL FOOTER -->
  <footer>
    <div class="footer-grid">
      <div class="footer-brand">
        <a href="#" data-target="home" class="footer-logo">Sweet<br>Delights</a>
        <p>Crafting joy one bake at a time. Freshly made cakes for Birthday, Wedding, Anniversary, and Custom occasions — delivered across Rawalpindi &amp; Islamabad.</p>
        <div class="footer-socials">
          <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
          <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="social-link"><i class="fab fa-tiktok"></i></a>
          <a href="#" class="social-link"><i class="fab fa-pinterest-p"></i></a>
        </div>
      </div>
      <div class="footer-col">
        <h4>Navigate</h4>
        <ul>
          <li><a href="#home" data-target="home">Home</a></li>
          <li><a href="#menu" data-target="menu">Menu</a></li>
          <li><a href="#offers" data-target="offers">Offers</a></li>
          <li><a href="#about" data-target="about">About</a></li>
          <li><a href="#gallery" data-target="gallery">Gallery</a></li>
          <li><a href="#contact" data-target="contact">Contact</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Categories</h4>
        <ul>
          <li><a href="#menu" onclick="navigateToCategory(1)">Birthday Cakes</a></li>
          <li><a href="#menu" onclick="navigateToCategory(2)">Wedding Cakes</a></li>
          <li><a href="#menu" onclick="navigateToCategory(3)">Anniversary Cakes</a></li>
          <li><a href="#menu" onclick="navigateToCategory(4)">Custom Cakes</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Info</h4>
        <ul>
          <li><a href="#contact" data-target="contact">Contact Us</a></li>
          <li><a href="#about" data-target="about">Our Story</a></li>
          <li><a href="#offers" data-target="offers">Offers</a></li>
          <li><a href="#contact" data-target="contact">FAQs</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <p>© 2026 Sweet Delights Bakery. All rights reserved.</p>
      <p>Made with ❤️ &amp; flour</p>
    </div>
  </footer>

  <!-- GLOBAL CART SIDEBAR -->
  <div class="cart-overlay" id="cartOverlay" onclick="toggleCart()"></div>
  <div class="cart-sidebar" id="cartSidebar">
    <div class="cart-header">
      <h3>Your Basket 🧺</h3>
      <button class="close-cart" onclick="toggleCart()"><i class="fas fa-times"></i></button>
    </div>
    <div class="cart-items" id="cartItems"></div>
    <div class="cart-footer" id="cartFooter" style="display:none">
      <div class="cart-total"><span>Total</span><span id="cartTotal">Rs 0</span></div>
      <button class="btn-submit" onclick="openCheckoutModal()">Proceed to Checkout 🛍️</button>
    </div>
  </div>

  <!-- CHECKOUT MODAL -->
  <div id="checkoutModal" class="modal-backdrop">
    <div class="modal-box">
      <h2 class="modal-title">Checkout Details</h2>
      <form id="checkoutForm" onsubmit="submitCheckoutOrder(event)">
        <div class="modal-field">
          <label class="modal-label">Full Name *</label>
          <input type="text" id="orderName" class="modal-input" placeholder="Your full name" required>
        </div>
        <div class="modal-field">
          <label class="modal-label">Email Address *</label>
          <input type="email" id="orderEmail" class="modal-input" placeholder="your@email.com" required>
        </div>
        <div class="modal-field">
          <label class="modal-label">Delivery Address *</label>
          <input type="text" id="orderAddress" class="modal-input" placeholder="Enter full delivery address" required>
        </div>
        <div class="modal-field">
          <label class="modal-label">Items in Basket</label>
          <div id="basketSummary" class="basket-items"></div>
        </div>
        <div id="totalDisplay" class="order-total">Total: Rs 0</div>
        <div class="modal-buttons">
          <button type="submit" class="btn-submit">Place Order</button>
          <button type="button" class="btn-cancel" onclick="closeCheckoutModal()">Cancel</button>
        </div>
      </form>
    </div>
  </div>

  <!-- TOAST NOTIFICATION CONTAINER -->
  <div class="toast" id="toast"></div>

  <!-- ══════════════════════════════════════════
     INLINE CUSTOM JAVASCRIPT & MECHANICS
     ══════════════════════════════════════════ -->
  <script>
    /* ── MOCK DATASETS ── */
    const CATEGORIES = [
      { id:1, name:'Birthday Cakes' },
      { id:2, name:'Wedding Cakes' },
      { id:3, name:'Anniversary Cakes' },
      { id:4, name:'Custom Cakes' },
    ];

    const REVIEWS = [
      { id:1, customer:'Ali Khan',   rating:5, text:'Excellent taste and presentation! The chocolate cake was absolutely perfect for our event.', date:'4 June 2026',  cakeId:1 },
      { id:2, customer:'Sara Ahmed', rating:4, text:'Beautiful cake, delivery was on time. The Milky Malt exceeded all expectations.', date:'5 June 2026',  cakeId:2 },
      { id:3, customer:'Alina Noor', rating:5, text:'Highly recommended. The Dubai Dreamcake was a show-stopper at our gathering!', date:'6 June 2026',  cakeId:3 },
    ];

    const GALLERY = [
      { id:1,  tag:'birthday',     label:'Chocolate Cake',        img:'https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=600&auto=format&fit=crop' },
      { id:2,  tag:'wedding',      label:'Elegant Wedding Tier',  img:'https://images.unsplash.com/photo-1464349153735-7db50ed83c84?w=400&auto=format&fit=crop' },
      { id:3,  tag:'birthday',     label:'Dubai Dreamcake',       img:'https://images.unsplash.com/photo-1621303837174-89787a7d4729?w=400&auto=format&fit=crop' },
      { id:4,  tag:'custom',       label:'Custom Red Velvet',     img:'https://images.unsplash.com/photo-1586444248902-2f64eddc13df?w=400&auto=format&fit=crop' },
      { id:5,  tag:'anniversary',  label:'Lotus Three Milk Cake', img:'https://images.unsplash.com/photo-1563729784474-d77dbb933a9e?w=400&auto=format&fit=crop' },
      { id:6,  tag:'birthday',     label:'German Fudge Cake',     img:'https://images.unsplash.com/photo-1571877227200-a0d98ea607e9?w=400&auto=format&fit=crop' },
      { id:7,  tag:'custom',       label:'Custom Coffee Cake',    img:'https://images.unsplash.com/photo-1571115177098-24ec42ed204d?w=500&auto=format&fit=crop' },
      { id:8,  tag:'wedding',      label:'Milky Malt Wedding',    img:'https://images.unsplash.com/photo-1565958011703-44f9829ba187?w=400&auto=format&fit=crop' },
      { id:9,  tag:'anniversary',  label:'Vanilla Anniversary',   img:'https://images.unsplash.com/photo-1509365465985-25d11c17e812?w=500&auto=format&fit=crop' },
      { id:10, tag:'behind',       label:'Our Baking Kitchen',    img:'https://images.unsplash.com/photo-1486427944299-d1955d23e34d?w=400&auto=format&fit=crop' },
    ];

    const PROMOTIONS = [
      { id:1, code:'BDAY20',   title:'Birthday Special 🎂',   desc:'20% off all Birthday Cakes when ordered 3 days ahead.',        validity:'Year-round',        gradient:'linear-gradient(135deg,#e8957a,#c0614a)' },
      { id:2, code:'WEDDING15',title:'Wedding Bliss 💍',       desc:'15% off Wedding Cakes for bookings made a week in advance.',   validity:'Ongoing',           gradient:'linear-gradient(135deg,#a0522d,#c0614a)' },
      { id:3, code:'ANNIV10',  title:'Anniversary Love 💕',   desc:'10% off Anniversary Cakes — celebrate your milestones.',       validity:'Year-round',        gradient:'linear-gradient(135deg,#b56a5a,#d4896e)' },
      { id:4, code:'CUSTOM5',  title:'Custom Creations ✨',    desc:'Rs 500 off any Custom Cake order over Rs 5,000.',              validity:'Every month',       gradient:'linear-gradient(135deg,#8b4a3a,#b56a5a)' },
      { id:5, code:'REFER500', title:'Refer a Friend',         desc:'You and your friend each get Rs 500 off your next order.',     validity:'Ongoing',           gradient:'linear-gradient(135deg,#c07860,#e8957a)' },
      { id:6, code:'LOYAL5TH', title:'Loyalty Reward 🌟',      desc:'Your 5th order gets 15% off automatically — our treat!',      validity:'Every 5th order',   gradient:'linear-gradient(135deg,#7a3d2e,#a05040)' },
    ];

    const TEAM = [
      { id:1, emoji:'👩‍🍳', role:'Founder & Head Baker',  name:'Farah Noor',   bio:'10+ years of baking artistry. Farah started Sweet Delights in her home kitchen.' },
      { id:2, emoji:'👨‍🍳', role:'Pastry Chef',           name:'Ahmed Raza',   bio:'Specialises in fondant artistry and layered cakes for grand occasions.' },
      { id:3, emoji:'👩‍🎨', role:'Cake Decorator',        name:'Alina Noor',   bio:'An artist at heart — Alina transforms every cake into an edible masterpiece.' },
      { id:4, emoji:'👨‍💼', role:'Delivery Manager',      name:'Bilal Khan',   bio:'Ensures every cake reaches you on time and in perfect condition.' },
    ];

    /* ── STATE VARIABLES ── */
    let PRODUCTS = [];
    let cart = JSON.parse(localStorage.getItem('sd_cart') || '[]');

    /* ── TOAST NOTIFICATION ── */
    let toastTimer;
    function showToast(msg) {
      const t = document.getElementById('toast');
      if (!t) return;
      t.textContent = msg;
      t.classList.add('show');
      clearTimeout(toastTimer);
      toastTimer = setTimeout(() => t.classList.remove('show'), 3000);
    }

    /* ── MOBILE MENU ── */
    function toggleMobileMenu() {
      document.getElementById('mobileMenu').classList.toggle('open');
    }

    /* ── API CALL: LOAD PRODUCTS ── */
    async function loadProducts() {
      try {
        const res = await fetch('api.php?action=READ_PRODUCTS');
        if (!res.ok) throw new Error('Network response not ok');
        const data = await res.json();
        
        if (data.success) {
          PRODUCTS = data.products || [];
          document.dispatchEvent(new Event('productsLoaded'));
          renderDynamicContents();
        } else {
          showToast('Failed to retrieve catalog');
        }
      } catch (err) {
        console.error('Error loading products:', err);
        showToast('Database connection offline');
      }
    }

    /* ── RENDER DYNAMIC CATALOG CONTENT ── */
    function renderDynamicContents() {
      // 1. Home Favourites Grid (guarded slice/filter)
      const picks = PRODUCTS.length >= 3 ? PRODUCTS.slice(0, 3) : PRODUCTS;
      const homePicksEl = document.getElementById('homePicks');
      if (homePicksEl) {
        homePicksEl.innerHTML = picks.length 
          ? picks.map(buildProductCardHTML).join('') 
          : '<p class="no-results">No featured products found.</p>';
      }

      // 2. Full Menu View Default
      filterMenu(0);

      // 3. Offers Featured Cakes
      const featured = PRODUCTS.length >= 4 ? PRODUCTS.slice(0, 4) : PRODUCTS;
      const featuredGridEl = document.getElementById('featuredGrid');
      if (featuredGridEl) {
        featuredGridEl.innerHTML = featured.length
          ? featured.map(buildProductCardHTML).join('')
          : '<p class="no-results">No featured products available.</p>';
      }

      // 4. E-Commerce Store Marketplace Tab
      renderStoreMarketplace();

      // 5. Update Menu stats counts
      const statsTotalProductsEl = document.getElementById('stats-total-products');
      if (statsTotalProductsEl) {
        statsTotalProductsEl.textContent = PRODUCTS.length;
      }
    }

    // Helper: Build standard card HTML
    function buildProductCardHTML(p) {
      return `
        <div class="product-card">
          <img src="${p.img || 'https://via.placeholder.com/250x200?text=Sweet+Delights'}" alt="${p.name}" onerror="this.src='https://via.placeholder.com/250x200?text=Sweet+Delights'" loading="lazy"/>
          <div class="product-info">
            <div class="product-category">${p.category || 'Cake'}</div>
            <div class="product-name">${p.name}</div>
            <div class="product-flavor"><i class="fas fa-star-of-life"></i> ${p.flavor || 'Signature'} &nbsp;|&nbsp; ${p.size || 'Fresh Made'}</div>
            <div class="product-desc">${p.desc || 'Handcrafted daily using the finest ingredients.'}</div>
            <div class="product-footer">
              <span class="product-price">Rs ${parseFloat(p.price).toLocaleString()}</span>
              <button class="btn-card" onclick="addToCart(${p.id})">Add to Basket</button>
            </div>
          </div>
        </div>`;
    }

    /* ── 1. INLINE ROUTER ── */
    const views = ['home', 'menu', 'offers', 'about', 'gallery', 'contact', 'store'];

    function switchView(viewName) {
      if (!views.includes(viewName)) {
        viewName = 'home';
      }

      // Update UI active pane
      document.querySelectorAll('.spa-view').forEach(v => {
        v.classList.remove('active');
      });
      const targetPane = document.getElementById('view-' + viewName);
      if (targetPane) {
        targetPane.classList.add('active');
      }

      // Update navbar links
      document.querySelectorAll('.nav-links a').forEach(a => {
        a.classList.remove('active');
        if (a.getAttribute('data-target') === viewName) {
          a.classList.add('active');
        }
      });

      // Update mobile menu drawer
      document.querySelectorAll('.mobile-menu a').forEach(a => {
        a.classList.remove('active');
        if (a.getAttribute('data-target') === viewName) {
          a.classList.add('active');
        }
      });

      // Close mobile menu drawer if open
      document.getElementById('mobileMenu').classList.remove('open');

      // Scroll smoothly to top
      window.scrollTo({ top: 0, behavior: 'smooth' });

      // Run route specific initializations
      if (viewName === 'store') {
        const activeTabBtn = document.querySelector('.store-tab.active');
        const tabName = activeTabBtn ? activeTabBtn.dataset.tab : 'marketplace';
        switchStoreTab(tabName);
      } else if (viewName === 'about') {
        loadAboutStats();
      } else if (viewName === 'contact') {
        loadRecentDeliveries();
      }
    }

    window.addEventListener('hashchange', () => {
      const view = window.location.hash.replace('#', '');
      switchView(view);
    });

    /* ── MENU CATEGORY FILTER ── */
    function filterMenu(catId, btn) {
      if (btn) {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
      }
      const grid = document.getElementById('menuGrid');
      if (!grid) return;

      const list = catId === 0 ? PRODUCTS : PRODUCTS.filter(p => p.categoryId === catId);
      grid.innerHTML = list.length
        ? list.map(buildProductCardHTML).join('')
        : '<p class="no-results">No cakes found in this category.</p>';
    }

    function navigateToCategory(catId) {
      window.location.hash = '#menu';
      // Give DOM time to update view, then filter
      setTimeout(() => {
        const btns = document.querySelectorAll('.filter-bar .filter-btn');
        if (btns && btns[catId]) {
          filterMenu(catId, btns[catId]);
        }
      }, 100);
    }

    /* ── GALLERY METHODS ── */
    function renderGallery(tag) {
      const grid = document.getElementById('galleryGrid');
      if (!grid) return;
      
      const list = tag === 'all' ? GALLERY : GALLERY.filter(g => g.tag === tag);
      grid.innerHTML = list.map(g => `
        <div class="masonry-item" onclick="openLightbox('${g.img}')">
          <img src="${g.img}" alt="${g.label}" loading="lazy"/>
          <div class="masonry-overlay"><span>${g.label}</span></div>
        </div>`).join('');
    }

    function filterGallery(tag, btn) {
      document.querySelectorAll('.gallery-filter button').forEach(b => b.classList.remove('active'));
      if (btn) btn.classList.add('active');
      renderGallery(tag);
    }

    function openLightbox(src) {
      document.getElementById('lightboxImg').src = src;
      document.getElementById('lightbox').classList.add('open');
    }

    function closeLightbox() {
      document.getElementById('lightbox').classList.remove('open');
    }

    /* ── OFFERS COPY CODE ── */
    function copyCode(code, el) {
      navigator.clipboard.writeText(code).then(() => {
        const orig = el.innerHTML;
        el.innerHTML = '✅ Copied!';
        setTimeout(() => el.innerHTML = orig, 1800);
      }).catch(err => {
        console.error('Copy failed:', err);
      });
    }

    /* ── CART OPERATIONS ── */
    function saveCart() {
      localStorage.setItem('sd_cart', JSON.stringify(cart));
    }

    function addToCart(id) {
      const p = PRODUCTS.find(x => x.id === id);
      if (!p) return;
      const existing = cart.find(c => c.id === id);
      if (existing) {
        existing.qty++;
      } else {
        cart.push({
          id: p.id,
          name: p.name,
          price: parseFloat(p.price),
          qty: 1,
          img: p.img || '',
          category: p.category || '',
          flavor: p.flavor || '',
          size: p.size || ''
        });
      }
      saveCart();
      renderCart();
      showToast('🛒 ' + p.name + ' added to basket!');
    }

    function removeFromCart(id) {
      cart = cart.filter(c => c.id !== id);
      saveCart();
      renderCart();
    }

    function changeQty(id, delta) {
      const item = cart.find(c => c.id === id);
      if (!item) return;
      item.qty += delta;
      if (item.qty <= 0) {
        removeFromCart(id);
      } else {
        saveCart();
        renderCart();
      }
    }

    function renderCart() {
      const count = cart.reduce((s, c) => s + c.qty, 0);
      const countEl = document.getElementById('cartCount');
      if (countEl) countEl.textContent = count;

      const container = document.getElementById('cartItems');
      const footer = document.getElementById('cartFooter');
      if (!container) return;

      if (cart.length === 0) {
        container.innerHTML = `<div class="cart-empty"><i class="fas fa-cookie-bite"></i>Your basket is empty.<br><small>Add some delights!</small></div>`;
        if (footer) footer.style.display = 'none';
        return;
      }
      
      if (footer) footer.style.display = 'block';
      container.innerHTML = cart.map(item => `
        <div class="cart-item">
          <img class="cart-item-img" src="${item.img || 'https://via.placeholder.com/64?text=Bakery'}" alt="${item.name}"/>
          <div class="cart-item-info">
            <div class="cart-item-name">${item.name} <small style="font-weight:400;color:var(--muted)">(${item.category})</small></div>
            <div class="cart-item-price">Rs ${(item.price * item.qty).toLocaleString()}</div>
            <div class="qty-controls">
              <button class="qty-btn" onclick="changeQty(${item.id},-1)">−</button>
              <span class="qty-val">${item.qty}</span>
              <button class="qty-btn" onclick="changeQty(${item.id},1)">+</button>
            </div>
          </div>
          <button class="remove-item" onclick="removeFromCart(${item.id})"><i class="fas fa-trash-alt"></i></button>
        </div>`).join('');

      const total = cart.reduce((s, c) => s + c.price * c.qty, 0);
      const totalEl = document.getElementById('cartTotal');
      if (totalEl) totalEl.textContent = 'Rs ' + total.toLocaleString();
    }

    function toggleCart() {
      document.getElementById('cartSidebar').classList.toggle('open');
      document.getElementById('cartOverlay').classList.toggle('open');
    }

    /* ── CHECKOUT MODAL ── */
    function openCheckoutModal() {
      if (cart.length === 0) {
        showToast('Your basket is empty!');
        return;
      }

      const basketSummary = document.getElementById('basketSummary');
      const totalDisplay = document.getElementById('totalDisplay');
      
      basketSummary.innerHTML = cart.map(item => `
        <div class="basket-item">
          <span>${item.name} × ${item.qty}</span>
          <span>Rs ${(item.price * item.qty).toLocaleString()}</span>
        </div>
      `).join('');

      const total = cart.reduce((sum, item) => sum + item.price * item.qty, 0);
      totalDisplay.textContent = 'Total: Rs ' + total.toLocaleString();
      
      // Close sidebar
      document.getElementById('cartSidebar').classList.remove('open');
      document.getElementById('cartOverlay').classList.remove('open');
      
      // Show checkout modal
      document.getElementById('checkoutModal').classList.add('show');
    }

    function closeCheckoutModal() {
      document.getElementById('checkoutModal').classList.remove('show');
    }

    async function submitCheckoutOrder(e) {
      e.preventDefault();
      
      const name = document.getElementById('orderName').value.trim();
      const email = document.getElementById('orderEmail').value.trim();
      const address = document.getElementById('orderAddress').value.trim();
      const total = cart.reduce((sum, item) => sum + item.price * item.qty, 0);

      try {
        const res = await fetch('api.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            action: 'PLACE_ORDER',
            customer_name: name,
            customer_email: email,
            address: address,
            total: total,
            items: cart
          })
        });

        const data = await res.json();
        if (data.success) {
          showToast('✅ Order #' + data.orderId + ' placed successfully!');
          cart = [];
          saveCart();
          renderCart();
          closeCheckoutModal();
          
          // Clear inputs
          document.getElementById('orderName').value = '';
          document.getElementById('orderEmail').value = '';
          document.getElementById('orderAddress').value = '';

          // Refresh states if store view is open
          if (window.location.hash === '#store') {
            loadDashboard();
          }
        } else {
          showToast('Order failed: ' + (data.error || 'Unknown error'));
        }
      } catch (err) {
        console.error('Checkout error:', err);
        showToast('Connection error during checkout');
      }
    }

    /* ── SUBMIT CONTACT FORM ── */
    async function submitContactForm(e) {
      e.preventDefault();
      const form = e.target;
      const formData = new FormData(form);
      formData.append('action', 'SUBMIT_CONTACT');

      try {
        const res = await fetch('api.php', {
          method: 'POST',
          body: formData
        });
        const data = await res.json();
        
        if (data.success) {
          showToast('✅ Message sent — thank you!');
          form.reset();
        } else {
          showToast('⚠️ Send failed: ' + (data.error || 'Error'));
        }
      } catch (err) {
        console.error('Contact submit error:', err);
        showToast('Connection error');
      }
    }

    /* ── CUSTOM ORDER FORM (WHATSAPP REDIRECT + MSG TOAST) ── */
    function submitCustomOrder(e) {
      e.preventDefault();
      
      const name = document.getElementById('custName').value.trim();
      const category = document.getElementById('custCategory').value;
      const flavor = document.getElementById('custFlavor').value;
      const size = document.getElementById('custSize').value;
      const message = document.getElementById('custMsg').value.trim();
      const address = document.getElementById('custAddress').value.trim();
      
      showToast('🎉 Custom order request sent! Connecting to WhatsApp...');
      
      const text = `Hi Sweet Delights Bakery! I would like to place a custom order.\nName: ${name}\nCategory: ${category}\nFlavour: ${flavor}\nSize: ${size}\nMessage on Cake: ${message}\nAddress: ${address}`;
      const url = `https://wa.me/923111234567?text=${encodeURIComponent(text)}`;
      
      setTimeout(() => {
        window.open(url, '_blank');
        e.target.reset();
      }, 1500);
    }

    /* ── DYNAMIC DELIVERY TRACKING ── */
    const RIDERS = ['Ahmed Raza', 'Bilal Khan', 'Muhammad Ali', 'Asim Raza', 'Bilal Abbas', 'Abbas Ali'];
    const STATUSES = [
      { text: '✅ Delivered', class: 'status-delivered' },
      { text: '🚚 In Transit', class: 'status-transit' },
      { text: '⏳ Processing', class: 'status-processing' }
    ];

    async function loadRecentDeliveries() {
      const grid = document.getElementById('trackingGrid');
      if (!grid) return;

      try {
        const res = await fetch('api.php?action=READ_DELIVERIES');
        const data = await res.json();
        
        if (data.success && data.orders && data.orders.length > 0) {
          grid.innerHTML = data.orders.map((o, idx) => {
            // Assign rider and status deterministically based on ID
            const rider = RIDERS[o.id % RIDERS.length];
            let status = STATUSES[2]; // Default: processing
            if (o.id % 3 === 0) status = STATUSES[0]; // Delivered
            else if (o.id % 3 === 1) status = STATUSES[1]; // Transit
            
            const dateObj = new Date(o.created_at);
            const formattedDate = dateObj.toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' });

            return `
              <div class="tracking-card">
                <span class="tracking-status ${status.class}">${status.text}</span>
                <h4>Order #${o.id} — ${o.customer_name}</h4>
                <p>${o.address} &bull; ${formattedDate}</p>
                <p style="font-size:12px;margin-top:6px;color:var(--muted)">Rider: ${rider}</p>
              </div>
            `;
          }).join('');
        } else {
          // Fallback mockup if database is empty
          grid.innerHTML = `
            <div class="tracking-card">
              <span class="tracking-status status-delivered">✅ Delivered</span>
              <h4>Order #1 — Ali Khan</h4>
              <p>Rawalpindi &bull; 2 Jun 2026</p>
              <p style="font-size:12px;margin-top:6px;color:var(--muted)">Rider: Ahmed Raza</p>
            </div>
            <div class="tracking-card">
              <span class="tracking-status status-transit">🚚 In Transit</span>
              <h4>Order #2 — Sara Ahmed</h4>
              <p>Rawalpindi &bull; 5 Jun 2026</p>
              <p style="font-size:12px;margin-top:6px;color:var(--muted)">Rider: Bilal Khan</p>
            </div>
            <div class="tracking-card">
              <span class="tracking-status status-processing">⏳ Processing</span>
              <h4>Order #3 — Alina Noor</h4>
              <p>Islamabad &bull; 8 Jun 2026</p>
              <p style="font-size:12px;margin-top:6px;color:var(--muted)">Rider: Muhammad Ali</p>
            </div>
          `;
        }
      } catch (err) {
        console.error(err);
      }
    }

    /* ── DYNAMIC ABOUT PAGE STATS ── */
    async function loadAboutStats() {
      try {
        const res = await fetch('api.php?action=READ_DASHBOARD');
        const data = await res.json();
        
        if (data.success) {
          document.getElementById('about-stat-products').textContent = data.productCount || 0;
          document.getElementById('about-stat-orders').textContent = data.orderCount || 0;
        }
      } catch (err) {
        console.error(err);
      }
    }

    /* ── E-COMMERCE ADMIN STORE TABS & CRUDS ── */
    function switchStoreTab(tabName) {
      document.querySelectorAll('.store-tab').forEach(t => t.classList.remove('active'));
      document.querySelectorAll('.store-tab-pane').forEach(p => p.classList.remove('active'));

      const activeTabBtn = document.querySelector(`.store-tab[data-tab="${tabName}"]`);
      if (activeTabBtn) activeTabBtn.classList.add('active');

      const targetPane = document.getElementById(`store-tab-${tabName}`);
      if (targetPane) targetPane.classList.add('active');

      if (tabName === 'marketplace') {
        loadMarketplace();
      } else if (tabName === 'dashboard') {
        loadDashboard();
      } else if (tabName === 'inventory') {
        loadInventory();
      }
    }

    // Tab 1: Marketplace
    function loadMarketplace() {
      renderStoreMarketplace();
    }

    function renderStoreMarketplace() {
      const grid = document.getElementById('storeProductGrid');
      if (!grid) return;

      if (!PRODUCTS.length) {
        grid.innerHTML = '<div class="empty-state"><div class="empty-state-icon">🏜️</div><p>No products available yet.</p></div>';
        return;
      }

      grid.innerHTML = PRODUCTS.map(p => `
        <div class="product-card">
          <img src="${p.img || 'https://via.placeholder.com/240x180?text=Sweet+Delights'}" alt="${p.name}" class="product-image" onerror="this.src='https://via.placeholder.com/240x180?text=Sweet+Delights'" loading="lazy">
          <div class="product-info">
            <div class="product-category">${p.category || 'Cake'}</div>
            <div class="product-name">${p.name}</div>
            <div class="product-desc">${p.desc || 'Premium bakery product.'}</div>
            <div class="product-footer">
              <span class="product-price">Rs ${parseFloat(p.price).toLocaleString()}</span>
              <button class="btn-card" onclick="addToCart(${p.id})">Add</button>
            </div>
          </div>
        </div>
      `).join('');
    }

    // Tab 2: Dashboard
    async function loadDashboard() {
      const container = document.getElementById('storeMetricsContainer');
      if (!container) return;

      try {
        const res = await fetch('api.php?action=READ_DASHBOARD');
        const data = await res.json();
        
        if (data.success) {
          container.innerHTML = `
            <div class="metric-card">
              <div class="metric-icon">📦</div>
              <div class="metric-label">Total Products</div>
              <div class="metric-value">${data.productCount || 0}</div>
            </div>
            <div class="metric-card">
              <div class="metric-icon">📋</div>
              <div class="metric-label">Total Orders</div>
              <div class="metric-value">${data.orderCount || 0}</div>
            </div>
            <div class="metric-card">
              <div class="metric-icon">💰</div>
              <div class="metric-label">Gross Revenue</div>
              <div class="metric-value">Rs ${(data.totalRevenue || 0).toLocaleString()}</div>
            </div>
          `;
        } else {
          showToast('Failed to load dashboard metrics');
        }
      } catch (err) {
        console.error(err);
        showToast('Connection error loading dashboard');
      }
    }

    // Tab 3: Inventory Table
    async function loadInventory() {
      const tbody = document.getElementById('inventoryTableBody');
      if (!tbody) return;

      try {
        const res = await fetch('api.php?action=READ_PRODUCTS');
        const data = await res.json();
        
        if (data.success) {
          PRODUCTS = data.products || [];
          renderInventoryTable();
        }
      } catch (err) {
        console.error(err);
        showToast('Failed to load inventory');
      }
    }

    function renderInventoryTable() {
      const tbody = document.getElementById('inventoryTableBody');
      if (!tbody) return;

      if (!PRODUCTS.length) {
        tbody.innerHTML = '<tr><td colspan="5" class="empty-state">No products found.</td></tr>';
        return;
      }

      tbody.innerHTML = PRODUCTS.map(p => `
        <tr>
          <td>#${p.id}</td>
          <td><strong>${p.name}</strong></td>
          <td>Rs ${parseFloat(p.price).toLocaleString()}</td>
          <td>${p.category || '—'}</td>
          <td>
            <button class="btn-edit" onclick="editProduct(${p.id})">Edit</button>
            <button class="btn-delete" onclick="deleteProduct(${p.id})">Delete</button>
          </td>
        </tr>
      `).join('');
    }

    // Reset Inventory Form
    function resetInventoryForm() {
      document.getElementById('productForm').reset();
      document.getElementById('invId').value = '';
      document.getElementById('invFormTitle').textContent = 'Add New Product';
    }

    // Submit product creation/update
    async function submitProductForm(e) {
      e.preventDefault();
      const form = e.target;
      const id = document.getElementById('invId').value;
      const action = id ? 'UPDATE_PRODUCT' : 'CREATE_PRODUCT';

      const formData = new FormData(form);
      formData.append('action', action);

      try {
        const res = await fetch('api.php', {
          method: 'POST',
          body: formData
        });
        const data = await res.json();
        
        if (data.success) {
          showToast(id ? '✅ Product updated!' : '✅ Product created!');
          resetInventoryForm();
          loadInventory();
          loadProducts(); // Sync catalog
        } else {
          showToast('⚠️ Save failed: ' + (data.error || 'Error'));
        }
      } catch (err) {
        console.error(err);
        showToast('Connection error saving product');
      }
    }

    // Edit Product in Inventory
    function editProduct(id) {
      const product = PRODUCTS.find(p => p.id === id);
      if (!product) return;

      document.getElementById('invName').value = product.name;
      document.getElementById('invPrice').value = product.price;
      document.getElementById('invCategory').value = product.category || '';
      document.getElementById('invImgUrl').value = product.img || '';
      document.getElementById('invDesc').value = product.desc || '';
      document.getElementById('invId').value = product.id;
      
      document.getElementById('invFormTitle').textContent = 'Edit Product #' + product.id;
      document.getElementById('invName').focus();
    }

    // Delete Product
    async function deleteProduct(id) {
      if (!confirm('Are you sure you want to delete this product?')) return;

      try {
        const res = await fetch(`api.php?action=DELETE_PRODUCT&id=${id}`, {
          method: 'POST'
        });
        const data = await res.json();
        
        if (data.success) {
          showToast('✅ Product deleted');
          loadInventory();
          loadProducts(); // Sync catalog
        } else {
          showToast('⚠️ Delete failed');
        }
      } catch (err) {
        console.error(err);
        showToast('Connection error deleting product');
      }
    }

    /* ── INITIAL PAGE LOAD AND ROUTING SETUP ── */
    document.addEventListener('DOMContentLoaded', () => {
      // 1. Initial Router Binding
      const defaultView = window.location.hash.replace('#', '') || 'home';
      switchView(defaultView);

      // 2. Click handlers on data-targets
      document.querySelectorAll('[data-target]').forEach(a => {
        a.addEventListener('click', (e) => {
          e.preventDefault();
          const target = a.getAttribute('data-target');
          window.location.hash = '#' + target;
        });
      });

      // 3. Load product catalog from database
      loadProducts();

      // 4. Initial promotions rendering
      const promoGrid = document.getElementById('promoGrid');
      if (promoGrid) {
        promoGrid.innerHTML = PROMOTIONS.map(p => `
          <div class="promo-card" style="background:${p.gradient}">
            <h3>${p.title}</h3>
            <p>${p.desc}</p>
            <div class="promo-badge" onclick="copyCode('${p.code}',this)">Code: ${p.code} &nbsp;<i class="fas fa-copy" style="font-size:12px"></i></div>
            <p class="promo-validity">⏳ ${p.validity}</p>
          </div>`).join('');
      }

      // 5. Initial team rendering
      const teamGrid = document.getElementById('teamGrid');
      if (teamGrid) {
        teamGrid.innerHTML = TEAM.map(m => `
          <div class="team-card">
            <div class="team-avatar">${m.emoji}</div>
            <div class="team-card-info">
              <div class="role">${m.role}</div>
              <h4>${m.name}</h4>
              <p>${m.bio}</p>
            </div>
          </div>`).join('');
      }

      // 6. Initial review grids
      const reviewsGrid = document.getElementById('reviewsGrid');
      if (reviewsGrid) {
        reviewsGrid.innerHTML = REVIEWS.map(r => `
          <div class="testimonial-card">
            <div class="stars">${'★'.repeat(r.rating)}${'☆'.repeat(5-r.rating)}</div>
            <p>"${r.text}"</p>
            <div class="reviewer">
              <div class="reviewer-avatar">${r.customer[0]}</div>
              <div><div class="reviewer-name">${r.customer}</div><div class="reviewer-date">${r.date}</div></div>
            </div>
          </div>`).join('');
      }
      
      const homeReviews = document.getElementById('homeReviews');
      if (homeReviews) {
        homeReviews.innerHTML = REVIEWS.map(r => `
          <div class="testimonial-card">
            <div class="stars">${'★'.repeat(r.rating)}${'☆'.repeat(5-r.rating)}</div>
            <p>"${r.text}"</p>
            <div class="reviewer">
              <div class="reviewer-avatar">${r.customer[0]}</div>
              <div><div class="reviewer-name">${r.customer}</div><div class="reviewer-date">${r.date}</div></div>
            </div>
          </div>`).join('');
      }

      // 7. Initial gallery rendering
      renderGallery('all');

      // 8. Render cart from storage
      renderCart();
    });
  </script>
</body>
</html>
