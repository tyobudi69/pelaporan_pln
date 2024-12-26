
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="<?= base_url('Uploads/'); ?>4cff8c27-9ac9-40a3-9afd-9e4e633de9a7.png" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-3 animated slideInDown">Pelayanan Kerusakan</h5>
                            <h1 class="display-1 text-white mb-md-4 animated zoomIn">Kenyamanan dan keamanan anda kami utamakan</h1>
                            <a href="" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Contact Us</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="<?= base_url('Uploads/'); ?>1731776565_gardu_induk.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-3 animated slideInDown">Pelayanan Perbaikan</h5>
                            <h1 class="display-1 text-white mb-md-4 animated zoomIn">Kerusakan apapun akan kami perbaiki</h1>
                            <a href="" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Navbar & Carousel End -->

    <!-- Full Screen Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="background: rgba(9, 30, 62, .7);">
                <div class="modal-header border-0">
                    <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <div class="input-group" style="max-width: 600px;">
                        <input type="text" class="form-control bg-transparent border-primary p-3" placeholder="Type search keyword">
                        <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Full Screen Search End -->


    <!-- Facts Start -->
    <div class="container-fluid facts py-5 pt-lg-0">
        <div class="container py-5 pt-lg-0">
            <div class="row gx-0">
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.1s">
                    <div class="bg-primary shadow d-flex align-items-center justify-content-center p-4" style="height: 150px;">
                        <div class="bg-white d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                            <i class="fa fa-users text-primary"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="text-white mb-0">Jumlah Pelaporan</h5>
                            <h1 class="text-white mb-0" data-toggle="counter-up"><?php echo $jumlah_status; ?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.3s">
                    <div class="bg-light shadow d-flex align-items-center justify-content-center p-4" style="height: 150px;">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                            <i class="fa fa-check text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="text-primary mb-0">Dalam Penanganan</h5>
                            <h1 class="mb-0" data-toggle="counter-up"><?php echo $jumlah_dalam_penanganan; ?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.6s">
                    <div class="bg-primary shadow d-flex align-items-center justify-content-center p-4" style="height: 150px;">
                        <div class="bg-white d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                            <i class="fa fa-award text-primary"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="text-white mb-0">Selesai</h5>
                            <h1 class="text-white mb-0" data-toggle="counter-up"><?php echo $Selesai; ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Facts Start -->

    <!-- Chart Start -->
    <main>
        <body>
            <div class="dashboard-grid">
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
                            document.addEventListener("DOMContentLoaded", function(){
                                const chartData = <?= json_encode($chartData)?>;

                                console.log(chartData);

                                if(!chartData || !chartData.labels || !chartData.data){
                                    console.error("Chart data is invalid or undefined");
                                    return;
                                }

                                const ctx = document.getElementById("myAreaChart3").getContext("2d");

                                new Chart(ctx, {
                                    type: "line",
                                    data: {
                                        label:chartData.labels, // Label bulan
                                        datasets:[{
                                            
                                            label: "Jumlah Kerusakan",
                                            backgroundColor: "rgba(2,117,216,0.75)", // Warna area chart
                                            borderColor: "rgba(2,117,216,1)", // Warna garis
                                            fill: true, // Menambahkan pengisian area chart
                                            data: chartData.data, // Data jumlah kerusakan  
                                        }]
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
                                }),
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
                    </script>
                </div>
        </main>
    <!-- Chart Start -->
    
    <!-- About Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="section-title position-relative pb-3 mb-5">
                        <h5 class="fw-bold text-primary text-uppercase">About Us</h5>
                        <h1 class="mb-0">PLN Pasuruan</h1>
                        <h2>Listrik untuk Kehidupan yang Lebih Baik</h2>
                    </div>
                    <h5 class= "fw-bold">Visi</h5>
                    <p class="mb-4">Menjadi Perusahaan Global Top 500 dan #1 Pilihan Pelanggan untuk Solusi Energi.</p>
                    <h5 class= "fw-bold">Misi</h5>
                    <div class="link-animated d-flex flex-column justify-content-start">
                        <p class="text mb-2"><i class="bi bi-arrow-right me-2"></i>Menjalankan bisnis kelistrikan dan bidang lain yang terkait, berorientasi pada kepuasan pelanggan, anggota perusahaan dan pemegang saham.</p>
                        <p class="text mb-2"><i class="bi bi-arrow-right me-2"></i>Menjadikan tenaga listrik sebagai media untuk meningkatkan kualitas kehidupan masyarakat.</p>
                        <p class="text mb-2"><i class="bi bi-arrow-right me-2"></i>Mengupayakan agar tenaga listrik menjadi pendorong kegiatan ekonomi.</p>
                        <p class="text mb-2"><i class="bi bi-arrow-right me-2"></i>Menjalankan kegiatan usaha yang berwawasan lingkungan.</p>
                    </div>
                    <p> 3</p>
                    <div class="row g-0 mb-3">
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.2s">
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Pelayanan Kerusakan</h5>
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Pelayanan Perbaikan</h5>
                        </div>
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.4s">
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>24/7 Support</h5>
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Harga Terjangkau</h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4 wow fadeIn" data-wow-delay="0.6s">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="mb-2">Customer Service</h5>
                            <h4 class="text-primary mb-0">(0343)426516</h4>
                        </div>
                    </div>
                    <a href="about" class="btn btn-primary py-3 px-5 mt-3 wow zoomIn" data-wow-delay="0.9s">Get to Know</a>
                </div>
                <div class="col-lg-5" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s" src="<?= base_url('Uploads/'); ?>08496de9-5fad-4eab-950a-20f80e2f9d28-crop.png" style="object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Features Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Why Choose Us</h5>
                <h1 class="mb-0">Kami Melayani dengan Sepenuh Hati</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="row g-5">
                        <div class="col-12 wow zoomIn" data-wow-delay="0.2s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="fa fa-cubes text-white"></i>
                            </div>
                            <h4>Pelayanan Kerusakan</h4>
                            <p class="mb-0">Kenyamanan dan keamanan anda kami utamakan</p>
                        </div>
                        <div class="col-12 wow zoomIn" data-wow-delay="0.6s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="fa fa-award text-white"></i>
                            </div>
                            <h4>Pelayanan Perbaikan</h4>
                            <p class="mb-0">Kerusakan apapun akan kami perbaiki</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4  wow zoomIn" data-wow-delay="0.9s" style="min-height: 350px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.1s" src="<?= base_url('frontend/pln/'); ?>img/feature.jpg" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row g-5">
                        <div class="col-12 wow zoomIn" data-wow-delay="0.4s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="fa fa-users-cog text-white"></i>
                            </div>
                            <h4>Harga Terjangkau</h4>
                            <p class="mb-0">Harga minim kualitas tinggi</p>
                        </div>
                        <div class="col-12 wow zoomIn" data-wow-delay="0.8s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="fa fa-phone-alt text-white"></i>
                            </div>
                            <h4>24/7 Support</h4>
                            <p class="mb-0">Kapanpun kerusakan anda akan kami perbaiki dengan cepat</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features Start -->


    <!-- Service Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Our Services</h5>
                <h1 class="mb-0">Listrik untuk Kehidupan yang Lebih Baik</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.3s">
                    <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="fa fa-shield-alt text-white"></i>
                        </div>
                        <h4 class="mb-3">Pelaporan Kerusakan</h4>
                        <p class="m-0">Laporkan kerusakan PLN pada kami</p>
                        <a class="btn btn-lg btn-primary rounded" href="">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.6s">
                    <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="fa fa-chart-pie text-white"></i>
                        </div>
                        <h4 class="mb-3">Pelaporan Pemeliharaan</h4>
                        <p class="m-0">Laporkan apa yang perlu kami pastikan</p>
                        <a class="btn btn-lg btn-primary rounded" href="">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.9s">
                    <div class="position-relative bg-primary rounded h-100 d-flex flex-column align-items-center justify-content-center text-center p-5">
                        <h3 class="text-white mb-3">Call Center</h3>
                        <p class="text-white mb-3">Hubungi kami apabila terdapat keluhan atau pemeliharaan yang anda inginkan</p>
                        <h2 class="text-white mb-0">(0343)426516</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- Team Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Pegawai Struktural</h5>
                <h1 class="mb-0">Our Expert People Ready to Help You</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
                    <div class="team-item bg-light rounded overflow-hidden">
                        <div class="team-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="<?= base_url('foto_karyawan/'); ?>MANAGER UP3 - AGUS SUSANTO.png" alt="">
                            
                        </div>
                        <div class="text-center py-4">
                            <h4 class="text-primary">AGUS SUSANTO</h4>
                            <p class="text-uppercase m-0">MANAGER UP3</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.6s">
                    <div class="team-item bg-light rounded overflow-hidden">
                        <div class="team-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="<?= base_url('foto_karyawan/'); ?>ASSISTANT MANAGER KEUANGAN DAN UMUM - WIDI UMARYANTO.jpeg" alt="">
                        </div>
                        <div class="text-center py-4">
                            <h4 class="text-primary">WIDI UMARYANTO</h4>
                            <p class="text-uppercase m-0">ASSISTEN MANAGER KEUANGAN DAN UMUM</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.9s">
                    <div class="team-item bg-light rounded overflow-hidden">
                        <div class="team-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="<?= base_url('foto_karyawan/'); ?>ASSISTANT MANAGER NIAGA DAN PEMASARAN - IRSYAM ASRI PUTRA.png" alt="">
                            
                        </div>
                        <div class="text-center py-4">
                            <h4 class="text-primary">IRSYAM ASRI PUTRA</h4>
                            <p class="text-uppercase m-0">ASSISTANT MANAGER NIAGA DAN PEMASARAN</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
                    <div class="team-item bg-light rounded overflow-hidden">
                        <div class="team-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="<?= base_url('foto_karyawan/'); ?>ASSISTANT MANAGER KONSTRUKSI - SLAMET RIADY.jpeg" alt="">
                        </div>
                        <div class="text-center py-4">
                            <h4 class="text-primary">SLAMET RIADY</h4>
                            <p class="text-uppercase m-0">ASSISTANT MANAGER KONSTRUKSI</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.6s">
                    <div class="team-item bg-light rounded overflow-hidden">
                        <div class="team-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="<?= base_url('foto_karyawan/'); ?>ASSISTANT MANAGER TRANSAKSI ENERGI LISTRIK - M RIZAL FALFI.jpeg" alt="">
                        </div>
                        <div class="text-center py-4">
                            <h4 class="text-primary">MUHAMMAD RIZAL FALFI</h4>
                            <p class="text-uppercase m-0">ASSISTANT MANAGER TRANSAKSI ENERGI LISTRIK</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.9s">
                    <div class="team-item bg-light rounded overflow-hidden">
                        <div class="team-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="<?= base_url('foto_karyawan/'); ?>ASSISTANT MANAGER JARINGAN - MOCH. ZAINUDDIN.png" alt="">
                        </div>
                        <div class="text-center py-4">
                            <h4 class="text-primary">MOCH. ZAINUDDIN</h4>
                            <p class="text-uppercase m-0">ASSISTANT MANAGER JARINGAN</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
                    <div class="team-item bg-light rounded overflow-hidden">
                        <div class="team-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="<?= base_url('foto_karyawan/'); ?>ASSISTANT MANAGER PERENCANAAN - MOCHAMMAD IRFANSYAH.png" alt="">
                        </div>
                        <div class="text-center py-4">
                            <h4 class="text-primary">MOCHAMAD IRFANSYAH</h4>
                            <p class="text-uppercase m-0">ASSISTANT MANAGER PERENCANAAN</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.6s">
                    <div class="team-item bg-light rounded overflow-hidden">
                        <div class="team-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="<?= base_url('foto_karyawan/'); ?>MANAGER ULP KRAKSAAN - RECHI NOVRIADI.png" alt="">
                        </div>
                        <div class="text-center py-4">
                            <h4 class="text-primary">RECHI NOVRIADI. TA</h4>
                            <p class="text-uppercase m-0">MANAGER UNIT LAYANAN PELANGGAN KRAKSAAN</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.9s">
                    <div class="team-item bg-light rounded overflow-hidden">
                        <div class="team-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="<?= base_url('foto_karyawan/'); ?>MANAGER ULP GONDANG WETAN - HERMAN WIDOYO.png" alt="">
                        </div>
                        <div class="text-center py-4">
                            <h4 class="text-primary">HERMAN WIDOYO</h4>
                            <p class="text-uppercase m-0">MANAGER UNIT LAYANAN PELANGGAN GONDANG WETAN</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
                    <div class="team-item bg-light rounded overflow-hidden">
                        <div class="team-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="<?= base_url('foto_karyawan/'); ?>MANAGER ULP PROBOLINGGO - RENDRA MADYASTA.png" alt="">
                        </div>
                        <div class="text-center py-4">
                            <h4 class="text-primary">RENDRA MADYASTA YULIANTO</h4>
                            <p class="text-uppercase m-0">MANAGER UNIT LAYANAN PELANGGAN PROBOLINGGO</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.6s">
                    <div class="team-item bg-light rounded overflow-hidden">
                        <div class="team-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="<?= base_url('foto_karyawan/'); ?>MANAGER ULP PASURUAN KOTA - M. RIZAL FALFI.png" alt="">
                        </div>
                        <div class="text-center py-4">
                            <h4 class="text-primary">MUHAMMAD RIZAL FAUZI</h4>
                            <p class="text-uppercase m-0">MANAGER UNIT LAYANAN PELANGGAN PASURUAN KOTA</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.9s">
                    <div class="team-item bg-light rounded overflow-hidden">
                        <div class="team-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="<?= base_url('foto_karyawan/'); ?>MANAGER ULP PANDAAN - ARIF SETYO.png" alt="">
                        </div>
                        <div class="text-center py-4">
                            <h4 class="text-primary">ARIF SETYO</h4>
                            <p class="text-uppercase m-0">MANAGER UNIT LAYANAN PELANGGAN PANDAAN</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
                    <div class="team-item bg-light rounded overflow-hidden">
                        <div class="team-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="<?= base_url('foto_karyawan/'); ?>MANAGER ULP BANGIL - ROLLY DWI.png" alt="">
                        </div>
                        <div class="text-center py-4">
                            <h4 class="text-primary">ROLLY DWI N</h4>
                            <p class="text-uppercase m-0">MANAGER UNIT LAYANAN PELANGGAN BANGIL</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.6s">
                    <div class="team-item bg-light rounded overflow-hidden">
                        <div class="team-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="<?= base_url('foto_karyawan/'); ?>MANAGER ULP SUKOREJO - ZAYNULLAH ARIFIN.png" alt="">
                        </div>
                        <div class="text-center py-4">
                            <h4 class="text-primary">ZAYNULLAH ARIFIN</h4>
                            <p class="text-uppercase m-0">MANAGER UNIT LAYANAN PELANGGAN SUKOREJO</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.9s">
                    <div class="team-item bg-light rounded overflow-hidden">
                        <div class="team-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="<?= base_url('foto_karyawan/'); ?>MANAGER ULP GRATI - JOKO PITOYO.png" alt="">
                        </div>
                        <div class="text-center py-4">
                            <h4 class="text-primary">JOKO PITOYO</h4>
                            <p class="text-uppercase m-0">MANAGER UNIT LAYANAN PELANGGAN GRATI</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
                    <div class="team-item bg-light rounded overflow-hidden">
                        <div class="team-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="<?= base_url('foto_karyawan/'); ?>MANAGER ULP PRIGEN HABIBAH ZAHRA.png" alt="">
                        </div>
                        <div class="text-center py-4">
                            <h4 class="text-primary">HABIBAH ZAHRA F</h4>
                            <p class="text-uppercase m-0">MANAGER UNIT LAYANAN PELANGGAN PRIGEN</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.6s">
                    <div class="team-item bg-light rounded overflow-hidden">
                        <div class="team-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="<?= base_url('foto_karyawan/'); ?>" alt="">
                        </div>
                        <div class="text-center py-4">
                            <h4 class="text-primary">ANDHIKA GABELLY FP</h4>
                            <p class="text-uppercase m-0">TEAM LEADER KESELAMATAN, KESEHATAN KERJA, LINGKUNGAN, DAN KEAMANAN</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.9s">
                    <div class="team-item bg-light rounded overflow-hidden">
                        <div class="team-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="<?= base_url('foto_karyawan/'); ?>" alt="">
                        </div>
                        <div class="text-center py-4">
                            <h4 class="text-primary">DIMAS SETIAWAN</h4>
                            <p class="text-uppercase m-0">TEAM LEADER PELAKSANAAN PENGADAAN</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Vendor Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5 mb-5">
            <div class="bg-white">
                <div class="owl-carousel vendor-carousel">
                    <img src="img/vendor-1.jpg" alt="">
                    <img src="img/vendor-2.jpg" alt="">
                    <img src="img/vendor-3.jpg" alt="">
                    <img src="img/vendor-4.jpg" alt="">
                    <img src="img/vendor-5.jpg" alt="">
                    <img src="img/vendor-6.jpg" alt="">
                    <img src="img/vendor-7.jpg" alt="">
                    <img src="img/vendor-8.jpg" alt="">
                    <img src="img/vendor-9.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor End -->