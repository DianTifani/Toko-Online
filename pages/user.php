<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Data User</h4>
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
                                <th>username</th>
                                <th>Password</th>
                                <th>Role</th>
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
                            $data = mysqli_query($koneksi,"select * from user where nama like '%".$_GET['cari']."%' or username like '%".$_GET['cari']."%'");
                        }else{
                            $data = mysqli_query($koneksi,"select * from user");
                        }
                        $jumlah_data = mysqli_num_rows($data);
                        $total_halaman = ceil($jumlah_data / $batas);
                        if(isset($_GET['cari'])){
                            $query = mysqli_query($koneksi, "select * from user where nama like '%".$_GET['cari']."%' or username like '%".$_GET['cari']."%' limit $halaman_awal, $batas");
                        }else{
                            $query = mysqli_query($koneksi, "select * from user limit $halaman_awal, $batas");
                        }
                        $nomor = $halaman_awal+1;
                        $no = isset($_GET['halaman'])?((int)$_GET['halaman']-1)*5+1 : 1;
                        while($data = mysqli_fetch_assoc($query)){
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $no++?></td>
                                <td><?php echo $data['nama'] ?></td>
                                <td><?php echo $data['username'] ?></td>
                                <td><?php echo $data['password'] ?></td>
                                <td><?php echo $data['role'] ?></td>
                                <td class="td-actions text-right">
                                    <a href='index.php?url=user-edit&edit=<?php echo $data['user_id']?>' rel="tooltip" class="btn btn-success">
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <button onclick="hapus(<?php echo $data['user_id'] ?>)" rel="tooltip" class="btn btn-danger">
                                        <i class="material-icons">close</i>
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr><td colspan=6>
                            <ul class="pagination justify-content-center">
			                	<li class="page-item">
			                		<a class="page-link" <?php if($halaman > 1){ echo "href='?url=user&halaman=$previous'"; } ?>>Previous</a>
			                	</li>
			                	<?php 
			                	for($x=1;$x<=$total_halaman;$x++){
			                		?> 
			                		<li class="page-item <?php echo empty($_GET['halaman'])&&$x==1||$x==$_GET['halaman']?"active":""; ?>"><a class="page-link" href="?url=user&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
			                		<?php
			                	}
			                	?>				
			                	<li class="page-item">
			                		<a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?url=user&halaman=$next'"; } ?>>Next</a>
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
    window.location = "index.php?url=user&cari="+url;
}
</script>
<?php
// ====================== DELETE ===================
if(isset($_GET['delete'])){
    $query = mysqli_query($koneksi,"delete from user where user_id = '".$_GET['delete']."'") or die(mysqli_error($koneksi));
    if($query){?>
    <script>
    swal({
        title: "Success Hapus Data !",
        text: "refreshing page ...",
        type: "success"
    }).then(function() {
        window.location = "index.php?url=user";
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
        window.location = "index.php?url=user";
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
    window.location = "index.php?url=user&delete="+id;
  }
})
}
</script>