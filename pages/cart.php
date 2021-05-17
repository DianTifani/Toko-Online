<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Cart</h4>
                <div class="form-inline my-2 my-lg-0">
                  <input class="form-control mr-sm-2" name='cari' id='cari' type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success my-2 my-sm-0" type="button" onclick='cari()'>Cari</button>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama</th>
                                <th>Jumlah</th>
                                <th class='text-right'>Harga</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $batas = 5;
                        $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
                        $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	
                        $previous = $halaman - 1;
                        $next = $halaman + 1;
                        if(isset($_GET['cari'])){
                            $data = mysqli_query($koneksi,"select * from detail_penjualan join barang on detail_penjualan.barang_id = barang.barang_id where user_id='".$_SESSION['id']."' and penjualan_id = 0 and tanggal_session = '".$_SESSION['session_date']."' and nama like '%".$_GET['cari']."%'");
                        }else{
                            $data = mysqli_query($koneksi,"select * from detail_penjualan join barang on detail_penjualan.barang_id = barang.barang_id where user_id='".$_SESSION['id']."' and penjualan_id = 0 and tanggal_session = '".$_SESSION['session_date']."'");
                        }
                        $jumlah_data = mysqli_num_rows($data);
                        $total_halaman = ceil($jumlah_data / $batas);
                        if(isset($_GET['cari'])){
                            $query = mysqli_query($koneksi, "select * from detail_penjualan join barang on detail_penjualan.barang_id = barang.barang_id where user_id='".$_SESSION['id']."' and penjualan_id = 0 and tanggal_session = '".$_SESSION['session_date']."' and nama like '%".$_GET['cari']."%' limit $halaman_awal, $batas");
                        }else{
                            $query = mysqli_query($koneksi, "select * from detail_penjualan join barang on detail_penjualan.barang_id = barang.barang_id where user_id='".$_SESSION['id']."' and penjualan_id = 0 and tanggal_session = '".$_SESSION['session_date']."' limit $halaman_awal, $batas");
                        }
                        $nomor = $halaman_awal+1;
                        $no = isset($_GET['halaman'])?((int)$_GET['halaman']-1)*5+1 : 1;
                        while($data = mysqli_fetch_assoc($query)){
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $no++?></td>
                                <td><?php echo $data['nama']; ?></td>
                                <td><?php echo $data['jumlah_barang']; ?></td>
                                <td class='text-right'><?php echo $data['harga']*$data['jumlah_barang']; ?></td>
                                <td class="td-actions text-right">
                                    <button onclick="hapus(<?php echo $data['detail_id'] ?>)" rel="tooltip" class="btn btn-danger">
                                        <i class="material-icons">close</i>
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan=2></td>
                                <td>
                                    <?php
                                    $total = "";
                                    $query = mysqli_query($koneksi, "select sum(total_harga) as total from detail_penjualan join barang on detail_penjualan.barang_id = barang.barang_id where user_id='".$_SESSION['id']."' and penjualan_id = 0 and tanggal_session = '".$_SESSION['session_date']."'")or die(mysqli_error($koneksi));
                                    $row = mysqli_num_rows($query);
                                    while ($data = mysqli_fetch_assoc($query)) {
                                        ?>
                                    Jumlah Total
                                </td>
                                <td class='text-right'>
                                    <?php echo $data['total']==""?0:$data['total']; $total= $data['total'];
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                            <?php 
                                if($total==0){}else{
                            ?>
                            <td colspan=5>
                                <a href='index.php' class="btn btn-fill btn-default"> Back </a>
                                <button onclick="tambah()" rel="tooltip" class="btn btn-rose">Submit</button>
                            </td>
                                <?php } ?>
                            </tr>
                            <tr><td colspan=5>
                            <ul class="pagination justify-content-center">
			                	<li class="page-item">
			                		<a class="page-link" <?php if($halaman > 1){ echo "href='?url=cart&halaman=$previous'"; } ?>>Previous</a>
			                	</li>
			                	<?php 
			                	for($x=1;$x<=$total_halaman;$x++){
			                		?> 
			                		<li class="page-item <?php echo empty($_GET['halaman'])&&$x==1||$x==$_GET['halaman']?"active":""; ?>"><a class="page-link" href="?url=cart&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
			                		<?php
			                	}
			                	?>				
			                	<li class="page-item">
			                		<a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?url=cart&halaman=$next'"; } ?>>Next</a>
			                	</li>
			                </ul>
                            </td></tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function cari(){
    var url = document.getElementById("cari").value;
    window.location = "index.php?url=cart&cari="+url;
}
</script>
<?php
if(isset($_GET['delete'])){
    $query = mysqli_query($koneksi,"delete from detail_penjualan where detail_id = '".$_GET['delete']."'") or die(mysqli_error($koneksi));
    if($query){?>
    <script>
    swal({
        title: "Success Hapus Data !",
        text: "refreshing page ...",
        type: "success"
    }).then(function() {
        window.location = "index.php?url=cart";
    });
    </script>
    <?php }else{
    ?>
    <script>
    swal({
        title: "Gagal Hapus Data !",
        text: "refreshing page ...",
        type: "error"
    }).then(function() {
        window.location = "index.php?url=cart";
    });
    </script>
    <?php
    }
}
?>
<script>
function hapus(id){    
swal({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result) {
    window.location = "index.php?url=cart&delete="+id;
  }
})
}
function tambah(){    
swal({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, submit!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result) {
    window.location = "index.php?url=cart&tambah";
  }
})
}
</script>
<?php
if(isset($_GET['tambah'])){
    $auto = "";
    $ai = mysqli_query($koneksi,"SELECT AUTO_INCREMENT as increase FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'web_olshop' AND TABLE_NAME = 'penjualan'") or die(mysqli_error($koneksi));
    while($data = mysqli_fetch_assoc($ai)){
        $auto = $data['increase'];
    }
    $query = mysqli_query($koneksi, "update detail_penjualan set penjualan_id = $auto where user_id='".$_SESSION['id']."' and penjualan_id = 0 and tanggal_session = '".$_SESSION['session_date']."'")or die(mysqli_error($koneksi));
    if($query){
        $query2 = mysqli_query($koneksi, "insert into penjualan values ('$auto','".$_SESSION["session_date"]."','".$_SESSION["id"]."','$total','0')") or die(mysqli_error($koneksi));
        if ($query2) {
            ?>
             <script>
                swal({
                    title: "Success Submit Data !",
                    text: "Wait until aproved by admin ..",
                    type: "success"
                }).then(function() {
                    window.location = "index.php";
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
                    window.location = "index.php";
                });
            </script>
             <?php
        }
    }
    else{
        ?>
         <script>
            swal({
                title: "Gagal Tambah Data !",
                text: "failed to add data ...",
                type: "error"
            }).then(function() {
                window.location = "index.php";
            });
        </script>
         <?php
    }
}
?>