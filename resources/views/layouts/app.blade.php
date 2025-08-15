<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Bank Sampah</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/icon.png') }}" type="image/png">
    <!-- Custom CSS -->
    <style>
        :root {
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 80px;
            --transition-speed: 0.3s;
        }
        
        body {
            overflow-x: hidden;
        }
        
        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            background: #2c3e50;
            color: white;
            transition: all var(--transition-speed) ease;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        
        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }
        
        .sidebar-header {
            padding: 20px;
            background: #1a252f;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .sidebar-menu {
            padding: 20px 0;
            overflow-y: auto;
            height: calc(100vh - 60px);
        }
        
        .nav-link {
            color: #ecf0f1;
            padding: 12px 20px;
            margin: 5px 10px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            transition: all 0.2s;
        }
        
        .nav-link:hover, .nav-link.active {
            background: #3498db;
            color: white;
            text-decoration: none;
        }
        
        .nav-link i {
            margin-right: 10px;
            font-size: 1.2rem;
            width: 24px;
            text-align: center;
        }
        
        .sidebar.collapsed .nav-link span {
            display: none;
        }
        
        .sidebar.collapsed .nav-link {
            justify-content: center;
            padding: 12px 0;
        }
        
        .sidebar.collapsed .nav-link i {
            margin-right: 0;
            font-size: 1.4rem;
        }
        
        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            transition: all var(--transition-speed) ease;
            min-height: 100vh;
            background: #f8f9fa;
        }
        
        .main-content.collapsed {
            margin-left: var(--sidebar-collapsed-width);
        }
        
        /* Toggle Button */
        .toggle-btn {
            background: transparent;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 5px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: var(--sidebar-collapsed-width);
            }
            
            .sidebar .nav-link span {
                display: none;
            }
            
            .sidebar .nav-link {
                justify-content: center;
                padding: 12px 0;
            }
            
            .sidebar .nav-link i {
                margin-right: 0;
                font-size: 1.4rem;
            }
            
            .main-content {
                margin-left: var(--sidebar-collapsed-width);
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h5 class="mb-0" id="sidebar-title">Bank Sampah</h5>
            <button class="toggle-btn" id="toggleSidebar">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        
        <div class="sidebar-menu">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('sampah*') ? 'active' : '' }}" href="{{ route('sampah.index') }}">
                        <i class="fas fa-trash"></i>
                        <span>Jenis Sampah</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('transaksi*') ? 'active' : '' }}" href="{{ route('transaksi.index') }}">
                        <i class="fas fa-exchange-alt"></i>
                        <span>Transaksi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('penjemputan*') ? 'active' : '' }}" href="{{ route('penjemputan.index') }}">
                        <i class="fas fa-truck"></i>
                        <span>Penjemputan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('nasabah*') ? 'active' : '' }}" href="{{ route('nasabah.index') }}">
                        <i class="fas fa-users"></i>
                        <span>Data Nasabah</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('petugas*') ? 'active' : '' }}" href="{{ route('petugas.index') }}">
                        <i class="fas fa-user-tie"></i>
                        <span>Data Petugas</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Navbar -->
        {{-- <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4"> --}}
        <nav class="navbar navbar-expand-lg navbar-dark mb-4" style="background-color: #5F00FF;">
            <div class="container-fluid">
                <button class="navbar-toggler d-lg-none" type="button" id="mobileToggle">
                    <i class="fas fa-bars"></i>
                </button>
                
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name ?? 'Admin' }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
            {{-- <div class="container-fluid">
                <button class="navbar-toggler d-lg-none" type="button" id="mobileToggle">
                    <i class="fas fa-bars"></i>
                </button>
                
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name ?? 'Admin' }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav> --}}

        <!-- Page Content -->
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const toggleBtn = document.getElementById('toggleSidebar');
            const mobileToggle = document.getElementById('mobileToggle');
            const sidebarTitle = document.getElementById('sidebar-title');
            
            // Toggle sidebar
            function toggleSidebar() {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('collapsed');
                
                // Simpan state di localStorage
                const isCollapsed = sidebar.classList.contains('collapsed');
                localStorage.setItem('sidebarCollapsed', isCollapsed);
                
                // Sembunyikan judul saat collapsed
                if (isCollapsed) {
                    sidebarTitle.style.display = 'none';
                } else {
                    sidebarTitle.style.display = 'block';
                }
            }
            
            // Toggle untuk desktop
            toggleBtn.addEventListener('click', toggleSidebar);
            
            // Toggle untuk mobile
            mobileToggle.addEventListener('click', function() {
                sidebar.classList.toggle('show');
            });
            
            // Cek state sebelumnya
            if (localStorage.getItem('sidebarCollapsed') === 'true') {
                sidebar.classList.add('collapsed');
                mainContent.classList.add('collapsed');
                sidebarTitle.style.display = 'none';
            }
            
            // Responsive behavior
            function handleResize() {
                if (window.innerWidth <= 768) {
                    sidebar.classList.add('collapsed');
                    mainContent.classList.add('collapsed');
                    sidebarTitle.style.display = 'none';
                } else {
                    // Kembalikan ke state sebelumnya untuk desktop
                    if (localStorage.getItem('sidebarCollapsed') === 'true') {
                        sidebar.classList.add('collapsed');
                        mainContent.classList.add('collapsed');
                        sidebarTitle.style.display = 'none';
                    } else {
                        sidebar.classList.remove('collapsed');
                        mainContent.classList.remove('collapsed');
                        sidebarTitle.style.display = 'block';
                    }
                }
            }
            
            // Jalankan saat load dan resize
            window.addEventListener('resize', handleResize);
            handleResize();
        });
    </script>
    
    @stack('scripts')
</body>
</html> 