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
                        <a class="nav-link" href="<?= base_url('user/pelaporan') ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Pelaporan Kerusakan
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">

                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="<?= base_url('user/perbaikan') ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Pelaporan Perbaikan
                        </a>
                        <div class="sb-sidenav-menu-heading">Addons</div>
                        <a class="nav-link" href="<?= base_url('user/pemeliharaan') ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Pelaporan pemeliharaan
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
                    <h1 class="mt-4">Pelaporan Perbaikan</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <div class="filter-group d-flex justify-content-between">
                        <div>
                            <label for="status-filter">Filter berdasarkan Status:</label>
                            <select id="status-filter">
                                <option value="">Semua Status</option>
                                <option value="Butuh Penanganan">Butuh Penanganan</option>
                                <option value="Dalam Penanganan">Dalam Penanganan</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>
                        <!-- <div>
                            <label class="mr-4" for="date-filter">Filter berdasarkan Tanggal:</label>
                            <input type="date" id="date-filter">
                        </div> -->
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Status Pelaporan
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Tanggal Laporan</th>
                                        <th>Kota/Kabupaten</th>
                                        <th>Lokasi Kejadian</th>
                                        <th>Jenis Kesalahan</th>
                                        <th>Status</th>
                                        <th>Tindakan Lanjutan</th>
                                    </tr>
                                    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
                                </thead>
                                <tbody>
                                    <?php if (!empty($pelaporan)) : ?>
                                        <?php foreach ($pelaporan as $laporan) : ?>
                                            <tr>
                                                <td><?= htmlspecialchars(date('d M Y', strtotime($laporan['tanggal']))) ?></td>
                                                <td><?= htmlspecialchars($laporan['kota']) ?></td>
                                                <td><?= htmlspecialchars($laporan['lokasi']) ?></td>
                                                <td><?= htmlspecialchars($laporan['jenis_kesalahan']) ?></td>
                                                <td>
                                                    <span class="status <?= htmlspecialchars($laporan['status']) ?>">
                                                        <?= htmlspecialchars(ucwords(str_replace('_', ' ', $laporan['status']))) ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#detailModal<?= $laporan['id'] ?>">
                                                            <i class="fas fa-eye"></i> <!-- Ikon mata -->
                                                        </button>

                                                        <?php if ($laporan['status'] == "Butuh Penanganan") : ?>
                                                            <!-- Button to trigger modal for "Butuh Penanganan" -->
                                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#confirmInActionModal">
                                                                <i class="fas fa-paper-plane"></i>
                                                            </button>

                                                            <!-- Modal for "Butuh Penanganan" -->
                                                            <div class="modal fade" id="confirmInActionModal" tabindex="-1" aria-labelledby="confirmInActionModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="confirmInActionModalLabel">Konfirmasi</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Apakah Anda yakin ingin memulai penanganan perbaikan?
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                            <button type="button" class="btn btn-warning" onclick="document.getElementById('inActionForm').submit();">
                                                                                Ya, Mulai Penanganan
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Form for "Butuh Penanganan" -->
                                                            <form id="inActionForm" method="POST" action="<?= site_url('service/updateStatusInConfirmation') ?>" style="display: none;">
                                                                <input type="hidden" name="id" value="<?= $laporan['id'] ?>">
                                                            </form>
                                                        <?php endif; ?>

                                                        <?php if ($laporan['status'] == "Dalam Penanganan") : ?>
                                                            <!-- Button to trigger modal for "Dalam Penanganan" -->
                                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmFinishModal">
                                                                <i class="fas fa-check"></i>
                                                            </button>

                                                            <!-- Modal for "Dalam Penanganan" -->
                                                            <div class="modal fade" id="confirmFinishModal" tabindex="-1" aria-labelledby="confirmFinishModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="confirmFinishModalLabel">Konfirmasi</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Apakah Anda yakin ingin menyelesaikan perbaikan?
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                            <button type="button" class="btn btn-success" onclick="document.getElementById('finishForm').submit();">
                                                                                Ya, Selesaikan
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Form for "Dalam Penanganan" -->
                                                            <form id="finishForm" method="POST" action="<?= site_url('service/updateStatusFinish') ?>" style="display: none;">
                                                                <input type="hidden" name="id" value="<?= $laporan['id'] ?>">
                                                            </form>
                                                        <?php endif; ?>




                                                    </div>
                                                    <!-- Modal untuk Detail Tindakan -->
                                                    <div class="modal fade" id="detailModal<?= $laporan['id'] ?>" tabindex="-1" aria-labelledby="detailModalLabel<?= $laporan['id'] ?>" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="detailModalLabel<?= $laporan['id'] ?>">Detail Laporan</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p><strong>Jenis Tindakan:</strong> <?= htmlspecialchars($laporan['jenis_tindakan']) ?></p>
                                                                    <p><strong>Gambar:</strong></p>
                                                                    <img src="<?= base_url($laporan['gambar']) ?>" alt="Gambar Laporan" class="img-fluid" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="5">Tidak ada data pelaporan.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Tanggal Laporan</th>
                                        <th>Lokasi Kejadian</th>
                                        <th>Jenis Kesalahan</th>
                                        <th>Status</th>
                                        <th>Tindakan Lanjutan</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <script>
                        $(document).ready(function() {
                            $('#example-table').DataTable({
                                ajax: {
                                    url: '<?= base_url("user/perbaikan") ?>',
                                    dataSrc: 'data'
                                },
                                columns: [{
                                        data: 'tanggal'
                                    },
                                    {
                                        data: 'jenis_kesalahan'
                                    },
                                    {
                                        data: 'lokasi'
                                    },
                                    {
                                        data: 'status',
                                        render: function(data) {
                                            return `<span class="status ${data}">${data.replace('_', ' ')}</span>`;
                                        }
                                    },
                                    {
                                        data: 'id',
                                        render: function(data) {
                                            return `<span class="details-link" onclick="showDetails(${data})">Lihat Detail</span>`;
                                        }
                                    },
                                    {
                                        data: 'gambar',
                                        render: function(data, type, row) {
                                            // Gunakan path gambar berdasarkan kolom 'gambar'
                                            return `
                            <img src="<?= base_url('Uploads/') ?>${data}" 
                                 alt="Gambar Laporan" 
                                 class="img-thumbnail" 
                                 style="width: 100px;" />
                            <span class="details-link" onclick="showDetails(${row.id})">Lihat Detail</span>
                        `;
                                        }
                                    }
                                ]
                            });
                        });
                    </script>
            </main>

            <script>
                document.getElementById('status-filter').addEventListener('change', function() {
                    const selectedStatus = this.value.toLowerCase(); // Nilai status yang dipilih
                    const rows = document.querySelectorAll('#datatablesSimple tbody tr'); // Baris tabel

                    rows.forEach(row => {
                        const statusCell = row.querySelector('td:nth-child(4) .status'); // Sel status
                        const statusValue = statusCell ? statusCell.textContent.trim().toLowerCase() : ''; // Nilai status dalam baris

                        // Periksa apakah status sesuai dengan filter atau jika filter kosong (tampilkan semua)
                        if (selectedStatus === '' || statusValue === selectedStatus) {
                            row.style.display = ''; // Tampilkan baris
                        } else {
                            row.style.display = 'none'; // Sembunyikan baris
                        }
                    });
                });
            </script>


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

    <div class="container mt-3">
        <?php if ($this->session->flashdata('success_message')) : ?>
            <div class="alert alert-success">
                <?= $this->session->flashdata('success_message'); ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error_message')) : ?>
            <div class="alert alert-danger">
                <?= $this->session->flashdata('error_message'); ?>
            </div>
        <?php endif; ?>
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