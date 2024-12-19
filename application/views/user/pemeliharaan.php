<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>PLN</title>
    <!-- Simple DataTables CSS -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="<?= base_url('backend/'); ?>css/styles.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="<?= base_url('user/index') ?>">PLN</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
            <i class="fas fa-bars"></i>
        </button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button">
                    <i class="fas fa-search"></i>
                </button>
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
                        <a class="dropdown-item" href="#!"><i class="fas fa-cog me-2"></i> Settings</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#!"><i class="fas fa-list me-2"></i> Activity Log</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <a class="dropdown-item" href="<?= base_url('auth/logout') ?>"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
                    </li>
                </ul>
            </li>
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
                        <a class="nav-link collapsed" href="<?= base_url('user/perbaikan') ?>">
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
                            Report Pemeliharaan
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Pelaporan Pemeliharaan</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Status Pelaporan
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No Register</th>
                                        <th>Kota/Kabupaten</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($pemeliharaan)) : ?>
                                        <?php foreach ($pemeliharaan as $laporan) : ?>
                                            <tr>
                                                <td><?= htmlspecialchars($laporan['no_regis']) ?></td>
                                                <td><?= htmlspecialchars($laporan['kota']) ?></td>
                                                <td><?= htmlspecialchars($laporan['nama']) ?></td>
                                                <td><?= htmlspecialchars($laporan['alamat']) ?></td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm btn-update" data-bs-toggle="modal" data-bs-target="#updateModal" data-no-regis="<?= htmlspecialchars($laporan['no_regis']) ?>" data-kota="<?= htmlspecialchars($laporan['kota']) ?>" data-nama="<?= htmlspecialchars($laporan['nama']) ?>" data-alamat="<?= htmlspecialchars($laporan['alamat']) ?>" data-jenis_kesalahan="<?= htmlspecialchars($laporan['jenis_kesalahan']) ?>" data-jenis_tindakan="<?= htmlspecialchars($laporan['jenis_tindakan']) ?>" data-gambar="<?= htmlspecialchars($laporan['gambar']) ?>" data-tanggal="<?= htmlspecialchars($laporan['tanggal']) ?>">
                                                        <i class="fas fa-edit"></i> Update
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="5">Tidak ada data pemeliharaan.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No Register</th>
                                        <th>Kota/Kabupaten</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Update</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
            </main>
            <!-- Modal -->
            <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="updateForm" method="post" action="<?= base_url('user/update_pemeliharaan') ?>" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateModalLabel">Update Pemeliharaan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="no_regis" class="form-label">No Register</label>
                                    <input type="text" class="form-control" id="no_regis" name="no_regis" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="kota" class="form-label">Kota/Kabupaten</label>
                                    <input type="text" class="form-control" id="kota" name="kota" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_kesalahan" class="form-label">Jenis Kesalahan</label>
                                    <input type="text" class="form-control" id="jenis_kesalahan" name="jenis_kesalahan">
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_tindakan" class="form-label">Jenis Tindakan</label>
                                    <input type="text" class="form-control" id="jenis_tindakan" name="jenis_tindakan">
                                </div>
                                <div class="mb-3">
                                    <label for="gambar_current" class="form-label">Current Image</label>
                                    <div id="gambar" style="margin-bottom: 10px;"></div>
                                    <label for="gambar" class="form-label">Upload New Image</label>
                                    <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="text" class="form-control" id="tanggal" name="tanggal" readonly>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>

                    </div>
                </div>

                <!-- Bootstrap JS -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
                <!-- Simple DataTables JS -->
                <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
                <!-- Custom scripts -->
                <script src="<?= base_url('backend/'); ?>js/scripts.js"></script>
                <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
                <script>
                    // Handle the button update click event
                    $(document).on('click', '.btn-update', function() {
                        const noRegis = $(this).data('no-regis');
                        const kota = $(this).data('kota');
                        const nama = $(this).data('nama');
                        const alamat = $(this).data('alamat');
                        const jenis_kesalahan = $(this).data('jenis_kesalahan');
                        const jenis_tindakan = $(this).data('jenis_tindakan');
                        const gambar = $(this).data('gambar');
                        const tanggal = $(this).data('tanggal');

                        $('#no_regis').val(noRegis);
                        $('#kota').val(kota);
                        $('#nama').val(nama);
                        $('#alamat').val(alamat);
                        $('#jenis_kesalahan').val(jenis_kesalahan);
                        $('#jenis_tindakan').val(jenis_tindakan);

                        if (gambar) {
                            const baseUrl = "<?= base_url() ?>";
                            $('#gambar').html(`<img src="${baseUrl}${gambar}" alt="Current Image" class="img-fluid img-thumbnail" style="max-height: 200px;">`);
                        } else {
                            $('#gambar').html('<p>No image available</p>');
                        }

                        $('#tanggal').val(tanggal);
                    });

                    // Activate Simple DataTables
                    const datatablesSimple = document.querySelector('#datatablesSimple');
                    if (datatablesSimple) {
                        new simpleDatatables.DataTable(datatablesSimple);
                    }

                    // Example of handling additional logic for filtering or exporting
                    $('#export-button').on('click', function() {
                        const tableData = datatablesSimple.data;
                        console.log('Exporting table data:', tableData);
                        alert('Export function triggered. Implement the export logic here.');
                    });

                    $('#filter-button').on('click', function() {
                        const filterValue = $('#filter-input').val();
                        console.log('Filtering table with value:', filterValue);
                        alert('Filter function triggered. Implement the filter logic here.');
                    });
                </script>
</body>

</html>