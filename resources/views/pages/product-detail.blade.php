@extends('layouts.app')
@section('title', $product->nama)
@section('content')

<style>
.detail-card {
    border: none;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
}

.detail-card .card-img-top {
    width: 100%;
    max-height: 400px;
    object-fit: cover;
}

.detail-card .card-body {
    padding: 30px;
}

.detail-card .product-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: #2d3748;
}

.status-badge {
    padding: 4px 16px;
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 600;
}

.status-badge.aktif { background: #d4edda; color: #155724; }
.status-badge.tidak-aktif { background: #f8d7da; color: #721c24; }
.status-badge.proses { background: #fff3cd; color: #856404; }

.info-item {
    background: #f7fafc;
    border-radius: 12px;
    padding: 12px 16px;
    text-align: center;
}

.info-item .label {
    font-size: 0.7rem;
    color: #a0aec0;
    text-transform: uppercase;
}

.info-item .value {
    font-weight: 700;
    color: #2d3748;
}

.desc-box {
    background: #f7fafc;
    padding: 16px 20px;
    border-radius: 12px;
    border-left: 4px solid #667eea;
}

.btn-back {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: #fff;
    border: none;
    padding: 10px 30px;
    border-radius: 50px;
    font-weight: 600;
    transition: all 0.3s ease;
    width: 100%;
}

.btn-back:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102,126,234,0.3);
    color: #fff;
}

@media (max-width: 768px) {
    .detail-card .card-body { padding: 20px; }
    .detail-card .product-title { font-size: 1.3rem; }
    .detail-card .card-img-top { max-height: 250px; }
}
</style>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <!-- Tombol Kembali -->
            <a href="{{ route('products') }}" class="btn btn-sm btn-outline-secondary mb-3">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>

            <!-- Card Detail -->
            <div class="card detail-card">
                
                <!-- Gambar -->
                @php
                    $imgPath = 'images/' . $product->gambar;
                @endphp
                @if(file_exists(public_path($imgPath)))
                    <img class="card-img-top" src="{{ asset($imgPath) }}" alt="{{ $product->nama }}">
                @else
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="font-size: 3rem; color: #cbd5e0;">
                        <i class="fas fa-image"></i>
                    </div>
                @endif

                <!-- Body -->
                <div class="card-body">
                    
                    <!-- Title & Status -->
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-3">
                        <h1 class="product-title">{{ $product->nama }}</h1>
                        @php
                            $status = strtolower($product->status);
                            $class = in_array($status, ['tidak aktif', 'nonaktif']) ? 'tidak-aktif' : ($status == 'proses' ? 'proses' : 'aktif');
                        @endphp
                        <span class="status-badge {{ $class }}">{{ $product->status }}</span>
                    </div>

                    <!-- Info Grid -->
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <div class="info-item">
                                <div class="label">Stok</div>
                                <div class="value">{{ $product->status ?? '-' }}</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="info-item">
                                <div class="label">Kategori</div>
                                <div class="value">{{ $product->kategori ?? 'UMKM' }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="desc-box mb-3">
                        <strong><i class="fas fa-align-left me-1" style="color:#667eea;"></i> Deskripsi</strong>
                        <p class="mb-0 mt-1">{{ $product->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                    </div>

                    <!-- Tombol -->
                    <a href="{{ route('products') }}" class="btn btn-back">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Produk
                    </a>

                </div>
            </div>

        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@endsection