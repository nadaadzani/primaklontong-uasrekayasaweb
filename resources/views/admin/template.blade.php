<!-- resources/views/admin/template.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Admin Template')</title>
    
    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script>
        const API_TOKEN = "{{ session('api_token') }}" || "";
    </script>
    
    <style>
        :root { --primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%); --sidebar: 250px; }
        body { background: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        
        .navbar-custom {
            background: var(--primary);
            padding: 10px 0;
            box-shadow: 0 4px 30px rgba(102,126,234,0.35);
            position: fixed;
            top: 0; left: 0; right: 0; z-index: 1050;
        }
        .navbar-custom .navbar-brand { font-weight: 700; color: #fff !important; }
        .navbar-custom .navbar-brand i { margin-right: 8px; }
        .navbar-custom .nav-link { color: rgba(255,255,255,0.85) !important; border-radius: 25px; padding: 8px 18px !important; }
        .navbar-custom .nav-link:hover { background: rgba(255,255,255,0.2); color: #fff !important; }
        .navbar-custom .dropdown-menu { border: none; border-radius: 16px; box-shadow: 0 15px 50px rgba(0,0,0,0.15); margin-top: 10px; }
        .navbar-custom .dropdown-item:hover { background: var(--primary); color: #fff; }
        .navbar-custom .user-avatar {
            width: 36px; height: 36px; border-radius: 50%;
            background: rgba(255,255,255,0.2);
            display: inline-flex; align-items: center; justify-content: center;
            color: #fff; font-weight: 700; margin-right: 8px;
        }


        .sidebar {
            width: var(--sidebar);
            min-height: 100vh;
            background: #1a1a2e;
            position: fixed;
            top: 60px; left: 0; bottom: 0;
            padding: 20px 0;
            z-index: 1040;
            transition: all 0.3s ease;
        }
        .sidebar .brand { text-align: center; padding: 0 20px 25px; border-bottom: 1px solid rgba(255,255,255,0.06); }
        .sidebar .brand .icon {
            width: 50px; height: 50px;
            background: var(--primary);
            border-radius: 14px;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 1.6rem; color: #fff;
            box-shadow: 0 8px 25px rgba(102,126,234,0.3);
        }
        .sidebar .brand h6 { color: #fff; font-weight: 700; margin: 10px 0 0; }
        .sidebar .brand small { color: rgba(255,255,255,0.4); font-size: 0.7rem; }
        .sidebar .label { color: rgba(255,255,255,0.3); font-size: 0.65rem; text-transform: uppercase; padding: 10px 25px 5px; }
        .sidebar a {
            color: rgba(255,255,255,0.65);
            padding: 12px 25px;
            display: flex; align-items: center;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
            font-size: 0.9rem;
        }
        .sidebar a i { width: 24px; margin-right: 12px; }
        .sidebar a:hover { color: #fff; background: rgba(255,255,255,0.05); border-left-color: #667eea; }
        .sidebar a.active { color: #fff; background: rgba(102,126,234,0.15); border-left-color: #667eea; }
        .sidebar .badge { margin-left: auto; background: var(--primary); color: #fff; font-size: 0.6rem; padding: 2px 10px; border-radius: 50px; }

        .content { margin-left: var(--sidebar); margin-top: 60px; padding: 30px; min-height: calc(100vh - 60px); }
        .page-header {
            background: #fff; border-radius: 16px; padding: 20px 25px;
            display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04); margin-bottom: 25px;
        }
        .page-header h4 { font-weight: 700; color: #1a1a2e; margin: 0; }
        .page-header h4 i { color: #667eea; margin-right: 10px; }

        .card-custom {
            background: #fff; border: none; border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04); overflow: hidden;
        }
        .card-custom .card-header { background: #f8fafc; padding: 15px 20px; font-weight: 600; border-bottom: 1px solid #edf2f7; }
        .card-custom .card-body { padding: 20px; }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid px-4">
            <a href="{{ route('admin.dashboard') }}" class="navbar-brand">
                <i class="fas fa-store"></i> PrimaKlontong
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item"><a href="{{ route('home') }}" class="nav-link"><i class="fas fa-home"></i> Home</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <span class="user-avatar">{{ substr(Auth::user()->name ?? 'A', 0, 1) }}</span>
                            {{ Auth::user()->name ?? 'Admin' }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li class="dropdown-item-text"><strong>{{ Auth::user()->name ?? 'Admin' }}</strong><br><small class="text-muted">{{ Auth::user()->email ?? '' }}</small></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('admin.logout') }}" id="logout-form">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="sidebar">
        <div class="brand">
            <div class="icon"><i class="fas fa-store"></i></div>
            <h6>PrimaKlontong</h6>
            <small>Admin</small>
        </div>
        <div class="label">Menu</div>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-th-large"></i> <span>Dashboard</span>
        </a>
        <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'active' : '' }}">
            <i class="fas fa-box"></i> <span>Products</span> <span class="badge">12</span>
        </a>
        <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">
            <i class="fas fa-users"></i> <span>Users</span> <span class="badge">5</span>
        </a>
        <div class="label mt-3">Lainnya</div>
        <a href="{{ route('home') }}"><i class="fas fa-globe"></i> <span>View Site</span></a>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
        </a>
    </div>
    <div class="content">
        @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @yield('script')
</body>
</html>