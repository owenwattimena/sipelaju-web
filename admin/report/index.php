<?php include "template/header.php" ?>
<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<?php include "template/navbar.php" ?>
<?php include "template/aside.php" ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Laporan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Laporan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Laporan</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Username Pelapor</th>
                                    <th>Lokasi</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['laporan'] as $laporan) : ?>
                                <tr>
                                    <td><?= $laporan['tanggal'] ?></td>
                                    <td class="text-center">
                                        <?php
                                        switch ($laporan['status']) {
                                            case 'DITERIMA':
                                                $badge = 'warning';
                                                break;
                                            case 'DIPERIKSA':
                                                $badge = 'primary';
                                                break;
                                            case 'DITOLAK':
                                                $badge = 'danger';
                                                break;    
                                            default:
                                                $badge = 'success';
                                                break;
                                        }
                                        ?>
                                        <div class="badge badge-pill badge-<?= $badge ?>">
                                            <?php
                                        switch ($laporan['status']) {
                                            case 'DITERIMA':
                                                echo("BELUM DIPERIKSA");
                                                break;
                                            case 'DIPERIKSA':
                                                echo("DIPERIKSA");
                                                break;
                                            case 'DITOLAK':
                                                echo("DITOLAK");
                                                break;
                                            
                                            default:
                                                echo("SELESAI");
                                                break;
                                        }
                                        ?>
                                        </div>
                                    </td>
                                    <td><?= $laporan['username'] ?></td>
                                    <td><?= $laporan['lokasi'] ?></td>
                                    <td><?= $laporan['keterangan'] ?></td>
                                    <!-- <?= $laporan['status'] ?> -->
                                    <td>
                                        <a href="index.php?page=report&id=<?= $laporan['id'] ?>"
                                            class="btn btn-success rounded-0 btn-sm">
                                            <i class="fa fa-eye"></i> | DETAIL
                                        </a>
                                        <a onclick="return confirm('Yakin Ingin Menghapus Laporan?')"
                                            href="index.php?page=report&id=<?= $laporan['id'] ?>&action=delete"
                                            class="btn btn-danger rounded-0 btn-sm">
                                            <i class="fa fa-trash"></i> | HAPUS
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr class="text-center">
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Username Pelapor</th>
                                    <th>Alamat</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include "template/footer.php" ?>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
$(function() {
    $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
            "ordering": true,
            "info": true,
        }).order([0, 'desc'])
        .draw();
});
</script>