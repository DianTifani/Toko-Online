<?php
if (isset($_GET['edit'])) {
    $nama="";
    $harga="";
    $stock="";
    $penjual_id ="";
    $query = mysqli_query($koneksi, "select * from barang where barang_id = '".$_GET['edit']."'");
    while ($data = mysqli_fetch_assoc($query)) {
        $nama = $data['nama'];
        $harga = $data['harga'];
        $stock= $data['stock'];
        $penjual_id = $data["penjual_id"];
    }
}
?>
<div class="col-md-10 col-md-offset-1">
    <div class="card">
        <div class="card-header card-header-icon" data-background-color="rose">
            <i class="material-icons">contacts</i>
        </div>
        <div class="card-content">
            <h4 class="card-title"><?php if (isset($_GET['edit'])) {
    echo "Edit";
} else {
    echo "Tambah";
}?> Barang</h4>
              <form class="form-horizontal" action="" method="post">
                <input type="hidden" readonly name="id" id='id' value="<?php echo isset($_GET['edit'])?$_GET['edit']:""; ?>">
                <div class="row">
                    <label class="col-md-3 label-on-left">Nama</label>
                    <div class="col-md-7">
                        <div class="form-group label-floating is-empty">
                            <label class="control-label"></label>
                            <input name='nama' type="text" value="<?php echo isset($_GET['edit'])?$nama:""; ?>" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 label-on-left">Harga</label>
                    <div class="col-md-7">
                        <div class="form-group label-floating is-empty">
                            <label class="control-label"></label>
                            <input name='harga' type="number" value="<?php echo isset($_GET['edit'])?$harga:""; ?>" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 label-on-left">Stock</label>
                    <div class="col-md-7">
                        <div class="form-group label-floating is-empty">
                            <label class="control-label"></label>
                            <input name='stock' type="number" value="<?php echo isset($_GET['edit'])?$stock:""; ?>" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 label-on-left">Penjual</label>
                    <div class="col-md-7">
                        <div class="form-group label-floating is-empty">
                            <select class="selectpicker" name="penjual_id" data-style="select-with-transition" title="Pilih Penjual ( Supplier )" required>
                                <?php
                                $query = mysqli_query($koneksi, "select * from penjual");
                                while ($data = mysqli_fetch_assoc($query)) {
                                    ?>
                                <option value="<?php echo $data['penjual_id'] ?>" <?php if (isset($_GET['edit'])) {echo $data['penjual_id']==$_GET['cek']?"selected":"";} ?> ><?php echo $data['nama'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3"></label>
                    <div class="col-md-9">
                        <div class="form-group form-button">
                            <a href='index.php?url=barang' class="btn btn-fill btn-default"> Back </a>
                            <input name='<?php echo isset($_GET['edit'])?"edit":"submit"; ?>' type="submit" class="btn btn-fill btn-rose" value="<?php echo isset($_GET['edit'])?"Edit":"Tambah"; ?>">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ============================= TAMBAH ======================= -->
<?php
if (isset($_POST['submit'])) {
$query = mysqli_query($koneksi, "insert into barang(nama,harga,stock,penjual_id) values ('".$_POST['nama']."','".$_POST['harga']."','".$_POST['stock']."','".$_POST['penjual_id']."')") or die(mysqli_error($koneksi));
if ($query) {
 ?>
         <script>
            swal({
                title: "Success Tambah Data !",
                text: "refreshing page ...",
                type: "success"
            }).then(function() {
                window.location = "index.php?url=barang-tambah";
            });
        </script>
         <?php
             } else {
        ?>
         <script>
            swal({
                title: "Gagal Tambah Data !",
                text: "failed to add data ...",
                type: "error"
            }).then(function() {
                window.location = "index.php?url=barang-tambah";
            });
        </script>
         <?php
                                    }
                                }

// ============================= EDIT ============================
if (isset($_POST['edit'])) {
    $query = mysqli_query($koneksi, "update barang set nama='".$_POST['nama']."', harga='".$_POST['harga']."', stock='".$_POST['stock']."', penjual_id='".$_POST['penjual_id']."' where barang_id = '".$_POST['id']."'") or die(mysqli_error($koneksi));
    if ($query) {
        ?>
         <script>
            swal({
                title: "Success Update Data",
                text: "refreshing page ...",
                type: "success"
            }).then(function() {
                window.location = "index.php?url=barang";
            });
        </script>
         <?php
    } else {
        ?>
         <script>
            swal({
                title: "Gagal Update Data !",
                text: "failed to update data ...",
                type: "error"
            }).then(function() {
                window.location = "index.php?url=barang";
            });
        </script>
         <?php
    }
}
?>