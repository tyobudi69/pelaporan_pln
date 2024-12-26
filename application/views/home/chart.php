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
