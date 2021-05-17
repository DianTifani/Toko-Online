<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Penjualan</h4>
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
                                <th>Tanggal</th>
                                <th>Total Harga</th>
                                <th>Status</th>
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
                        if($_SESSION['role'] =="Admin"){
                            if(isset($_GET['cari'])){
                                $data = mysqli_query($koneksi,"select * from penjualan left join user on penjualan.user_id = user.user_id and user.nama like '%".$_GET['cari']."%'");
                            }else{
                                $data = mysqli_query($koneksi,"select * from penjualan left join user on penjualan.user_id = user.user_id") or die(mysqli_error($koneksi));
                            }
                        }else{
                            if(isset($_GET['cari'])){
                                $data = mysqli_query($koneksi,"select * from penjualan left join user on penjualan.user_id = user.user_id where penjualan.user_id='".$_SESSION['id']."' and user.nama like '%".$_GET['cari']."%'");
                            }else{
                                $data = mysqli_query($koneksi,"select * from penjualan left join user on penjualan.user_id = user.user_id where penjualan.user_id='".$_SESSION['id']."'") or die(mysqli_error($koneksi));
                            }
                        }
                        $jumlah_data = mysqli_num_rows($data);
                        $total_halaman = ceil($jumlah_data / $batas);
                        if ($_SESSION['role'] =="Admin") {
                            if (isset($_GET['cari'])) {
                                $query = mysqli_query($koneksi, "select * from penjualan left join user on penjualan.user_id = user.user_id and user.nama like '%".$_GET['cari']."%' limit $halaman_awal, $batas");
                            } else {
                                $query = mysqli_query($koneksi, "select * from penjualan left join user on penjualan.user_id = user.user_id limit $halaman_awal, $batas");
                            }
                        }
                        else{
                            if (isset($_GET['cari'])) {
                                $query = mysqli_query($koneksi, "select * from penjualan left join user on penjualan.user_id = user.user_id where penjualan.user_id='".$_SESSION['id']."' and user.nama like '%".$_GET['cari']."%' limit $halaman_awal, $batas");
                            } else {
                                $query = mysqli_query($koneksi, "select * from penjualan left join user on penjualan.user_id = user.user_id where penjualan.user_id='".$_SESSION['id']."' limit $halaman_awal, $batas");
                            }

                        }
                        $nomor = $halaman_awal+1;
                        $no = isset($_GET['halaman'])?((int)$_GET['halaman']-1)*5+1 : 1;
                        while($data = mysqli_fetch_assoc($query)){
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $no++?></td>
                                <td><?php echo $data['nama']; ?></td>
                                <td><?php echo $data['tanggal_penjualan']; ?></td>
                                <td><?php echo $data['total_harga']; ?></td>
                                <td><?php echo $data['status']==1?"Telah disetujui":"Belum disetujui"?></td>
                                <td class="td-actions text-right">
                                    <a href='index.php?url=detail_penjualan&id=<?php echo $data['penjualan_id']?>' rel="tooltip" title='detail' class="btn btn-default">
                                        <i class="material-icons" >playlist_add_check</i>
                                    </a>
                                    <?php if($_SESSION['role']=="Admin") { ?>
                                    <a href='index.php?url=penjualan&approve=<?php echo $data['penjualan_id'] ?>' rel="tooltip" title='setujui' class="btn btn-success">
                                        <i class="material-icons" >check_circle</i>
                                    </a>
                                    <button onclick="hapus(<?php echo $data['penjualan_id'] ?>)" title='delete' rel="tooltip" class="btn btn-danger">
                                        <i class="material-icons">close</i>
                                    </button>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr><td colspan=5>
                            <ul class="pagination justify-content-center">
			                	<li class="page-item">
			                		<a class="page-link" <?php if($halaman > 1){ echo "href='?url=penjualan&halaman=$previous'"; } ?>>Previous</a>
			                	</li>
			                	<?php 
			                	for($x=1;$x<=$total_halaman;$x++){
			                		?> 
			                		<li class="page-item <?php echo empty($_GET['halaman'])&&$x==1||$x==$_GET['halaman']?"active":""; ?>"><a class="page-link" href="?url=penjualan&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
			                		<?php
			                	}
			                	?>				
			                	<li class="page-item">
			                		<a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?url=penjualan&halaman=$next'"; } ?>>Next</a>
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
    window.location = "index.php?url=penjualan&cari="+url;
}
</script>
<?php
if(isset($_GET['delete'])){
    $query = mysqli_query($koneksi,"delete from penjualan where penjualan_id = '".$_GET['delete']."'") or die(mysqli_error($koneksi));
    if($query){?>
    <script>
    swal({
        title: "Success Hapus Data !",
        text: "refreshing page ...",
        type: "success"
    }).then(function() {
        window.location = "index.php?url=penjualan";
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
        window.location = "index.php?url=penjualan";
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
    window.location = "index.php?url=penjualan&delete="+id;
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
    window.location = "index.php?url=penjualan&tambah";
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
    $query = mysqli_query($koneksi, "update penjualan set penjualan_id = $auto where user_id='".$_SESSION['id']."' and penjualan_id = 0 and tanggal_session = '".$_SESSION['session_date']."'")or die(mysqli_error($koneksi));
    if($query){
        $query2 = mysqli_query($koneksi, "insert into penjualan values ('$auto','".$_SESSION["session_date"]."','".$_SESSION["id"]."','$total')") or die(mysqli_error($koneksi));
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
<?php
if(isset($_GET['approve'])){
    $query = mysqli_query($koneksi,'update penjualan set status = 1 where penjualan_id = "'.$_GET['approve'].'"');
    if ($query) {
        ?>
         <script>
            swal({
                title: "Data Approved !",
                text: "refreshing page ...",
                type: "success"
            }).then(function() {
                window.location = "index.php?url=penjualan";
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
                window.location = "index.php?url=penjualan";
            });
        </script>
         <?php
    }
}
?>