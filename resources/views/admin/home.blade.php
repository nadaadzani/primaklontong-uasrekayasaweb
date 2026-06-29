@extends('admin.template')
@section('content')

<style>
.stat-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: #fff;
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.04);
    transition: all 0.3s ease;
    border-top: 4px solid transparent;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 40px rgba(102,126,234,0.12);
    border-top-color: #667eea;
}

.stat-card .icon {
    width: 45px;
    height: 45px;
    border-radius: 12px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    color: #fff;
    margin-bottom: 10px;
}

.stat-card .icon.purple { background: linear-gradient(135deg, #667eea, #764ba2); }
.stat-card .icon.blue { background: linear-gradient(135deg, #4facfe, #00f2fe); }
.stat-card .icon.green { background: linear-gradient(135deg, #11998e, #38ef7d); }
.stat-card .icon.orange { background: linear-gradient(135deg, #f093fb, #f5576c); }

.stat-card .number {
    font-size: 1.8rem;
    font-weight: 800;
    color: #1a1a2e;
    margin: 0;
}

.stat-card .label {
    color: #a0aec0;
    font-size: 0.85rem;
    margin: 0;
}

.stat-card .change {
    font-size: 0.7rem;
    font-weight: 600;
    padding: 2px 12px;
    border-radius: 50px;
    display: inline-block;
    margin-top: 5px;
}

.stat-card .change.up { background: #d4edda; color: #155724; }
.stat-card .change.down { background: #f8d7da; color: #721c24; }

.activity-list {
    background: #fff;
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.04);
}

.activity-list .item {
    display: flex;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #edf2f7;
}

.activity-list .item:last-child { border-bottom: none; }

.activity-list .item .dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    margin-right: 15px;
    flex-shrink: 0;
}

.activity-list .item .dot.purple { background: #667eea; }
.activity-list .item .dot.green { background: #48bb78; }
.activity-list .item .dot.orange { background: #ed8936; }
.activity-list .item .dot.blue { background: #4299e1; }

.activity-list .item .text { flex: 1; }
.activity-list .item .text strong { color: #1a1a2e; }
.activity-list .item .text small { color: #a0aec0; display: block; }
.activity-list .item .time { color: #a0aec0; font-size: 0.75rem; }
</style>

<div>
    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
        <div>
            <h4 class="fw-bold mb-0" style="color: #1a1a2e;">
                <i class="fas fa-th-large me-2" style="color: #667eea;"></i> Dashboard
            </h4>
            <small class="text-muted">Selamat datang, {{ Auth::user()->name }}</small>
        </div>
        <div>
            <span class="badge" style="background: linear-gradient(135deg, #667eea, #764ba2); padding: 8px 16px;">
                <i class="fas fa-calendar me-1"></i> {{ date('d F Y') }}
            </span>
        </div>
    </div>

    <div class="stat-grid">
        <div class="stat-card">
            <div class="icon purple"><i class="fas fa-users"></i></div>
            <div class="number">{{ $totalUsers ?? 0 }}</div>
            <div class="label">Total Users</div>
            <span class="change up"><i class="fas fa-arrow-up me-1"></i> 12%</span>
        </div>
        <div class="stat-card">
            <div class="icon blue"><i class="fas fa-box"></i></div>
            <div class="number">{{ $totalProducts ?? 0 }}</div>
            <div class="label">Total Products</div>
            <span class="change up"><i class="fas fa-arrow-up me-1"></i> 8%</span>
        </div>
        <div class="stat-card">
            <div class="icon green"><i class="fas fa-shopping-cart"></i></div>
            <div class="number">{{ $totalOrders ?? 0 }}</div>
            <div class="label">Total Orders</div>
            <span class="change up"><i class="fas fa-arrow-up me-1"></i> 5%</span>
        </div>
        <div class="stat-card">
            <div class="icon orange"><i class="fas fa-dollar-sign"></i></div>
            <div class="number">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</div>
            <div class="label">Revenue</div>
            <span class="change down"><i class="fas fa-arrow-down me-1"></i> 2%</span>
        </div>
    </div>

    <!-- Activity & Quick Actions -->
    <div class="row g-3">
        <div class="col-lg-8">
            <div class="activity-list">
                <h6 class="fw-bold mb-3" style="color: #1a1a2e;">
                    <i class="fas fa-clock me-2" style="color: #667eea;"></i> Aktivitas Terbaru
                </h6>
                <div class="item">
                    <span class="dot purple"></span>
                    <div class="text">
                        <strong>User baru mendaftar</strong>
                        <small>Andi Saputra</small>
                    </div>
                    <span class="time">2 jam lalu</span>
                </div>
                <div class="item">
                    <span class="dot green"></span>
                    <div class="text">
                        <strong>Produk ditambahkan</strong>
                        <small>Snack Coklat</small>
                    </div>
                    <span class="time">5 jam lalu</span>
                </div>
                <div class="item">
                    <span class="dot orange"></span>
                    <div class="text">
                        <strong>Pesanan baru</strong>
                        <small>#ORD-2024-001</small>
                    </div>
                    <span class="time">1 hari lalu</span>
                </div>
                <div class="item">
                    <span class="dot blue"></span>
                    <div class="text">
                        <strong>Review produk</strong>
                        <small>Bintang 5 dari Rina</small>
                    </div>
                    <span class="time">2 hari lalu</span>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="activity-list">
                <h6 class="fw-bold mb-3" style="color: #1a1a2e;">
                    <i class="fas fa-bolt me-2" style="color: #667eea;"></i> Quick Actions
                </h6>
                <a href="{{ route('products.create') }}" class="btn w-100 mb-2" style="background: linear-gradient(135deg, #667eea, #764ba2); color: #fff; border-radius: 12px; padding: 12px;">
                    <i class="fas fa-plus me-2"></i> Tambah Produk
                </a>
                <a href="{{ route('admin.users') }}" class="btn w-100 mb-2" style="background: #f8fafc; color: #1a1a2e; border-radius: 12px; padding: 12px; border: 1px solid #edf2f7;">
                    <i class="fas fa-users me-2" style="color: #667eea;"></i> Kelola Users
                </a>
                <a href="{{ route('products.index') }}" class="btn w-100" style="background: #f8fafc; color: #1a1a2e; border-radius: 12px; padding: 12px; border: 1px solid #edf2f7;">
                    <i class="fas fa-box me-2" style="color: #667eea;"></i> Lihat Produk
                </a>
            </div>
        </div>
    </div>
</div>

@endsection