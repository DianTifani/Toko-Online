<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Detail Penjualan</h4>
                <div class="form-inline my-2 my-lg-0">
                  <input class="form-control mr-sm-2" name='cari' id='cari' type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success my-2 my-sm-0" type="button" onclick='cari()'>Cari</button>
                  <a class="btn btn-rose" href='index.php?url=penjualan'>Back</a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Barang</th>
                                <th>Jumlah</th>
                                <th>Total Perbarang</th>
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
                            $data = mysqli_query($koneksi,"select * from detail_penjualan left join barang on detail_penjualan.barang_id = barang.barang_id where detail_penjualan.penjualan_id = '".$_GET['id']."' and barang.nama like '%".$_GET['cari']."%'");
                        }else{
                            $data = mysqli_query($koneksi,"select * from detail_penjualan left join barang on detail_penjualan.barang_id = barang.barang_id where detail_penjualan.penjualan_id = '".$_GET['id']."'");
                        }
                        $jumlah_data = mysqli_num_rows($data);
                        $total_halaman = ceil($jumlah_data / $batas);
                        if(isset($_GET['cari'])){
                            $query = mysqli_query($koneksi, "select * from detail_penjualan left join barang on detail_penjualan.barang_id = barang.barang_id where detail_penjualan.penjualan_id = '".$_GET['id']."' and barang.nama like '%".$_GET['cari']."%' limit $halaman_awal, $batas");
                        }else{
                            $query = mysqli_query($koneksi, "select * from detail_penjualan left join barang on detail_penjualan.barang_id = barang.barang_id where detail_penjualan.penjualan_id = '".$_GET['id']."' limit $halaman_awal, $batas");
                        }
                        $nomor = $halaman_awal+1;
                        $no = isset($_GET['halaman'])?((int)$_GET['halaman']-1)*5+1 : 1;
                        while($data = mysqli_fetch_assoc($query)){
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $no++?></td>
                                <td><?php echo $data['nama']; ?></td>
                                <td><?php echo $data['jumlah_barang']; ?></td>
                                <td><?php echo $data['total_harga']; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr><td colspan=5>
                            <ul class="pagination justify-content-center">
			                	<li class="page-item">
			                		<a class="page-link" <?php if($halaman > 1){ echo "href='?url=detail_penjualan&halaman=$previous'"; } ?>>Previous</a>
			                	</li>
			                	<?php 
			                	for($x=1;$x<=$total_halaman;$x++){
			                		?> 
			                		<li class="page-item <?php echo empty($_GET['halaman'])&&$x==1||$x==$_GET['halaman']?"active":""; ?>"><a class="page-link" href="?url=detail_penjualan&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
			                		<?php
			                	}
			                	?>				
			                	<li class="page-item">
			                		<a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?url=detail_penjualan&halaman=$next'"; } ?>>Next</a>
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
    window.location = "index.php?url=detail_penjualan&cari="+url;
}
</script>