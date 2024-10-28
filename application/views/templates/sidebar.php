<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="<?= base_url(); ?>">
            <span class="align-middle">Blood Track</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-item <?= $title == 'Dashboard' ? 'active' : '' ?>">
                <a class="sidebar-link" href="<?= base_url(); ?>">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-header">
                Master
            </li>
            <li class="sidebar-item <?= $title == 'User' ? 'active' : '' ?>">
                <a class="sidebar-link" href="<?= base_url('user'); ?>">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">User</span>
                </a>
            </li>
            <li class="sidebar-item <?= $title == 'Kelola Pasien' ? 'active' : '' ?>">
                <a class="sidebar-link" href="<?= base_url('pasien'); ?>">
                    <i class="bi bi-person-vcard"></i> <span class="align-middle">Pasien</span>
                </a>
            </li>
            <li class="sidebar-item <?= $title == 'Kelola Darah' ? 'active' : '' ?>">
                <a class="sidebar-link" href="<?= base_url('darah'); ?>">
                    <i class="bi bi-capsule"></i> <span class="align-middle">Kelola Darah</span>
                </a>
            </li>
            <li class="sidebar-header">
                Transaksi
            </li>
            <li class="sidebar-item <?= $title == 'Penerimaan' ? 'active' : '' ?>">
                <a class="sidebar-link" href="<?= base_url('penerimaan'); ?>">
                    <i class="bi bi-backpack2"></i> <span class="align-middle">Penerimaan</span>
                </a>
            </li>
            <li class="sidebar-item <?= $title == 'Pelayanan' ? 'active' : '' ?>">
                <a class="sidebar-link" href="<?= base_url('pelayanan'); ?>">
                    <i class="bi bi-person-badge"></i> <span class="align-middle">pelayanan</span>
                </a>
            </li>
            <li class="sidebar-item <?= $title == 'Histori Aktivitas' ? 'active' : '' ?>">
                <a class="sidebar-link" href="<?= base_url('histori'); ?>">
                    <i class="bi bi-diagram-3"></i> <span class="align-middle">Histori Aktivitas</span>
                </a>
            </li>
            <li class="sidebar-header">
                Akun
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="<?= base_url('auth/logout'); ?>">
                    <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</nav>