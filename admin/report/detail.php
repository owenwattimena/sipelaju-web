<?php include "template/header.php" ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin="" />
<?php include "template/navbar.php" ?>
<?php include "template/aside.php" ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Detail Laporan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="index.php?page=report">Laporan</a></li>
                        <li class="breadcrumb-item active">Detail</li>
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">

                                    <div class="col-md-4">
                                        <label class="font-weight-normal">Tanggal</label>
                                    </div>
                                    <div class="col-md-8 font-weight-bold">
                                        <div class="form-group">
                                            <input type="text" class="form-control rounded-0"
                                                value="<?= $data['laporan']['tanggal'] ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="font-weight-normal">Status</label>
                                    </div>
                                    <div class="col-md-8 font-weight-bold">
                                        <div class="form-group">
                                            <input type="text" class="form-control rounded-0"
                                                value="<?= $data['laporan']['status'] ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="font-weight-normal">Username Pelapor</label>
                                    </div>
                                    <div class="col-md-8 font-weight-bold">
                                        <div class="form-group">
                                            <input type="text" class="form-control rounded-0"
                                                value="<?= $data['laporan']['username'] ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="font-weight-normal">Lokasi</label>
                                    </div>
                                    <div class="col-md-8 font-weight-bold">
                                        <div class="form-group">
                                            <input type="text" class="form-control rounded-0"
                                                value="<?= $data['laporan']['lokasi'] ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="font-weight-normal">Keterangan</label>
                                    </div>
                                    <div class="col-md-8 font-weight-bold">
                                        <div class="form-group">
                                            <input type="text" class="form-control rounded-0"
                                                value="<?= $data['laporan']['keterangan'] ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="col-md-6">
                                <img class="w-100 pb-3" src="<?= "../storage/" .  $data['laporan']['foto']  ?>" alt="">
                            </div>
                            <div class="col-md-6">
                                <div id="map" class="map map-home" style="height: 500px;"></div>
                            </div>
                        </div>
                        <hr>
                        <form action="" method="POST">
                            <!-- <label for="">Ubah Status</label> -->
                            <div class="row mt-5">
                                <div class="col-sm-4">
                                    <button type="submit" name="tolak" class="btn btn-danger btn-block rounded-0 mb-3">
                                        <i class="fa fa-ban"></i>
                                        TOLAK
                                    </button>
                                </div>
                                <div class="col-sm-4">
                                    <button type="submit" name="periksa"
                                        class="btn btn-primary btn-block rounded-0 mb-3">
                                        <i class="fa fa-check"></i>
                                        PERIKSA
                                    </button>
                                </div>
                                <div class="col-sm-4">
                                    <button type="submit" name="selesai"
                                        class="btn btn-success btn-block rounded-0 mb-3">
                                        <i class="fa fa-check-circle"></i>
                                        SELESAI
                                    </button>
                                </div>
                            </div>
                        </form>
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
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
<script>
let latitude = `<?= $data['laporan']['latitude'] ?>`;
let longitude = `<?= $data['laporan']['longitude'] ?>`;
let map = L.map('map').setView([ /*LATITUDE*/ latitude, /*LOGNITUDE*/ longitude], 50);
// map.panBy([0, 3500]);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

L.marker([latitude, longitude]).addTo(map);
L.marker([latitude, longitude]).addTo(map)
    .bindPopup(`<?= $data['laporan']['keterangan'] ?>`)
    .openPopup();
</script>