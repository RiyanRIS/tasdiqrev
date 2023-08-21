<!DOCTYPE html>
<html lang="en">

<head>
  <?= view("admin/templates/head") ?>
  <!-- CSS -->
  <!-- TUTUP CSS -->
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <?= view("admin/templates/atas") ?>
    <?= view("admin/templates/nav") ?>
    <div class="content-wrapper">
      <?= view("admin/templates/breadcump") ?>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Laporan -->
          <div class="row">
            <div class="col-sm-4 col-12">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?= $laporan['total'] ?></h3>
                  <p>Total Pendaftar</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="<?= site_url('admin/laporan') ?>?tahunajaran=&status=" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-sm-4 col-12">
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?= $laporan['lulus'] ?></h3>
                  <p>Total Siswa Lulus</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?= site_url('admin/laporan') ?>?tahunajaran=&status=1" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-sm-4 col-12">
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3><?= $laporan['tidak_lulus'] ?></h3>
                  <p>Total Tidak Lulus</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="<?= site_url('admin/laporan') ?>?tahunajaran=&status=0" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>

          <!-- Tabel Tahun Ajaran -->
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <button class="btn btn-success tambahModal mb-3" title="Tahun Ajaran Baru"><i class="fa fa-plus"></i> Tahun Ajaran Baru</button>
                  <table id="datatable" class="table table-bordered table-hover table-tahunajaran">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>TAHUN AJARAN</th>
                        <th>DIBUKA</th>
                        <th>DITUTUP</th>
                        <th>PENGUMUMAN</th>
                        <th>KUOTA</th>
                        <th>AKSI</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($tahun_ajarans as $key => $v) { ?>
                        <tr>
                          <td class="cell" data-id="<?= $v['id_tahun'] ?>"><?= ++$key ?></td>
                          <td class="cell" data-id="<?= $v['id_tahun'] ?>"><?= $v['tahun_ajaran'] ?></td>
                          <td class="cell" data-id="<?= $v['id_tahun'] ?>"><?= date('d F Y', strtotime($v['tanggal_buka'])) ?></td>
                          <td class="cell" data-id="<?= $v['id_tahun'] ?>"><?= date('d F Y', strtotime($v['tanggal_tutup'])) ?></td>
                          <td class="cell" data-id="<?= $v['id_tahun'] ?>"><?= date('d F Y', strtotime($v['pengumuman'])) ?></td>
                          <td class="cell" data-id="<?= $v['id_tahun'] ?>"><?= $v['kuota'] ?></td>

                          <td>
                            <a onclick="return confirm('Hapus data tahun ajaran ini?\nTindakan ini tidak dapat diurungkan.')" href="<?= site_url('admin/tahunajaran/hapus/' . $v['id_tahun']) ?>" class="btn btn-sm btn-danger" title="Hapus data"><i class="fa fa-trash"></i> Hapus</a>
                          </td>
                        </tr>
                      <?php  } ?>
                    </tbody>
                  </table>

                </div>
              </div>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <div class="modal fade" id="modalnya" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modallabel">Tambah Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="tambah" data-url="<?= site_url("admin/tahunajaran/tambah") ?>" data-refresh="refresh" id="myForm" enctype="multipart/form-data" accept-charset="utf-8">
            <div class="modal-body">
              <input type="hidden" name="id" id="id" />
              <?php
              $form = ['tahun_ajaran', 'kuota'];
              $form_date = ['tanggal_buka', 'tanggal_tutup', 'pengumuman'];
              ?>
              <div class="form-group" id="notifikasi_tahun_ajaran">
                <label for="tahun_ajaran">Tahun Ajaran</label>
                <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran" placeholder="<?= date('Y') . '/' . (date('Y') + 1) ?>" required="true" autocomplete="off">
              </div>
              <?php foreach ($form_date as $v) { ?>
                <div class="form-group" id="notifikasi_<?= $v ?>">
                  <label for="<?= $v ?>"><?= ucwords(str_replace("_", " ", $v)); ?></label>
                  <input type="date" class="form-control" id="<?= $v ?>" name="<?= $v ?>" required="true" autocomplete="off">
                </div>
              <?php } ?>
              <div class="form-group" id="notifikasi_kuota">
                <label for="kuota">Kuota</label>
                <input type="number" class="form-control" id="kuota" name="kuota" placeholder="" required="true" autocomplete="off">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary" id="submit">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <?= view("admin/templates/foot") ?>

  </div>
  <!-- ./wrapper -->
  <?= view("admin/templates/script") ?>
  <script>
    $(".tambahModal").click(function() {
      $('#modalnya .modal-header #modallabel').text('Tambah Tahun Ajaran')
      $('#modalnya #myForm').attr('data-url', '<?= site_url("admin/tahunajaran/tambah") ?>')
      $('#modalnya #myForm').trigger('reset')
      $('#modalnya').modal('show')
    })

    $('#datatable.table-tahunajaran tbody').on('click', '.cell', async function() {
      var id = $(this).data("id")
      var data = await $.get('<?= site_url('admin/tahunajaran/get/') ?>' + id)
      data = JSON.parse(data)
      $('#modalnya .modal-header #modallabel').text('Ubah Tahun Ajaran')
      $('#modalnya #myForm').attr('data-url', '<?= site_url("admin/tahunajaran/ubah/") ?>' + id)
      $('#id_tahun').val(id)
      $('#tahun_ajaran').val(data.tahun_ajaran)
      $('#kuota').val(data.kuota)
      <?php foreach ($form_date as $v) { ?>
        $('#<?= $v ?>').val(data.<?= $v ?>)
      <?php } ?>
      $('#modalnya').modal('show')
    });
  </script>
</body>

</html>