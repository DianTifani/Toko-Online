<nav class="navbar navbar-transparent navbar-absolute">
    <div class="container-fluid">
        <div class="navbar-minimize">
            <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                <i class="material-icons visible-on-sidebar-regular">more_vert</i>
                <i class="material-icons visible-on-sidebar-mini">view_list</i>
            </button>
        </div>
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"> 
                <?php
                $url = empty($_GET['url'])?'home':$_GET['url'];
                switch ($url) {
                    case 'home':
                        echo "Home";
                        break;
                    case 'about':
                        echo "Profile";
                        break;
                    case 'penjualan':
                        echo "History Transaksi";
                        break;
                    case 'detail-penjualan':
                        echo "History Transaksi";
                        break;
                    case 'barang':
                        echo "Manajemen Barang";
                        break;
                    case 'barang-tambah':
                        echo "Manajemen Barang";
                        break;
                    case 'barang-edit':
                        echo "Manajemen Barang";
                        break;
                    case 'penjual':
                        echo "Penjual";
                        break;
                    case 'penjual-tambah':
                        echo "Penjual";
                        break;
                    case 'penjual-edit':
                        echo "Penjual";
                        break;
                    case 'cart':
                        echo "Cart";
                        break;
                    case 'user':
                        echo "Manajemen User";
                        break;
                    case 'user-edit':
                        echo "Manajemen User";
                        break;
                    case 'user-tambah':
                        echo "Manajemen User";
                        break;
                    default:
                        echo "Home";
                        break;
                }
                ?> 
            </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="index.php?url=cart" title='Cart'>
                        <i class="material-icons">add_shopping_cart</i>
                    </a>
                </li>
            </ul>
        </div>       
    </div>
</nav>