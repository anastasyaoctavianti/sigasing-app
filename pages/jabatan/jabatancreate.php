<!-- Lokasi Create -->

<?php include_once "partials/cssdatatables.php" ?>

<?php
if (isset($_POST['button_create'])) {
   
    $database = new Database();
    $db = $database->getConnection();

    $validateSQL = "SELECT * FROM jabatan WHERE id = ?";
    $stmt = $db->prepare($validateSQL);
    $stmt->bindParam(1, $_POST['id']);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
    ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <h5><i class="icon fas fa-ban"></i> Gagal</h5>
            Nama Jabatan sudah ada
        </div>
    <?php    
    } else {    
        $insertSQL = "INSERT INTO jabatan VALUES (NULL, ?, ?, ?, ?)";
        $stmt = $db->prepare($insertSQL);
        $stmt->bindParam(1, $_POST['id']);
        $stmt->bindParam(2, $_POST['nama_jabatan']);
        $stmt->bindParam(3, $_POST['gapok']);
        $stmt->bindParam(4, $_POST['tunjangan']);
        $stmt->bindParam(5, $_POST['uang_makan']);

        if ($stmt->execute()) {

            $pengguna_id = $db->lastInsertId();

            $insertJabatanSql = "INSERT INTO jabatan VALUES (NULL, ?, ?, ?, ?)";
            $stmtJabatan = $db->prepare($insertJabatanSql);
            $stmtJabatan->bindParam(1, $_POST['id']);
            $stmtJabatan->bindParam(2, $_POST['nama_jabatan']);
            $stmtJabatan->bindParam(3, $_POST['gapok']);
            $stmtJabatan->bindParam(4, $_POST['tunjangan']);
            $stmtJabatan->bindParam(5, $_POST['uang_makan']);
            $stmtJabatan->bindParam(6, $pengguna_id);
        
            if ($stmt->execute()) {
                $_SESSION['hasil'] = true;
                $_SESSION['pesan'] = "Berhasil simpan data";
            } else {
                $_SESSION['hasil'] = false;
                $_SESSION['pesan'] = "Gagal simpan data";

        }
        echo "<meta http-equiv='refresh' content='0;url=?page=jabatanread'>";
    }
}
}
?>

<section class="content-header">
    <div class="container-fluid">
        <?php
        if (isset($_SESSION["hasil"])) {
            if ($_SESSION['hasil']) {
        ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h5><i class="icon fas fa-check"></i> Berhasil</h5>
                <?= $_SESSION["pesan"] ?>
            </div>
        <?php
            } else {
        ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h5><i class="icon fas fa-ban"></i> Gagal</h5>
                <?= $_SESSION["pesan"] ?>
            </div>
        <?php
            }
            unset($_SESSION["hasil"]);
            unset($_SESSION["pesan"]);
        }
        ?>
        <div class="row mb2">
            <div class="col-sm-6">
                <h1>Tambah Data Jabatan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                    <li class="breadcrumb-item"><a href="?page=lokasiread">Jabatan</a></li>
                    <li class="breadcrumb-item active">Tambah Data</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Jabatan</h3>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                    <label for="nama_lokasi">Nama Jabatan</label>
                    <input type="text" class="form-control" name="nama_jabatan">
                </div>
                <div class="form-group">
                    <label for="gapok_jabatan">Gaji Pokok</label>
                    <input type="number" class="form-control" name="gapok_jabatan"
                        onkeypress='return (even,charCode > 47 && event,charCode < 58) || event.charCode == 46'
                    >
                </div>
                <div class="form-group">
                    <label for="tunjangan_jabatan">Tunjangan</label>
                    <input type="number" class="form-control" name="tunjangan_jabatan"
                        onkeypress='return (even,charCode > 47 && event,charCode < 58) || event.charCode == 46'
                    >
                </div>
                <div class="form-group">
                    <label for="uang_makan_perhari">Uang Makan Perhari</label>
                    <input type="number" class="form-control" name="uang_makan_perhari"
                        onkeypress='return (even,charCode > 47 && event,charCode < 58) || event.charCode == 46'
                    >
                    <a href="?page=jabatanread" class="btn btn-danger btn-sm float-right">
                    <i class="fa fa-times"></i> Batal
                </a>
                <button type="submit" name="button_create" class="btn btn-success btn-sm float-right">
                    <i class="fa fa-save"></i> Simpan
                </button>
                    </button>
            </form>
        </div>
    </div>
</section>

<?php include_once "partials/scripts.php" ?>