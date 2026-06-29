@extends('layouts.app')
@section('content')
<style>
    .hero-banner {
        position: relative;
        overflow: hidden;
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.12);
        transition: transform 0.3s ease;
        margin-top: 30px;
    }

    .hero-banner:hover {
        transform: translateY(-5px);
    }

    .hero-banner img {
        width: 100%;
        height: 420px;
        object-fit: cover;
        display: block;
        transition: transform 0.6s ease;
    }

    .hero-banner:hover img {
        transform: scale(1.03);
    }

    .hero-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 40px 50px;
        background: linear-gradient(to top, rgba(0,0,0,0.6) 0%, transparent 100%);
        border-radius: 0 0 24px 24px;
    }

    .hero-overlay h1 {
        color: #fff;
        font-size: 2.8rem;
        font-weight: 700;
        text-shadow: 0 2px 20px rgba(0,0,0,0.3);
        margin-bottom: 10px;
    }

    .hero-overlay p {
        color: rgba(255,255,255,0.9);
        font-size: 1.2rem;
        text-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }

    .section-header {
        text-align: center;
        margin: 50px 0 30px;
        position: relative;
    }

    .section-header h2 {
        font-size: 2.2rem;
        font-weight: 700;
        color: #2d3748;
        display: inline-block;
        position: relative;
    }

    .section-header h2::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 4px;
    }

    .section-header p {
        color: #718096;
        margin-top: 20px;
        font-size: 1.1rem;
    }

    .product-card {
        border: none;
        border-radius: 20px;
        padding: 30px 20px;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        background: #ffffff;
        box-shadow: 0 10px 30px rgba(0,0,0,0.06);
        height: 100%;
        position: relative;
        overflow: hidden;
        cursor: default;
    }

    .product-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        transform: scaleX(0);
        transition: transform 0.4s ease;
        transform-origin: left;
    }

    .product-card:hover::before {
        transform: scaleX(1);
    }

    .product-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 25px 60px rgba(102, 126, 234, 0.2);
    }

    .product-card .icon-wrapper {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        background: linear-gradient(135deg, #f0f4ff 0%, #e8eeff 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: #667eea;
        transition: all 0.4s ease;
    }

    .product-card:hover .icon-wrapper {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        transform: scale(1.1) rotate(-5deg);
    }

    .product-card .card-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 10px;
    }

    .product-card .card-text {
        color: #718096;
        font-size: 0.95rem;
        margin-bottom: 15px;
        line-height: 1.6;
    }

    .product-card .btn-explore {
        background: transparent;
        border: 2px solid #667eea;
        color: #667eea;
        padding: 8px 28px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .product-card .btn-explore:hover {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        border-color: transparent;
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
    }

    .product-card.snack .icon-wrapper { color: #f6ad55; }
    .product-card.snack:hover .icon-wrapper { background: linear-gradient(135deg, #f6ad55 0%, #ed8936 100%); }

    .product-card.drink .icon-wrapper { color: #4299e1; }
    .product-card.drink:hover .icon-wrapper { background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%); }

    .product-card.food .icon-wrapper { color: #48bb78; }
    .product-card.food:hover .icon-wrapper { background: linear-gradient(135deg, #48bb78 0%, #38a169 100%); }

    /* ===== BADGE / LABEL ===== */
    .product-card .badge-count {
        position: absolute;
        top: 15px;
        right: 15px;
        background: #edf2f7;
        color: #4a5568;
        padding: 4px 14px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
    }
</style>

<div class="container">
    <div class="hero-banner">
        <img src="{{ secure_asset('images/klontong-banner.jpg') }}" alt="PrimaKlontong - Toko Kelontong Terpercaya">
        {{-- <div class="hero-overlay">
            <h1>PrimaKlontong</h1>
            <p>Belanja kebutuhan sehari-hari jadi lebih mudah &amp; menyenangkan</p>
        </div> --}}
    </div>
</div>

<div class="container">
    <div class="section-header">
        <h2>Kategori Produk</h2>
        <p>Temukan berbagai kebutuhan sehari-hari dengan kualitas terbaik</p>
    </div>

    <div class="row g-4 mt-2">
        <!-- Card 1: Snacks -->
        <div class="col-md-4">
            <div class="product-card snack">
                <span class="badge-count">50+ Produk</span>
                <div class="icon-wrapper">
                    <i class="fas fa-cookie-bite"></i>
                </div>
                <h5 class="card-title">Snacks</h5>
                <p class="card-text">Berbagai macam camilan lezat untuk menemani waktu santai Anda</p>
                <a href="/products" class="btn-explore">
                    Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        <!-- Card 2: Minuman -->
        <div class="col-md-4">
            <div class="product-card drink">
                <span class="badge-count">30+ Produk</span>
                <div class="icon-wrapper">
                    <i class="fas fa-glass-water"></i>
                </div>
                <h5 class="card-title">Minuman</h5>
                <p class="card-text">Berbagai macam minuman segar dan menyegarkan untuk segala suasana</p>
                <a href="/products" class="btn-explore">
                    Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        <!-- Card 3: Makanan -->
        <div class="col-md-4">
            <div class="product-card food">
                <span class="badge-count">40+ Produk</span>
                <div class="icon-wrapper">
                    <i class="fas fa-utensils"></i>
                </div>
                <h5 class="card-title">Makanan</h5>
                <p class="card-text">Berbagai macam makanan lezat dan bergizi untuk kebutuhan sehari-hari</p>
                <a href="/products" class="btn-explore">
                    Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <div class="cta-banner" style="
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                border-radius: 20px;
                padding: 40px 50px;
                text-align: center;
                color: #fff;
                box-shadow: 0 20px 50px rgba(102, 126, 234, 0.3);
            ">
                <h3 style="font-size: 1.8rem; font-weight: 700; margin-bottom: 10px;">
                    <i class="fas fa-tags me-2"></i> Promo Spesial!
                </h3>
                <p style="font-size: 1.1rem; opacity: 0.9; margin-bottom: 20px;">
                    Dapatkan diskon hingga 20% untuk pembelian pertama Anda
                </p>
                <a href="/products" class="btn btn-light" style="
                    padding: 12px 40px;
                    border-radius: 50px;
                    font-weight: 700;
                    color: #667eea;
                    background: #fff;
                    text-decoration: none;
                    transition: all 0.3s ease;
                    display: inline-block;
                ">
                    Belanja Sekarang <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@endsection