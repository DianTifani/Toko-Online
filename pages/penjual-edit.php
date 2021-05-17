<?php
if(isset($_GET['edit'])){
    $nama="";
    $alamat="";
    $query = mysqli_query($koneksi,"select * from penjual where penjual_id = '".$_GET['edit']."'");
    while($data = mysqli_fetch_assoc($query)){
        $nama = $data['nama'];
        $alamat = $data['alamat'];
    }
}
?>
<div class="col-md-10 col-md-offset-1">
    <div class="card">
        <div class="card-header card-header-icon" data-background-color="rose">
            <i class="material-icons">contacts</i>
        </div>
        <div class="card-content">
            <h4 class="card-title"><?php if(isset($_GET['edit'])){echo "Edit";}else{echo "Tambah";}?> Penjual</h4>
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
                    <label class="col-md-3 label-on-left">Alamat</label>
                    <div class="col-md-7">
                        <div class="form-group label-floating is-empty">
                            <label class="control-label"></label>
                            <input name='alamat' type="text" value="<?php echo isset($_GET['edit'])?$alamat:""; ?>" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3"></label>
                    <div class="col-md-9">
                        <div class="form-group form-button">
                            <a href='index.php?url=penjual' class="btn btn-fill btn-default"> Back </a>
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
    $query = mysqli_query($koneksi, "insert into penjual(nama,alamat) values ('".$_POST['nama']."','".$_POST['alamat']."')") or die(mysqli_error($koneksi));
    if ($query) {
        ?>
         <script>
            swal({
                title: "Success Tambah Data !",
                text: "refreshing page ...",
                type: "success"
            }).then(function() {
                window.location = "index.php?url=penjual-tambah";
            });
        </script>
         <?php
    }else{
        ?>
         <script>
            swal({
                title: "Gagal Tambah Data !",
                text: "failed to add data ...",
                type: "error"
            }).then(function() {
                window.location = "index.php?url=penjual-tambah";
            });
        </script>
         <?php
    }
}

// ============================= EDIT ============================

if(isset($_POST['edit'])){
    $query = mysqli_query($koneksi,"update penjual set nama='".$_POST['nama']."', alamat='".$_POST['alamat']."' where penjual_id = '".$_POST['id']."'") or die(mysqli_error($koneksi));
    if ($query) {
        ?>
         <script>
            swal({
                title: "Success Update Data !",
                text: "refreshing page ...",
                type: "success"
            }).then(function() {
                window.location = "index.php?url=penjual";
            });
        </script>
         <?php
    }else{
        ?>
         <script>
            swal({
                title: "Gagal Update Data !",
                text: "failed to update data ...",
                type: "error"
            }).then(function() {
                window.location = "index.php?url=penjual";
            });
        </script>
         <?php
    }
}
?>
                        