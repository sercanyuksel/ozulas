<header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">☰</button>
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler sidebar-minimizer d-md-down-none" type="button">☰</button>

        <ul class="nav navbar-nav d-md-down-none">
            <li class="nav-item px-3">
                <a class="nav-link" href="#">Anasayfa</a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link" href="index.php?islem=ariza-ekle">Arıza Ekle</a>
            </li>
           
        </ul>
        <ul class="nav navbar-nav ml-auto">
           
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <span class="d-md-down-none"><?=$_SESSION['name']?> <?=$_SESSION['surname']?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
          
                    <div class="dropdown-header text-center">
                        <strong>Ayarlar</strong>
                    </div>
                
                    <a class="dropdown-item" href="index.php?islem=cikis"><i class="fa fa-lock"></i> Çıkış Yap</a>
                </div>
            </li>
        </ul>

    </header>
