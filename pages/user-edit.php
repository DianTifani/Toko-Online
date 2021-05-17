<?php
$nama="";
$username="";
if(isset($_GET['edit'])||$_GET['url']=="profile-edit"){
    echo'<script>console.log('.$_SESSION['id'].')</script>';
    $param = $_GET['url']=="profile-edit"?$_SESSION['id']:$_GET['edit'];
    $password="";
    $role="";
    $query = mysqli_query($koneksi,"select * from user where user_id = '".$param."'");
    while($data = mysqli_fetch_assoc($query)){
        $nama = $data['nama'];
        $username = $data['username'];
        $password = $data['password'];
        $role = $data['role'];
    }
}
?>
<div class="col-md-10 col-md-offset-1">
    <div class="card">
        <div class="card-header card-header-icon" data-background-color="rose">
            <i class="material-icons">contacts</i>
        </div>
        <div class="card-content">
            <h4 class="card-title"><?php if(isset($_GET['edit'])||$_GET['url']=="profile-edit"){echo "Edit";}else{echo "Tambah";}?> User</h4>
              <form class="form-horizontal" action="" method="post">
                <input type="hidden" readonly name="id" id='id' value="<?php echo $param; ?>">
                <div class="row">
                    <label class="col-md-3 label-on-left">Nama</label>
                    <div class="col-md-7">
                        <div class="form-group label-floating is-empty">
                            <label class="control-label"></label>
                            <input name='nama' type="text" value="<?php echo isset($_GET['edit'])||$_GET['url']=="profile-edit"?$nama:""; ?>" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3 label-on-left">Username</label>
                    <div class="col-md-7">
                        <div class="form-group label-floating is-empty">
                            <label class="control-label"></label>
                            <input name='username' type="text" value="<?php echo isset($_GET['edit'])||$_GET['url']=="profile-edit"?$username:""; ?>" class="form-control" required>
                        </div>
                    </div>
                </div>
                <?php
                if(isset($_GET['edit'])||$_GET['url']=="profile-edit"){
                ?>
                <div class="row">
                    <label class="col-md-3 label-on-left">Old Password</label>
                    <div class="col-md-7">
                        <div class="form-group label-floating is-empty">
                            <label class="control-label"></label>
                            <input name='oldpassword' type="password" class="form-control" required>
                        </div>
                    </div>
                </div>                    
                <div class="row">
                    <label class="col-md-3 label-on-left">New Password</label>
                    <div class="col-md-7">
                        <div class="form-group label-floating is-empty">
                            <label class="control-label"></label>
                            <input name='newpassword' type="password" placeholder="If You Don't Wanna Change Re-type Old Password" class="form-control" required>
                        </div>
                    </div>
                </div>                    
                <div class="row">
                    <label class="col-md-3 label-on-left">Confirm New Password</label>
                    <div class="col-md-7">
                        <div class="form-group label-floating is-empty">
                            <label class="control-label"></label>
                            <input name='confirmnewpassword' placeholder="If You Don't Wanna Change Re-type Old Password" type="password" class="form-control" required>
                        </div>
                    </div>
                </div>                    
                <?php
                }else{
                ?>
                <div class="row">
                    <label class="col-md-3 label-on-left">Password</label>
                    <div class="col-md-7">
                        <div class="form-group label-floating is-empty">
                            <label class="control-label"></label>
                            <input name='password' type="password" class="form-control" required>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php if($_GET['url']=="profile-edit"){
                }else{
                    ?>
                <div class="row">
                    <label class="col-md-3 label-on-left">Role</label>
                    <div class="col-md-7 checkbox-radios">
                        <div class="radio">
                            <label>
                                <input type="radio" name="role" <?php echo isset($_GET['edit'])&& $role=="Admin"?"checked":""; ?> value="Admin" required> Admin
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="role" <?php echo isset($_GET['edit'])&& $role=="User"?"checked":""; ?> value="User">User
                            </label>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
                <div class="row">
                    <label class="col-md-3"></label>
                    <div class="col-md-9">
                        <div class="form-group form-button">
                            <a href='index.php?url=user' class="btn btn-fill btn-default"> Back </a>
                            <input name='<?php echo isset($_GET['edit'])?"edit":$_GET['url']=="profile-edit"?"profile-edit":"submit"; ?>' type="submit" class="btn btn-fill btn-rose" value="<?php echo isset($_GET['edit'])||$_GET['url']=="profile-edit"?"Edit":"Tambah"; ?>">
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
    $cek = mysqli_query($koneksi,"select * from user where username = '".$_POST['username']."'") or die(mysqli_error($koneksi));
    if(mysqli_num_rows($cek)>0){
        ?><script>
            swal({
                title: "Username Already Exist !",
                text: "Ok to reload page ...",
                type: "error"
            }).then(function() {
                window.location = "index.php?url=user-tambah";
            });
        </script><?php
    }
    $query = mysqli_query($koneksi, "insert into user(nama,username,password,role) values ('".$_POST['nama']."','".$_POST['username']."','".$_POST['password']."','".$_POST['role']."')") or die(mysqli_error($koneksi));
    if ($query) {
        ?>
         <script>
            swal({
                title: "Success Tambah Data !",
                text: "refreshing page ...",
                type: "success"
            }).then(function() {
                window.location = "index.php?url=user-tambah";
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
                window.location = "index.php?url=user-tambah";
            });
        </script>
         <?php
    }
}

// ============================= EDIT ============================

if(isset($_POST['edit'])||isset($_POST['profile-edit'])){
    ?>
    <script>
    var id = document.getElementById("id").value;
    </script>
    <?php
    $role = empty($_POST['role'])?$_SESSION['role']:$_POST['role'];
    $cekpass = mysqli_query($koneksi,"select * from user where user_id = '".$_POST['id']."'") or die(mysqli_error($koneksi));
    $data = mysqli_fetch_assoc($cekpass);
    if(isset($_GET['edit'])){
        ?>
        <script>var error = "index.php?url=user-edit&edit="+id;</script>
        <?php
    }else{
        ?>
        <script>var error = "index.php?url=profile-edit";</script>
        <?php
    }
    if($data['password'] == $_POST['oldpassword'] && $_POST['newpassword'] == $_POST['confirmnewpassword']){
        $cek = mysqli_query($koneksi,"select * from user where username = '".$_POST['username']."' and user_id != '".$_POST['id']."'") or die(mysqli_error($koneksi));
        if(mysqli_num_rows($cek)>0){
            ?><script>
                swal({
                    title: "Username Already Exist !",
                    text: "Ok to reload page ...",
                    type: "error"
                }).then(function() {
                    window.location = error;
                });
            </script><?php
        }else{
            $query = mysqli_query($koneksi,"update user set nama='".$_POST['nama']."', username='".$_POST['username']."', password='".$_POST['newpassword']."',role='".$role."' where user_id = '".$_POST['id']."'") or die(mysqli_error($koneksi));
            if ($query) {
                if(isset($_GET['edit'])){
                    ?>
                    <script>var url = "index.php?url=user";</script>
                    <?php
                }else{
                    ?>
                    <script>var url = "index.php";</script>
                    <?php
                }
                ?>
                 <script>
                    swal({
                        title: "Success Update Data !",
                        text: "refreshing page ...",
                        type: "success"
                    }).then(function() {
                        window.location = url;
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
                        window.location = url;
                    });
                </script>
                 <?php
            }
        }
    }else{
        ?><script>
        swal({
            title: "Password Error !",
            text: "old password is incorrect or new and confirm password isn't match",
            type: "error"
        }).then(function() {
            window.location = error;
        });
        </script><?php
    }
}
?>
                        