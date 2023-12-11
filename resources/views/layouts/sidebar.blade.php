<div class="app-sidebar">
    <div class="logo">
        <a href="index.html" class="logo-icon"><span class="logo-text">Neptune</span></a>
        <div class="sidebar-user-switcher user-activity-online">
            <a href="#">
                <img src="{{ asset('assets/images/avatars/avatar.png') }}">
                <span class="activity-indicator"></span>
                <span class="user-info-text">Chloe<br><span class="user-state-info">On a call</span></span>
            </a>
        </div>
    </div>
    <div class="app-menu">
        <ul class="accordion-menu">
            <li class="sidebar-title">
                Master
            </li>
            <li class="{{ request()->routeIs('dashboard') ? 'active-page' : '' }}">
                <a href="{{ route('dashboard') }}"><i class="material-icons-two-tone">speed</i>Dashboard</a>
            </li>
            <li
                class="{{ request()->routeIs('kategori.index', 'kategori.edit', 'kategori.create') ? 'active-page' : '' }}">
                <a href="{{ route('kategori.index') }}"><i class="material-icons-two-tone">category</i>Kategori</a>
            </li>
            <li class="{{ request()->routeIs('produk.index', 'produk.edit', 'produk.create') ? 'active-page' : '' }}">
                <a href="{{ route('produk.index') }}"><i class="material-icons-two-tone">inventory_2</i>Produk</a>
            </li>
            <li>
                <a href="file-manager.html"><i class="material-icons-two-tone">group</i>Member</a>
            </li>
            <li>
                <a href="file-manager.html"><i class="material-icons-two-tone">airport_shuttle</i>Supplier</a>
            </li>

            <li class="sidebar-title">
                Transaksi
            </li>
            <li>
                <a href="file-manager.html"><i class="material-icons-two-tone">payments</i>Pengeluaran</a>
            </li>
            <li>
                <a href="file-manager.html"><i class="material-icons-two-tone">download</i>Pembelian</a>
            </li>
            <li>
                <a href="file-manager.html"><i class="material-icons-two-tone">file_upload</i>Penjualan</a>
            </li>
            <li>
                <a href="file-manager.html"><i class="material-icons-two-tone">shopping_cart</i>Transaksi Lama</a>
            </li>
            <li>
                <a href="file-manager.html"><i class="material-icons-two-tone">add_shopping_cart</i>Transaksi Baru</a>
            </li>

            <li class="sidebar-title">
                Laporan
            </li>
            <li>
                <a href="file-manager.html"><i class="material-icons-two-tone">book</i>Laporan Penjualan</a>
            </li>
            <li class="sidebar-title">
                Pengaturan
            </li>
            <li>
                <a href="file-manager.html"><i class="material-icons-two-tone">person</i>User</a>
            </li>
            <li>
                <a href="file-manager.html"><i class="material-icons-two-tone">settings</i>Setting</a>
            </li>
        </ul>
    </div>
</div>
