<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <button type="button" class="nav-icon dropdown-toggle d-inline-block d-sm-none" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </button>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <span class="text-dark text-capitalize"><?= $this->session->userdata('nama_petugas'); ?> | <?= $this->session->userdata('jabatan'); ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- <button class="dropdown-item" type="button"><i class="align-middle me-1" data-feather="user"></i> Profile</button> -->
                    <!-- <div class="dropdown-divider"></div> -->
                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logout_modal">
                        <i class="align-middle me-1" data-feather="log-in"></i> Log out
                    </button>
                </div>
            </li>
        </ul>
    </div>
</nav>