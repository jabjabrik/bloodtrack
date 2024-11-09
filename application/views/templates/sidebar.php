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
            <li class="sidebar-item <?= $title == 'Kelola Petugas' ? 'active' : '' ?>">
                <a class="sidebar-link" href="<?= base_url('petugas'); ?>">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Kelola Petugas</span>
                </a>
            </li>
            <li class="sidebar-item <?= $title == 'Kelola Dokter' ? 'active' : '' ?>">
                <a class="sidebar-link" href="<?= base_url('dokter'); ?>">
                    <i class="bi bi-person-badge"></i> <span class="align-middle">Kelola Dokter</span>
                </a>
            </li>
            <li class="sidebar-item <?= $title == 'Kelola Pasien' ? 'active' : '' ?>">
                <a class="sidebar-link" href="<?= base_url('pasien'); ?>">
                    <i class="bi bi-person-vcard"></i> <span class="align-middle">Kelola Pasien</span>
                </a>
            </li>
            <li class="sidebar-item <?= $title == 'Kelola Penerima' ? 'active' : '' ?>">
                <a class="sidebar-link" href="<?= base_url('penerima'); ?>">
                    <i class="bi bi-person-workspace"></i> <span class="align-middle">Kelola Penerima</span>
                </a>
            </li>
            <li class="sidebar-item <?= $title == 'Kelola Darah' ? 'active' : '' ?>">
                <a class="sidebar-link" href="<?= base_url('darah'); ?>">
                    <i class="bi bi-capsule"></i> <span class="align-middle">Kelola Darah</span>
                </a>
            </li>
            <li class="sidebar-item <?= $title == 'Kelola PMI' ? 'active' : '' ?>">
                <a class="sidebar-link" href="<?= base_url('pmi'); ?>">
                    <i class="bi bi-patch-plus"></i> <span class="align-middle">Kelola PMI</span>
                </a>
            </li>
            <li class="sidebar-item <?= $title == 'Kelola Kurir' ? 'active' : '' ?>">
                <a class="sidebar-link" href="<?= base_url('kurir'); ?>">
                    <i class="bi bi-car-front-fill"></i> <span class="align-middle">Kelola Kurir</span>
                </a>
            </li>
            <li class="sidebar-item <?= $title == 'Kelola Ruangan' ? 'active' : '' ?>">
                <a class="sidebar-link" href="<?= base_url('ruangan'); ?>">
                    <i class="bi bi-door-open"></i> <span class="align-middle">Kelola Ruangan</span>
                </a>
            </li>
            <li class="sidebar-header">
                Transaksi
            </li>
            <li class="sidebar-item <?= $title == 'Penerimaan Darah' ? 'active' : '' ?>">
                <a class="sidebar-link" href="<?= base_url('penerimaan'); ?>">
                    <i class="bi bi-backpack2"></i> <span class="align-middle">Penerimaan</span>
                </a>
            </li>
            <li class="sidebar-item <?= $title == 'Informasi Bank Darah' ? 'active' : '' ?>">
                <a class="sidebar-link" href="<?= base_url('bankdarah'); ?>">
                    <i class="bi bi-clipboard-pulse"></i> <span class="align-middle">Bank Darah</span>
                </a>
            </li>
            <li class="sidebar-item <?= $title == 'Pelayanan' ? 'active' : '' ?>">
                <a class="sidebar-link" href="<?= base_url('pelayanan'); ?>">
                    <i class="bi bi-person-badge"></i> <span class="align-middle">Pelayanan</span>
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
                <a class="sidebar-link" data-bs-toggle="modal" data-bs-target="#logout_modal">
                    <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</nav>