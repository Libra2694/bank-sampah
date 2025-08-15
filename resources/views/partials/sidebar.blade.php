<div class="sidebar bg-dark text-white">
    <div class="position-sticky pt-3">
        <div class="text-center mb-4">
            <h4 class="text-white">Bank Sampah</h4>
        </div>
        
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }} text-white" href="{{ route('dashboard') }}">
                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('sampah*') ? 'active' : '' }} text-white" href="{{ route('sampah.index') }}">
                    <i class="fas fa-trash me-2"></i> Jenis Sampah
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('transaksi*') ? 'active' : '' }} text-white" href="{{ route('transaksi.index') }}">
                    <i class="fas fa-exchange-alt me-2"></i> Transaksi
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('penjemputan*') ? 'active' : '' }} text-white" href="{{ route('penjemputan.index') }}">
                    <i class="fas fa-truck me-2"></i> Penjemputan
                </a>
            </li>
            <li class="nav-item">
                {{-- <a class="nav-link {{ Request::is('nasabah*') ? 'active' : '' }} text-white" href="{{ route('nasabah.index') }}"> --}}
                    <i class="fas fa-users me-2"></i> Data Nasabah
                </a>
            </li>
        </ul>
    </div>
</div>