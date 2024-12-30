<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>PLN</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="<?= base_url('backend/'); ?>css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="<?= base_url('user/index') ?>">PLN</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i>
                    <span id="username"><?= $user['username']; ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <a class="dropdown-item" href="#!">
                            <i class="fas fa-cog me-2"></i> Settings
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#!">
                            <i class="fas fa-list me-2"></i> Activity Log
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <a class="dropdown-item" href="<?= base_url('auth/logout') ?>">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="<?= base_url('user/index') ?>">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-house"></i></div>
                            Home
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Pelaporan Kerusakan
                            <!-- <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div> -->
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">

                            </nav>
                        </div>
                        <a class="nav-link" href="<?= base_url('user/perbaikan') ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Pelaporan Perbaikan
                        </a>
                        <div class="sb-sidenav-menu-heading">Addons</div>
                        <a class="nav-link" href="<?= base_url('user/pemeliharaan') ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Pelaporan Pemeliharaan
                        </a>
                        <a class="nav-link collapsed" href="<?= base_url('user/report') ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Report pemeliharaan
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Pelaporan Kerusakan</h1>
                    <ol class="breadcrumb mb-4">
                        <!-- <li class="breadcrumb-item active">Form Pelaporan</li> -->
                    </ol>
                    <div class="container mt-5">
                        <div class="container mt-5">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h4><i class="fas fa-file-alt"></i> Form Pelaporan Kerusakan</h4>
                                </div>
                                <div class="card-body">
                                    <!-- Tampilkan pesan sukses/error -->
                                    <?php if ($this->session->flashdata('message')) : ?>
                                        <?= $this->session->flashdata('message'); ?>
                                    <?php endif; ?>

                                    <form action="<?= base_url('user/pelaporan'); ?>" method="POST" enctype="multipart/form-data">
                                        <!-- Kota Lokasi Kejadian -->
                                        <div class="mb-3">
                                            <label for="kota" class="form-label"><i class="fas fa-solid fa-map"></i> Kota/Kabupaten:</label>
                                            <select class="form-control" id="kota" name="kota" required>
                                                <option value="">-- Pilih Kota/Kabupaten --</option>
                                                    <?php foreach ($kota_options as $kota): ?>
                                                        <option value="<?= htmlspecialchars($kota) ?>"><?= htmlspecialchars($kota) ?></option>
                                                    <?php endforeach; ?>
                                            </select>
                                        </div>
                                    
                                        <!-- Alamat Lokasi Kejadian -->
                                        <div class="mb-3">
                                            <label for="alamat" class="form-label"><i class="fas fa-map-marker-alt"></i> Alamat Lokasi Kejadian:</label>
                                            <input type="text" class="form-control" id="alamat" name="alamat" required placeholder="Masukkan alamat lengkap lokasi kejadian">
                                        </div>

                                        <!-- Jenis Kesalahan -->
                                        <div class="mb-3">
                                            <label for="jenis_kesalahan" class="form-label"><i class="fas fa-exclamation-triangle"></i> Jenis Kesalahan:</label>
                                            <input type="text" class="form-control" id="jenis_kesalahan" name="jenis_kesalahan" required placeholder="Masukkan jenis kesalahan">
                                        </div>

                                        <!-- Jenis Tindakan -->
                                        <div class="mb-3">
                                            <label for="jenis_tindakan" class="form-label"><i class="fas fa-tasks"></i> Jenis Tindakan:</label>
                                            <textarea class="form-control" id="jenis_tindakan" name="jenis_tindakan" rows="4" required placeholder="Masukkan deskripsi kejadian dan tindakan yang dilakukan"></textarea>
                                        </div>

                                        <!-- Upload Foto -->
                                        <div class="mb-3">
                                            <label for="photo" class="form-label"><i class="fas fa-camera"></i> Upload Foto:</label>
                                            <input type="file" class="form-control" id="photo" name="photo">
                                        </div>

                                        <!-- Tombol Kirim -->
                                        <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Kirim</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url('backend/'); ?>js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url('backend/'); ?>assets/demo/chart-area-demo.js"></script>
    <script src="<?= base_url('backend/'); ?>assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url('backend/'); ?>js/datatables-simple-demo.js"></script>
</body>



</html>