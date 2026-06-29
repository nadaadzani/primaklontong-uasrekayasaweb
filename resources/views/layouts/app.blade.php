<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','PrimaKlontong')</title>
    <link rel="stylesheet" href="{{ secure_asset('bootstrap-5.3.8-dist/css/bootstrap.min.css') }}">
    <style>
        .navbar-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 10px 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
        }

        .navbar-custom .navbar-brand {
            font-weight: 700;
            font-size: 1.6rem;
            letter-spacing: 1px;
            color: #fff !important;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
            transition: transform 0.3s ease;
        }

        .navbar-custom .navbar-brand:hover {
            transform: scale(1.05);
        }

        .navbar-custom .navbar-brand i {
            margin-right: 8px;
        }

        .navbar-custom .nav-link {
            color: rgba(255,255,255,0.85) !important;
            font-weight: 500;
            padding: 8px 20px !important;
            border-radius: 25px;
            transition: all 0.3s ease;
            position: relative;
        }

        .navbar-custom .nav-link:hover {
            color: #fff !important;
            background: rgba(255,255,255,0.2);
            transform: translateY(-2px);
        }

        .navbar-custom .nav-link::after {
            content: '';
            position: absolute;
            bottom: 5px;
            left: 50%;
            width: 0;
            height: 2px;
            background: #fff;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .navbar-custom .nav-link:hover::after {
            width: 60%;
        }

        .navbar-custom .nav-link.active {
            background: rgba(255,255,255,0.25);
            color: #fff !important;
        }

        /* Navbar Toggler Custom */
        .navbar-custom .navbar-toggler {
            border: 2px solid rgba(255,255,255,0.5);
            padding: 8px 12px;
        }

        .navbar-custom .navbar-toggler:focus {
            box-shadow: 0 0 0 3px rgba(255,255,255,0.3);
        }

        .navbar-custom .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255,255,255,0.9)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .navbar-custom .dropdown-menu {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            margin-top: 10px;
        }

        .navbar-custom .dropdown-item {
            color: #333;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .navbar-custom .dropdown-item:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            transform: translateX(5px);
        }

        .navbar-custom .badge-notif {
            position: relative;
        }

        .navbar-custom .badge-notif .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ff6b6b;
            color: #fff;
            border-radius: 50%;
            padding: 4px 8px;
            font-size: 10px;
            animation: pulse 2s infinite;
        }

        @media (max-width: 991px) {
            .navbar-custom {
                padding: 12px 0;
            }
            
            .navbar-custom .nav-link {
                padding: 12px 20px !important;
                border-radius: 10px;
            }

            .navbar-custom .nav-link::after {
                display: none;
            }

            .navbar-custom .nav-link:hover {
                transform: none;
            }
        }

        .navbar-custom.scrolled {
            background: linear-gradient(135deg, #5a67d8 0%, #6b46a1 100%);
            padding: 10px 0;
            box-shadow: 0 4px 30px rgba(0,0,0,0.2);
        }

        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a href="/" class="navbar-brand">
                <i class="fas fa-store"></i>
                PrimaKlontong
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a href="/products" class="nav-link {{ request()->is('products') ? 'active' : '' }}">
                            <i class="fas fa-box-open me-1"></i> Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
                            <i class="fas fa-user-shield me-1"></i> Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        &copy; 2026 PrimaKlontong. All rights reserved.
    </footer>

    <script src="{{ asset('bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js') }}"></script>
    
    <script>
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-custom');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>