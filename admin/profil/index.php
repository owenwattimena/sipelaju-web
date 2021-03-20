<?php include "template/header.php" ?>

<?php include "template/navbar.php" ?>
<?php include "template/aside.php" ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Profil</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Profil</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row justify-content-between">
                <div class="card col-md-7">
                    <div class="card-header">
                        <h3 class="card-title">Profil</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group mt-4">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" placeholder="Masukan nama" name="nama"
                                    value="<?= $_SESSION['loged']['user']['nama'] ?>" required>

                            </div>
                            <div class="form-group mt-4">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" placeholder="Masukan username"
                                    name="username" value="<?= $_SESSION['loged']['user']['username'] ?>" required>

                            </div>

                            <button type="submit" name="submit" class="btn btn-dark btn-block my-3">UBAH</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card col-md-4">
                    <div class="card-header">
                        <h3 class="card-title">Password</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group mt-4">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Masukan password"
                                    name="password" value="" required>

                            </div>

                            <button type="submit" name="submit-password" class="btn btn-warning btn-block my-3">UBAH
                                PASSWORD</button>
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