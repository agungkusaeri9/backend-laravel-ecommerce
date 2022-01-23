<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ \App\Store::first()->name ?? 'Web Shop' }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link pt-0 collapsed" href="#" data-toggle="collapse" data-target="#masterData"
            aria-expanded="true" aria-controls="masterData">
            <i class="fas fa-fw fa-file"></i>
            <span>Maser Data</span>
        </a>
        <div id="masterData" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.users.index') }}">Data User</a>
                <a class="collapse-item" href="{{ route('admin.store.index') }}">Profil Toko</a>
                <a class="collapse-item" href="{{ route('admin.payments.index') }}">Metode Pembayaran</a>
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
            <i class="fas fa-fw fa-exchange-alt"></i>
            <span>Transaksi</span>
        </a>
        <div id="transaction" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.transactions.index') }}">Transaksi Masuk</a>
            </div>
        </div>
    </li>

     <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
        <a class="nav-link collapsed pt-0" href="#" data-toggle="collapse" data-target="#report"
            aria-expanded="true" aria-controls="report">
            <i class="fas fa-fw fa-file"></i>
            <span>Laporan</span>
        </a>
        <div id="report" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.report.transaction') }}">Transaksi</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link pt-0 collapsed" href="#" data-toggle="collapse" data-target="#trash"
            aria-expanded="true" aria-controls="trash">
            <i class="fas fa-fw fa-trash"></i>
            <span>Tempat Sampah</span>
        </a>
        <div id="trash" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.trash.user.index') }}">User</a>
                <a class="collapse-item" href="{{ route('admin.trash.product.index') }}">Produk</a>
                <a class="collapse-item" href="{{ route('admin.trash.transaction.index') }}">Transaksi</a>
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