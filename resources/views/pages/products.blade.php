@extends('layouts.app')
@section('title','Products')
@section('content')

<style>
.product-card {
    border: none;
    border-radius: 20px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 5px 20px rgba(0,0,0,0.06);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    height: 100%;
}

.product-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 20px 50px rgba(102,126,234,0.18);
}

.product-card .card-img-top {
    width: 100%;
    height: 220px;
    object-fit: cover;
    transition: transform 0.6s ease;
}

.product-card:hover .card-img-top {
    transform: scale(1.05);
}

.product-card .img-wrapper {
    overflow: hidden;
    position: relative;
}

.product-card .badge-category {
    position: absolute;
    top: 15px;
    left: 15px;
    background: rgba(255,255,255,0.92);
    backdrop-filter: blur(6px);
    padding: 5px 16px;
    border-radius: 50px;
    font-size: 0.7rem;
    font-weight: 600;
    color: #667eea;
    letter-spacing: 0.5px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
}

.product-card .card-body {
    padding: 22px 22px 25px;
}

.product-card .card-title {
    font-size: 1.15rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 8px;
}

.product-card .tech-tag {
    display: inline-block;
    background: #f0f4ff;
    color: #667eea;
    padding: 3px 14px;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 500;
    margin: 8px 0 12px;
}

.product-card .btn-detail {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    border: none;
    padding: 8px 28px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.85rem;
    transition: all 0.3s ease;
}

.product-card .btn-detail:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102,126,234,0.35);
    color: #fff;
}

.empty-state {
    padding: 60px 20px;
    background: #f8fafc;
    border-radius: 24px;
}

.empty-state i {
    font-size: 4rem;
    color: #cbd5e0;
    margin-bottom: 15px;
}

/* ===== PAGINATION ===== */
.pagination .page-link {
    border: none;
    color: #4a5568;
    padding: 8px 18px;
    border-radius: 10px !important;
    margin: 0 4px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.pagination .page-link:hover {
    background: #f0f4ff;
    color: #667eea;
}

.pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    box-shadow: 0 4px 15px rgba(102,126,234,0.3);
}
</style>

<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h2 class="fw-bold" style="color: #2d3748;">
                        <i class="fas fa-box-open me-2" style="color: #667eea;"></i>
                        Produk Kami
                    </h2>
                    <p class="text-muted mb-0">Menampilkan {{ $products->count() }} produk dari total {{ $products->total() }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        @forelse($products as $product)
        <div class="col-md-4 col-sm-6">
            <div class="product-card">
                <div class="img-wrapper">
                    <img class="card-img-top" src="{{ secure_asset('images/' . $product->gambar) }}" alt="{{ $product->nama }}">
                    <span class="badge-category">
                        <i class="fas fa-tag me-1"></i> {{ $product->kategori ?? 'Produk' }}
                    </span>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $product->nama }}</h5>
                    <p class="card-text">{{ $product->deskripsi }}</p>
                    <div class="mt-2">
                        <a href="{{ route('products.detail', $product->id) }}" class="btn btn-detail">
                            Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="empty-state text-center">
                <i class="fas fa-box-open"></i>
                <h4 class="fw-bold text-muted">Belum Ada Produk</h4>
                <p class="text-muted">Mulai tambahkan produk pertama Anda</p>
                <a href="{{ route('products.create') }}" class="btn btn-primary" style="background:linear-gradient(135deg,#667eea,#764ba2);border:none;border-radius:50px;padding:10px 30px;font-weight:600;margin-top:10px;">
                    <i class="fas fa-plus me-1"></i> Tambah Produk
                </a>
            </div>
        </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@endsection