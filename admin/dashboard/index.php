<?php
include('../../database/koneksi.php');
include('../../layouts/header.php');


$sql = "SELECT status, COUNT('status') as count FROM pengaduan GROUP BY status";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Query gagal: ' . mysqli_error($conn));
}

$status_data = [
    'ditolak' => 0,
    '0' => 0,
    'proses' => 0,
    'selesai' => 0
];

while ($row = mysqli_fetch_assoc($result)) {
    $status = $row['status'];
    $count = $row['count'];


    if (isset($status_data[$status])) {
        $status_data[$status] = $count;
    }
}


mysqli_close($conn);
?>

<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <?php
    include('../layouts/aside.php');
    ?>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
        <!--  Header Start -->
        <?php
        include('../layouts/nav.php');
        ?>
        <!--  Header End -->
        <div class="container-fluid">
            <div class="text-center">

                <h3 class="mb-3">Selamat datang Sistem Pengaduan Masyarakat</h3>

            </div>
            <div class="row">
            <div class="col-5"><iframe src="https://lottie.host/embed/f08e0071-8f8e-40c8-97d2-29fc73fbc901/7KmWRD0gAb.json" width="350" height="350"></iframe>
                </div>
                <div class="col-7">
                    <div class="card">
                        <div class="card-body">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['ditolak', 'sedang diajukan', 'proses', 'selesai'],
                datasets: [{
                    label: '# of pengaduan',
                    data: [
                        <?php echo $status_data['ditolak']; ?>,
                        <?php echo $status_data['0']; ?>,
                        <?php echo $status_data['proses']; ?>,
                        <?php echo $status_data['selesai']; ?>
                    ],
                    backgroundColor: [
                        '#d63384',
                        '#FFAE1F',
                        '#539BFF',
                        '#13DEB9',

                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',

                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>


    <?php
    include('../../layouts/footer.php');
    ?>