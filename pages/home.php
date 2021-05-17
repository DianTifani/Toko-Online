<div class="header text-center">
    <h3 class="title">Barang Penjualan</h3>
    <p class="category">
        Barang bagus harga murah
    </p>
</div>
<div class='row'>
    <div class="form-inline my-2 my-lg-0 pull-right">
      <input class="form-control mr-sm-2" name='cari' id='cari' type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="button" onclick='cari()'>Cari</button>
    </div>
</div>
<div class="row">
<script>
    var barang = [];
</script>
<?php
$batas = 4;
$halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	
$previous = $halaman - 1;
$next = $halaman + 1;
if(isset($_GET['cari'])){
    $data = mysqli_query($koneksi,"select * from barang where nama like '%".$_GET['cari']."%'");
}else{
    $data = mysqli_query($koneksi,"select * from barang");
}
$jumlah_data = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);
if(isset($_GET['cari'])){
    $query = mysqli_query($koneksi, "select * from barang where nama like '%".$_GET['cari']."%' limit $halaman_awal, $batas");
}else{
    $query = mysqli_query($koneksi, "select * from barang limit $halaman_awal, $batas");
}
$nomor = $halaman_awal+1;
$no = isset($_GET['halaman'])?((int)$_GET['halaman']-1)*4+1 : 1;
while ($data = mysqli_fetch_assoc($query)) {
    ?>
    <div class="col-md-3">
        <div class="card">
            <div class="card-content text-center">
                <h4><?php echo $data['nama'] ?></h4>
                <h6>harga : <?php echo $data['harga'] ?></h6>
                <button class="btn btn-rose btn-fill" onclick="tambahData(<?php echo $data['barang_id'] ?>)" data-toggle="modal" data-target="#exampleModal">Beli</button>
            </div>
        </div>
    </div>
    <?php
    echo '<script>barang['.$no.'] = ['.$data['barang_id'].',"'.$data['nama'].'",'.$data['harga'].']</script>';
    $no++;
}
?>
</div>
<div class='row'>
    <ul class="pagination justify-content-center">
    	<li class="page-item">
    		<a class="page-link" <?php if($halaman > 1){ echo "href='?url=home&halaman=$previous'"; } ?>>Previous</a>
    	</li>
    	<?php 
    	for($x=1;$x<=$total_halaman;$x++){
    		?> 
    		<li class="page-item <?php echo empty($_GET['halaman'])&&$x==1||$x==$_GET['halaman']?"active":""; ?>"><a class="page-link" href="?url=home&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
    		<?php
    	}
    	?>				
    	<li class="page-item">
    		<a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?url=home&halaman=$next'"; } ?>>Next</a>
    	</li>
    </ul>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Beli Barang</h5>
      </div>
      <form method="post" action="">
        <div class="modal-body">
            <div class="form-group">
                <label class="control-label">Nama Barang</label>
                <input type="hidden" name='id' class="form-control" readonly id="id">
                <input type="text" name='nama' class="form-control" readonly id="namaBarang">
            </div>
            <div class="form-group">
                <label class="control-label">Jumlah Barang</label>
                <input type="number" onchange="test()" onkeyup='test()' value=0 id='jumlah' name='jumlah' required class="form-control">
            </div>
            <div class="form-group">
                <input type="hidden" id="harga" class="form-control">
                <label class="control-label">Total Harga Barang</label>
                <input type="number" name='total' value=0 id="totalHargaBarang" readonly class="form-control">
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-fill btn-default" data-dismiss="modal" value='Close'>
            <input type="submit" name='submit' value='Add To Cart' class="btn btn-fill btn-rose">
        </div>
      </form>
    </div>
  </div>
</div>
<script>
function test(){
    var jumlah = parseInt(document.getElementById("jumlah").value);
    var harga = parseInt(document.getElementById("harga").value);
    document.getElementById("totalHargaBarang").value = jumlah*harga;
    if(document.getElementById("totalHargaBarang").value == null){
        document.getElementById("totalHargaBarang").value = 0;
    }
}
function tambahData(id){
    for (i = 0;i< barang.length;i++) {
        if(id==barang[i][0]){
            document.getElementById("id").value = barang[i][0];
            document.getElementById("namaBarang").value = barang[i][1];
            document.getElementById("harga").value = barang[i][2];
        }
    }
}
function cari(){
    var url = document.getElementById("cari").value;
    window.location = "index.php?url=home&cari="+url;
}
</script>
<?php
if(isset($_POST['submit'])){
    $query = mysqli_query($koneksi,"insert into detail_penjualan(barang_id,user_id,jumlah_barang,total_harga,tanggal_session) values('".$_POST['id']."','".$_SESSION['id']."','".$_POST['jumlah']."','".$_POST['total']."','".$_SESSION['session_date']."')") or die(mysqli_error($koneksi));
    if ($query) {
        ?>
         <script>
            swal({
                title: "Added to Cart !",
                text: "refreshing page ...",
                type: "success"
            }).then(function() {
                window.location = "index.php?url=home";
            });
        </script>
         <?php
    }else{
        ?>
         <script>
            swal({
                title: "Failed add to Cart !",
                text: "failed to add data ...",
                type: "error"
            }).then(function() {
                window.location = "index.php?url=home";
            });
        </script>
         <?php
    }
}
?>
                