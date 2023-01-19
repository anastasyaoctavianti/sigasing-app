<?php include_once "partials/cssdatatables.php" ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Karyawan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="?page=home">Home</a>
                    </li>
                    <li class="breadcrumb-item">Karyawan</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Karyawan</h3>
            <a href="?page=karyawancreate" class="btn btn-success btn-sm float-right">
                <i class="fa fa-plus-circle"></i> Tambah Data
            </a>
        </div>
        <div class="card-body">
            <table id="mytable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Karyawan</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tfoot>
                    <th>No</th>
                    <th>Nama karyawan</th>
                    <th>Opsi</th>
                </tfoot>                
                <tbody>
                    <?php
                        include_once "database/database.php"; 
                        $database = new Database();
                        $db = $database->getConnection();

                        $selectSql = "SELECT * FROM karyawan";

                        $stmt = $db->prepare($selectSql);
                        $stmt->execute();

                        $no = 1;
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['nama_lengkap'] ?></td>
                        <td>
                            <a href="?page=karyawanupdate&id=<?= $row['id'] ?>" class="btn btn-primary btn-sm mr-1">
                                <i class="fa fa-edit"></i> Ubah
                            </a>
                            <a href="?page=karyawandlete&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm mr-1" onclick="javascript: return confirm('Konfirmasi data akan dihapus?);">
                                <i class="fa fa-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>                
            </table>
        </div>
    </div>
</div>

<?php include_once "partials/scripts.php" ?>
<?php include_once "partials/scriptsdatatables.php" ?>
<script>
    $(function() {
        $('#mytable').DataTable()
    });
</script>