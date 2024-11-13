<?php
include('../../layouts/header.php');
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

                <div class="col-7">
                    <div class="card">
                        <div class="card-body">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-5">
                    <iframe src="https://lottie.host/embed/292898f7-1abb-4279-8aed-a98d3df01654/T7fcq1gugM.json" width="350" height="350" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>


        </div>
    </div>
</div>


mysql
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['DItolak', 'Pengajuan', 'Proses', 'Selesai'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5],
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