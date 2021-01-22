<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="sidebar-brand-text mx-3">OLSHOP</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#masterData"
            aria-expanded="true" aria-controls="masterData">
            <i class="fas fa-fw fa-file"></i>
            <span>Maser Data</span>
        </a>
        <div id="masterData" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.users.index') }}">Data User</a>
                <a class="collapse-item" href="{{ route('admin.payments.index') }}">Metode Pembayaran</a>
                <a class="collapse-item" href="{{ route('admin.shipments.index') }}">Jasa Pengantar</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed pt-0" href="#" data-toggle="collapse" data-target="#product"
            aria-expanded="true" aria-controls="product">
            <i class="fas fa-fw fa-file"></i>
            <span>Produk</span>
        </a>
        <div id="product" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.product-categories.index') }}">Kategori Produk</a>
                <a class="collapse-item" href="{{ route('admin.products.index') }}">Data Produk</a>
                <a class="collapse-item" href="{{ route('admin.product-galleries.index') }}">Foto Produk</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed pt-0" href="#" data-toggle="collapse" data-target="#transaction"
            aria-expanded="true" aria-controls="transaction">
            <i class="fas fa-fw fa-file"></i>
            <span>Transaksi</span>
        </a>
        <div id="transaction" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.transactions.index') }}">Transaksi Masuk</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>