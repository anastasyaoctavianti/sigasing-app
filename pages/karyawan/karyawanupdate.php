<?php include_once "partials/scripts.php" ?>
<?php
if (isset($_GET['id'])) {

    $database = new Database();
    $db = $database->getConnection();

    // $id = $_GET['id'];
    $findSql = "SELECT A.*, B.username, B.peran, B.id ID_Pengguna FROM karyawan A left join pengguna B on A.pengguna_id = B.id WHERE A.id = ?";
    $stmt = $db->prepare($findSql);
    $stmt->bindParam(1, $_GET['id']);
    $stmt->execute();
    $row = $stmt->fetch();
    if (isset($row['id'])) {
        if (isset($_POST['button_update'])) {
            $database = new Database();
            $db = $database->getConnection();

            $validateSql = "SELECT * FROM karyawan where nama_lengkap = ? AND id != ?";
            $stmt = $db->prepare($validateSql);
            $stmt->bindParam(1, $_POST['nama_lengkap']);
            $stmt->bindParam(2, $_POST['id']);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" data-miss="alert" aria-hidden="true" class="close">x</button>
                    <h5><i class="icon fas fa-ban"> Gagal</i></h5>
                    Nama karyawan sama sudah ada
                </div>
        <?php
            } else {
                // User mau ganti password dan password ulang tidak sama
                if($_POST['password'] != "" && ($_POST['password'] != $_POST['password_ulangi'])) { ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" data-miss="alert" aria-hidden="true" class="close">x</button>
                        <h5><i class="icon fas fa-ban"> Gagal</i></h5>
                        Password tidak sama
                    </div>
                <?php } else {
                    // Tidak ganti password || Ganti password dan validasi sukses
                    // Update tabel Karyawan
                    $passwordBaru = $_POST['password'] != "";
                    
                    $updatePengguna = "UPDATE pengguna SET 
                    username = ?,". ($passwordBaru ? " password = ?," : ""). "peran = ? WHERE id = ?";
                    echo $updatePengguna;
                    $stmtPengguna = $db->prepare($updatePengguna);
                    $stmtPengguna->bindParam(1, $_POST['username']);
                    if($passwordBaru) {
                        $passwordHash = md5($_POST['password']);
                        $stmtPengguna->bindParam(2, $passwordHash);
                        $stmtPengguna->bindParam(3, $_POST['peran']);
                        $stmtPengguna->bindParam(4, $_POST['ID_Pengguna']);
                    } else {
                        $stmtPengguna->bindParam(2, $_POST['peran']);
                        $stmtPengguna->bindParam(3, $_POST['ID_Pengguna']);
                    }

                    if($stmt->execute()) {
                        // Update tabel Karyawan
                        $updateKaryawanSql = "UPDATE karyawan SET 
                        nama_lengkap = ?, handphone = ?, email = ?, tanggal_masuk = ? WHERE nik = ?";
                        $stmtKaryawan = $db->prepare($updateKaryawanSql);
                        $stmtKaryawan->bindParam(1, $_POST['nama_lengkap']);
                        $stmtKaryawan->bindParam(2, $_POST['handphone']);
                        $stmtKaryawan->bindParam(3, $_POST['email']);
                        $stmtKaryawan->bindParam(4, $_POST['tanggal_masuk']);
                        $stmtKaryawan->bindParam(5, $_POST['nik']);
                        if ($stmtKaryawan->execute()) {
                            $_SESSION['hasil'] = true;
                        } else {
                            $_SESSION['hasil'] = false;
                        }
                        echo "<meta http-equiv='refresh' content='0;url=?page=karyawanread'>";
                    }
                }

                

            }
        }
        ?>
        <section class="content-header">
            <div class="containerfluid">
                <div class="row mb2">
                    <div class="col-sm-6">
                        <h1>Ubah Data Karyawan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                            <li class="breadcrumb-item"><a href="?page=karyawanread">Karyawan</a></li>
                            <li class="breadcrumb-item active">Ubah Data</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ubah Karyawan</h3>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label for="nik">Nomor Induk Karyawan</label>
                            <input type="hidden" class="form-control" name="ID_Pengguna" value="<?= $row['ID_Pengguna'] ?>" readonly>
                            <input type="text" class="form-control" name="nik" value="<?= $row['nik'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_lengkap" value="<?= $row['nama_lengkap'] ?>" >
                        </div>
                        <div class="form-group">
                            <label for="handphone">Handphone</label>
                            <input type="number" class="form-control" name="handphone" value="<?= $row['handphone'] ?>"  onkeypress="'return (event.charCode > 47 && event.charCode < 58) || event.charCode == 46'">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" value="<?= $row['email'] ?>" >
                        </div>
                        <div class="form-group">
                            <label for="tanggal_masuk">Tanggal Masuk</label>
                            <input type="date" class="form-control" name="tanggal_masuk" value="<?= $row['tanggal_masuk'] ?>" >
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" value="<?= $row['username'] ?>" >
                        </div>
                        <div class="form-group">
                            <label for="password">Password Baru</label>
                            <input type="password" class="form-control" name="password" >
                        </div>
                        <div class="form-group">
                            <label for="password_ulangi">Password Ulangi</label>
                            <input type="password" class="form-control" name="password_ulangi">
                        </div>
                        <div class="form-group">
                            <label for="peran">Peran</label>
                            <select class="form-control" name="peran">
                                <option value="">-- Pilih Peran --</option>
                                <option value="ADMIN" <?= $row['peran'] == "ADMIN" ? " selected" : "" ?>>ADMIN</option>
                                <option value="USER" <?= $row['peran'] == "USER" ? " selected" : "" ?>>USER</option>
                            </select>
                        </div>
                        <a href="?page=karyawanread" class="btn btn-danger btn-sm float-right">
                            <i class="fa fa-times"></i> Batal
                        </a>
                        <button type="submit" name="button_update" class="btn btn-success btn-sm float-right">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                    </form>
                </div>
            </div>
        </section>
<?php
    } else {
        echo "<meta http-equiv='refresh' content='0;url=?page=karyawanread'>";
    }
} else {
    echo "<meta http-equiv='refresh' content='0;url=?page=karyawanread'>";
}
?>

?>