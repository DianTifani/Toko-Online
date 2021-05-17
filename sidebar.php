<div class="sidebar" data-active-color="rose" data-background-color="black" data-image="./assets/img/sidebar-1.jpg">
    <div class="logo">
        <a href="index.php" class="simple-text logo-mini">
            TO
        </a>
        <a href="index.php" class="simple-text logo-normal">
            Toko Online
        </a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="./assets/img/faces/person.svg">
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                    <span>
                        <?php echo $_SESSION['nama'] ?>
                        <b class="caret"></b>
                    </span>
                </a>
                <div class="clearfix"></div>
                <div class="collapse <?php echo !empty($_GET['url'])&&$_GET['url']=='profile-edit'?"in":"" ?>" id="collapseExample">
                    <ul class="nav">
                        <li class='<?php echo !empty($_GET['url'])&&$_GET['url']=='profile-edit'?"active":"" ?>'>
                            <a href="index.php?url=profile-edit">
                                <span class="sidebar-mini"> SP </span>
                                <span class="sidebar-normal"> Setting Profile </span>
                            </a>
                        </li>
                        <li>
                            <a href="index.php?url=logout">
                                <span class="sidebar-mini"> LO </span>
                                <span class="sidebar-normal"> Logout </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            <li class="<?php echo $_GET['url']=="home"||$_GET['url']=="cart"||empty($_GET['url'])?"active":""?>" >
                <a href="index.php?url=home">
                    <i class="material-icons">dashboard</i>
                    <p> Home </p>
                </a>
            </li>
            <li class="<?php echo $_GET['url']=="penjualan"||$_GET['url']=="detail_penjualan"?"active":""?>" >
                <a href="index.php?url=penjualan">
                    <i class="material-icons">list_alt</i>
                    <p> History Transaksi </p>
                </a>
            </li>
            <?php
            if ($_SESSION['role']=="Admin") {
                ?>
            <li class="<?php echo empty($_GET['url'])?"":$_GET['url']=="user"||$_GET['url']=="user-edit"||$_GET['url']=="user-tambah"?"active":""?>" >
                <a data-toggle="collapse" href="#tablesExamples"  <?php echo empty($_GET['url'])?"":$_GET['url']=="user"||$_GET['url']=="user-edit"||$_GET['url']=="user-tambah"?"aria-expanded='true'":""?>>
                    <i class="material-icons">grid_on</i>
                    <p> Manajemen User
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse <?php echo empty($_GET['url'])?"":$_GET['url']=="user"||$_GET['url']=="user-edit"||$_GET['url']=="user-tambah"?"in":""?>" id="tablesExamples">
                    <ul class="nav">
                        <li class="<?php echo $_GET['url']=="user"||$_GET['url']=="user-edit"?"active":""?>" >
                            <a href="index.php?url=user">
                                <span class="sidebar-mini"> DU </span>
                                <span class="sidebar-normal"> Data User </span>
                            </a>
                        </li>
                        <li class="<?php echo $_GET['url']=="user-tambah"?"active":""?>" >
                            <a href="index.php?url=user-tambah">
                                <span class="sidebar-mini"> TU </span>
                                <span class="sidebar-normal"> Tambah User </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="<?php echo empty($_GET['url'])?"":$_GET['url']=="barang"||$_GET['url']=="barang-edit"||$_GET['url']=="barang-tambah"?"active":""?>" >
                <a data-toggle="collapse" href="#barang"  <?php echo empty($_GET['url'])?"":$_GET['url']=="barang"||$_GET['url']=="barang-edit"||$_GET['url']=="barang-tambah"?"aria-expanded='true'":""?>>
                    <i class="material-icons">shopping_bag</i>
                    <p> Manajemen barang
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse <?php echo empty($_GET['url'])?"":$_GET['url']=="barang"||$_GET['url']=="barang-edit"||$_GET['url']=="barang-tambah"?"in":""?>" id="barang">
                    <ul class="nav">
                        <li class="<?php echo $_GET['url']=="barang"||$_GET['url']=="barang-edit"?"active":""?>" >
                            <a href="index.php?url=barang">
                                <span class="sidebar-mini"> DB </span>
                                <span class="sidebar-normal"> Data Barang </span>
                            </a>
                        </li>
                        <li class="<?php echo $_GET['url']=="barang-tambah"?"active":""?>" >
                            <a href="index.php?url=barang-tambah">
                                <span class="sidebar-mini"> TB </span>
                                <span class="sidebar-normal"> Tambah Barang </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="<?php echo empty($_GET['url'])?"":$_GET['url']=="penjual"||$_GET['url']=="penjual-edit"||$_GET['url']=="penjual-tambah"?"active":""?>" >
                <a data-toggle="collapse" href="#penjual"  <?php echo empty($_GET['url'])?"":$_GET['url']=="penjual"||$_GET['url']=="penjual-edit"||$_GET['url']=="penjual-tambah"?"aria-expanded='true'":""?>>
                    <i class="material-icons">emoji_transportation</i>
                    <p> Manajemen Penjual
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse <?php echo empty($_GET['url'])?"":$_GET['url']=="penjual"||$_GET['url']=="penjual-edit"||$_GET['url']=="penjual-tambah"?"in":""?>" id="penjual">
                    <ul class="nav">
                        <li class="<?php echo $_GET['url']=="penjual"||$_GET['url']=="penjual-edit"?"active":""?>" >
                            <a href="index.php?url=penjual">
                                <span class="sidebar-mini"> DP </span>
                                <span class="sidebar-normal"> Data Penjual </span>
                            </a>
                        </li>
                        <li class="<?php echo $_GET['url']=="penjual-tambah"?"active":""?>" >
                            <a href="index.php?url=penjual-tambah">
                                <span class="sidebar-mini"> TP </span>
                                <span class="sidebar-normal"> Tambah Penjual </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <?php
            } ?>
            <li class="<?php echo $_GET['url']=="about"?"active":""?>" >
                <a href="index.php?url=about">
                    <i class="material-icons">people_outline</i>
                    <p> Profile </p>
                </a>
            </li>
        </ul>
    </div>
</div>