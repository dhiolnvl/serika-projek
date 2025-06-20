<?= $this->extend('/admin/index'); ?>
<?= $this->section('content') ?>

<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Transaksi</h3>
      <ul class="breadcrumbs mb-3">
        <li class="nav-home">
          <a href="#">
            <i class="icon-home"></i>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('/admin/dataRiwayat') ?>">Riwayat Transaksi</a>
        </li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Data Transaksi</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <form method="GET" class="mb-3">
                <div class="row">
                  <div class="col-md-3">
                    <label for="bulan">Filter Bulan:</label>
                    <input type="month" id="bulan" name="bulan" class="form-control" value="<?= esc($_GET['bulan'] ?? '') ?>">
                  </div>
                  <div class="col-md-3 align-self-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="<?= base_url('/admin/dataTransaksi') ?>" class="btn btn-secondary">Reset</a>
                  </div>
                </div>
              </form>
              <table
                id="basic-datatables"
                class="display table table-striped table-hover">
                <thead>
                  <tr>
                    <th>ID Transaksi</th>
                    <th>ID Pelanggan</th>
                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th>Detail</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($transaksi as $row): ?>
                    <tr>
                      <td><?= esc($row['id_p']) ?></td>
                      <td><?= esc($row['id_u']) ?></td>
                      <td><?= esc($row['tanggal_pemesanan']) ?></td>
                      <td><?= esc($row['nama']) ?></td>
                      <td>
                        <ul style="padding-left: 1rem;">
                          <?php
                          $items = explode('|', $row['detail_items']);
                          foreach ($items as $item): ?>
                            <li><?= esc($item) ?></li>
                          <?php endforeach; ?>
                        </ul>
                      </td>
                      <td>Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                      <td><span class="badge bg-info"><?= esc($row['status'] ?? '-') ?></span></td>
                      <td>
                        <a href="<?= base_url('admin/editTransaksi/' . $row['id_p']) ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="<?= base_url('admin/deleteTransaksi/' . $row['id_p']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus transaksi ini?')">Hapus</a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!--   Core JS Files   -->
<script src="assets/js/core/jquery-3.7.1.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<!-- Datatables -->
<script src="assets/js/plugin/datatables/datatables.min.js"></script>
<!-- Kaiadmin JS -->
<script src="assets/js/kaiadmin.min.js"></script>
<!-- Kaiadmin DEMO methods, don't include it in your project! -->
<script src="assets/js/setting-demo2.js"></script>
<script>
  $(document).ready(function() {
    $("#basic-datatables").DataTable({});

    $("#multi-filter-select").DataTable({
      pageLength: 5,
      initComplete: function() {
        this.api()
          .columns()
          .every(function() {
            var column = this;
            var select = $(
                '<select class="form-select"><option value=""></option></select>'
              )
              .appendTo($(column.footer()).empty())
              .on("change", function() {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());

                column
                  .search(val ? "^" + val + "$" : "", true, false)
                  .draw();
              });

            column
              .data()
              .unique()
              .sort()
              .each(function(d, j) {
                select.append(
                  '<option value="' + d + '">' + d + "</option>"
                );
              });
          });
      },
    });

    // Add Row
    $("#add-row").DataTable({
      pageLength: 5,
    });

    var action =
      '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

    $("#addRowButton").click(function() {
      $("#add-row")
        .dataTable()
        .fnAddData([
          $("#addName").val(),
          $("#addPosition").val(),
          $("#addOffice").val(),
          action,
        ]);
      $("#addRowModal").modal("hide");
    });
  });
</script>
<?= $this->endSection(); ?>