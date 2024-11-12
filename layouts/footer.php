<script src="<?= BASE_URL ?>/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="<?= BASE_URL ?>/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL ?>/assets/js/sidebarmenu.js"></script>
<script src="<?= BASE_URL ?>/assets/js/app.min.js"></script>
<script src="<?= BASE_URL ?>/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
<script src="<?= BASE_URL ?>/assets/libs/simplebar/dist/simplebar.js"></script>
<script src="<?= BASE_URL ?>/assets/js/dashboard.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script>

<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script>
  // Fungsi untuk mengekspor tabel ke file Excel (.xlsx)
  function exportTableToExcel(tableID, filename = '') {
    var table = document.getElementById(tableID);

    // Menggunakan SheetJS untuk mengonversi tabel menjadi file Excel
    var wb = XLSX.utils.table_to_book(table, {
      sheet: "Sheet 1"
    });

    // Menyimpan file Excel dengan nama yang diberikan
    XLSX.writeFile(wb, filename + '.xlsx');
  }
  $(document).ready(function() {
    $('#myTable').DataTable();
    $('#myTable1').DataTable();
  });
</script>
</body>

</html>
</body>