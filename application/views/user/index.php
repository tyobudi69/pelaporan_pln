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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
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
                        <a class="nav-link collapsed" href="<?= base_url('user/pemeliharaan') ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Pelaporan pemeliharaan
                        </a>
                        <a class="nav-link collapsed" href="<?= base_url('user/report') ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Report pemeliharaan
                        </a>
                    </div>
                </div>
                <!-- <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div> -->
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Home</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>

                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            background-color: #f4f6f9;
                            margin: 10px;
                            padding: 20px;
                        }

                        .dashboard-grid {
                            display: flex;
                            justify-content: space-between;
                            gap: 20px;
                            /* Adjust the gap as needed */
                            margin-bottom: 15px;
                        }

                        .card {
                            background: #ffffff;
                            border: 1px solid #ddd;
                            border-radius: 30px;
                            padding: 20px;
                            text-align: center;
                            transition: all 0.3s ease;
                        }

                        .card:hover {
                            transform: translateY(-10px);
                            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
                        }

                        .card-header {
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            margin-bottom: 20px;
                            font-size: 20px;
                            font-weight: bold;
                        }

                        .card-header .card-title {
                            margin-right: 80px;
                        }

                        .card-header i {
                            font-size: 30px;
                        }

                        .card-value {
                            font-size: 40px;
                            font-weight: bold;
                            margin-top: 10px;
                        }

                        /* Responsiveness for smaller screens */
                        @media (max-width: 768px) {
                            .dashboard-grid {
                                flex-direction: column;
                                gap: 15px;
                                /* Jarak antar elemen pada layar kecil */
                            }
                        }
                    </style>

                    <body>
                        <div class="dashboard-grid">
                            <!-- Card for Total Kejadian -->
                            <div class="card">
                                <div class="card-header">
                                    <span class="card-title">Total Kejadian</span>
                                    <i class="fas fa-exclamation-circle"></i>
                                </div>
                                <div class="card-value" id="totalIncidents">
                                    <?= htmlspecialchars($totalKejadian) ?>
                                </div>
                            </div>

                            <!-- Card for Dalam Penanganan -->
                            <div class="card">
                                <div class="card-header">
                                    <span class="card-title">Dalam Penanganan</span>
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div class="card-value" id="inProgressIncidents">
                                    <?= htmlspecialchars($dalamPenanganan) ?>
                                </div>
                            </div>

                            <!-- Card for Kejadian Selesai -->
                            <div class="card">
                                <div class="card-header">
                                    <span class="card-title">Kejadian Selesai</span>
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="card-value" id="completedActions">
                                    <?= htmlspecialchars($kejadianSelesai) ?>
                                </div>
                            </div>
                        </div>
                    </body>

                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area me-1"></i>
                                    Jumlah Kerusakan Per-Bulan
                                </div>
                                <div class="card-body"><canvas id="myAreaChart3" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                const chartData = <?= json_encode($chartData) ?>;

                                // Debug untuk memastikan data
                                console.log(chartData);

                                // Cek apakah chartData memiliki data yang valid
                                if (!chartData || !chartData.labels || !chartData.data) {
                                    console.error("Chart data is invalid or undefined");
                                    return;
                                }

                                const ctx = document.getElementById("myAreaChart3").getContext("2d");

                                new Chart(ctx, {
                                    type: "line", // Mengubah tipe chart menjadi area (line dengan area di bawahnya)
                                    data: {
                                        labels: chartData.labels, // Label bulan
                                        datasets: [{
                                            label: "Jumlah Kerusakan",
                                            backgroundColor: "rgba(2,117,216,0.75)", // Warna area chart
                                            borderColor: "rgba(2,117,216,1)", // Warna garis
                                            fill: true, // Menambahkan pengisian area chart
                                            data: chartData.data, // Data jumlah kerusakan
                                        }],
                                    },
                                    options: {
                                        responsive: true,
                                        scales: {
                                            x: {
                                                title: {
                                                    display: true,
                                                    text: "Bulan"
                                                },
                                                grid: {
                                                    display: false
                                                },
                                            },
                                            y: {
                                                title: {
                                                    display: true,
                                                    text: "Jumlah Kerusakan"
                                                },
                                                ticks: {
                                                    beginAtZero: true
                                                },
                                            },
                                        },
                                    },
                                });
                            });
                        </script>
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Jumlah Kerusakan Per-Kota
                                </div>
                                <div class="card-body">
                                    <canvas id="myCityChart" width="100%" height="40"></canvas>
                                </div>
                            </div>
                        </div>
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                const cityChartData = <?= json_encode($cityChartData) ?>;

                                // Debug untuk memastikan data
                                console.log(cityChartData);

                                // Cek apakah chartData memiliki data yang valid
                                if (!cityChartData || !cityChartData.labels || !cityChartData.data) {
                                    console.error("City chart data is invalid");
                                    return;
                                }

                                const ctx = document.getElementById("myCityChart").getContext("2d");

                                new Chart(ctx, {
                                    type: "bar", // Mengubah tipe chart menjadi area (line dengan area di bawahnya)
                                    data: {
                                        labels: cityChartData.labels, // Label bulan
                                        datasets: [{
                                            label: "Jumlah Kerusakan",
                                            backgroundColor: "rgba(2,117,216,0.75)", // Warna area chart
                                            borderColor: "rgba(2,117,216,1)", // Warna garis
                                            fill: true, // Menambahkan pengisian area chart
                                            data: cityChartData.data, // Data jumlah kerusakan
                                        }],
                                    },
                                    options: {
                                        responsive: true,
                                        scales: {
                                            x: {
                                                title: {
                                                    display: true,
                                                    text: "Kota"
                                                },
                                                grid: {
                                                    display: false
                                                },
                                            },
                                            y: {
                                                title: {
                                                    display: true,
                                                    text: "Jumlah Kerusakan"
                                                },
                                                ticks: {
                                                    beginAtZero: true
                                                },
                                            },
                                        },
                                    },
                                });
                            });
                        </script>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="col-lg-6">
                            <div class="card mb-10">
                                <div class="card-header">
                                    <i class="fas fa-chart-pie me-1"></i>
                                    Chart Pelaporan Kerusakan
                                </div>
                                <div class="card-body">
                                    <div id="kerusakanChart"></div>
                                </div>
                                <div class="card-footer small text-muted" id="lastUpdated">Updated just now</div>
                            </div>
                        </div>
                    </div>
                    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            // Data dari PHP untuk pie chart
                            const kerusakanData = <?= json_encode($kerusakan); ?>;

                            // Labels dan data
                            const labelsKerusakan = Object.keys(kerusakanData);
                            const dataKerusakan = Object.values(kerusakanData);

                            // Donut Chart menggunakan ApexCharts
                            const options = {
                                chart: {
                                    type: 'donut',
                                    height: 350
                                },
                                series: dataKerusakan, // Data untuk chart
                                labels: labelsKerusakan, // Label untuk tiap kategori
                                colors: ['#dc3545', '#ffc107', '#28a745', '#17a2b8'], // Warna kategori
                                legend: {
                                    position: 'bottom'
                                },
                                dataLabels: {
                                    enabled: true,
                                    formatter: function(val) {
                                        return val.toFixed(1) + "%"; // Menampilkan persentase
                                    }
                                },
                                plotOptions: {
                                    pie: {
                                        donut: {
                                            size: '65%'
                                        }
                                    }
                                },
                                responsive: [{
                                    breakpoint: 480,
                                    options: {
                                        chart: {
                                            width: 300
                                        },
                                        legend: {
                                            position: 'bottom'
                                        }
                                    }
                                }]
                            };

                            // Render chart
                            const chart = new ApexCharts(document.querySelector("#kerusakanChart"), options);
                            chart.render();
                        });
                    </script>

                    <style>
                        .d-flex {
                            display: flex;
                            flex-wrap: wrap;
                            gap: 1rem;
                        }

                        .col-lg-6 {
                            flex: 1 1 calc(50% - 1rem);
                            box-sizing: border-box;
                        }
                    </style>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            // Misal: Pembaruan data untuk chart
                            const updateChart = () => {
                                // Logika pembaruan chart (misal: melalui data AJAX)
                                console.log("Chart updated!");

                                // Perbarui waktu setelah pembaruan selesai
                                updateLastUpdatedTime();
                            };

                            // Panggil fungsi pembaruan chart sebagai contoh
                            setTimeout(updateChart, 2000); // Simulasi pembaruan setelah 2 detik
                        });

                        // Fungsi pembaruan waktu
                        function getFormattedDate() {
                            const now = new Date();
                            const options = {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit',
                                second: '2-digit',
                                hour12: true,
                            };
                            return now.toLocaleString('en-US', options);
                        }

                        function updateLastUpdatedTime() {
                            const lastUpdatedElement = document.getElementById("lastUpdated");
                            lastUpdatedElement.textContent = `Updated on ${getFormattedDate()}`;
                        }
                    </script>
                    <div class="card mb-100">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Data Pelaporan Kerusakan
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
                                    </tr>
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
                                        <th>Kota/Kabupaten</th>
                                        <th>Lokasi Kejadian</th>
                                        <th>Jenis Kesalahan</th>
                                        <th>Status</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <script>
                        $(document).ready(function() {
                            $('#example-table').DataTable({
                                ajax: {
                                    url: '<?= base_url("user/index") ?>',
                                    dataSrc: 'data'
                                },
                                columns: [{
                                        data: 'tanggal'
                                    },
                                    {
                                        data: 'kota'
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
                                    }
                                ]
                            });
                        });
                    </script>
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