<?php
$url = empty($_GET['url'])?'home':$_GET['url'];
switch ($url) {
    case 'home':
        include ('pages/home.php');
        break;
    case 'profile-edit':
        include ('pages/user-edit.php');
        break;
    case 'about':
        include ('pages/about.php');
        break;
    case 'cart':
        include ('pages/cart.php');
        break;
    case 'penjualan':
        include ('pages/penjualan.php');
        break;
    case 'detail_penjualan':
        include ('pages/detail_penjualan.php');
        break;
    case 'barang':
        if($_SESSION['role']=="Admin"){
            include ('pages/barang.php');
        }else{
            ?>
             <script>
                swal({
                    title: "Not Allowed !",
                    text: "you can't access this ...",
                    type: "error"
                }).then(function() {
                    window.location = "index.php";
                });
            </script>
             <?php
        }
        break;
    case 'barang-edit':
        if($_SESSION['role']=="Admin"){
            include ('pages/barang-edit.php');
        }else{
            ?>
             <script>
                swal({
                    title: "Not Allowed !",
                    text: "you can't access this ...",
                    type: "error"
                }).then(function() {
                    window.location = "index.php";
                });
            </script>
             <?php
        }
        break;
    case 'barang-tambah':
        if($_SESSION['role']=="Admin"){
            include ('pages/barang-edit.php');
        }else{
            ?>
             <script>
                swal({
                    title: "Not Allowed !",
                    text: "you can't access this ...",
                    type: "error"
                }).then(function() {
                    window.location = "index.php";
                });
            </script>
             <?php
        }
        break;
    case 'penjual':
        if($_SESSION['role']=="Admin"){
            include ('pages/penjual.php');
        }else{
            ?>
             <script>
                swal({
                    title: "Not Allowed !",
                    text: "you can't access this ...",
                    type: "error"
                }).then(function() {
                    window.location = "index.php";
                });
            </script>
             <?php
        }
        break;
    case 'penjual-edit':
        if($_SESSION['role']=="Admin"){
            include ('pages/penjual-edit.php');
        }else{
            ?>
             <script>
                swal({
                    title: "Not Allowed !",
                    text: "you can't access this ...",
                    type: "error"
                }).then(function() {
                    window.location = "index.php";
                });
            </script>
             <?php
        }
        break;
    case 'penjual-tambah':
        if($_SESSION['role']=="Admin"){
            include ('pages/penjual-edit.php');
        }else{
            ?>
             <script>
                swal({
                    title: "Not Allowed !",
                    text: "you can't access this ...",
                    type: "error"
                }).then(function() {
                    window.location = "index.php";
                });
            </script>
             <?php
        }
        break;
    case 'user':
        if($_SESSION['role']=="Admin"){
            include ('pages/user.php');
        }else{
            ?>
             <script>
                swal({
                    title: "Not Allowed !",
                    text: "you can't access this ...",
                    type: "error"
                }).then(function() {
                    window.location = "index.php";
                });
            </script>
             <?php
        }
        break;
    case 'user-edit':
        if($_SESSION['role']=="Admin"){
            include ('pages/user-edit.php');
        }else{
            ?>
             <script>
                swal({
                    title: "Not Allowed !",
                    text: "you can't access this ...",
                    type: "error"
                }).then(function() {
                    window.location = "index.php";
                });
            </script>
             <?php
        }
        break;
    case 'user-tambah':
        if($_SESSION['role']=="Admin"){
            include ('pages/user-edit.php');
        }else{
            ?>
             <script>
                swal({
                    title: "Not Allowed !",
                    text: "you can't access this ...",
                    type: "error"
                }).then(function() {
                    window.location = "index.php";
                });
            </script>
             <?php
        }
        break;
    case 'logout':
        session_destroy();
        ?>
        <script>window.location = 'login.php'</script>
        <?php
        break;
    default:
        include ('pages/home.php');
        break;
}
?>