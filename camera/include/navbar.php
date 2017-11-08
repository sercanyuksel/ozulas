<header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">☰</button>
        <a class="navbar-brand" href="index.php"></a>
        <button class="navbar-toggler sidebar-minimizer d-md-down-none" type="button">☰</button>

        <ul class="nav navbar-nav d-md-down-none">
            <li class="nav-item px-3">
                <a class="nav-link" href="index.php?islem=talepler"><span style="padding:15px;" class="badge-warning">TALEPLER</span></a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link" href="index.php?islem=ariza-ekle"><span style="padding:15px;" class="badge-danger">ARIZA EKLE</span></a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link" href="index.php?islem=arizalar"><span style="padding:15px;" class="badge-info">ARIZALAR</span></a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link" href="index.php?islem=arsiv"><span style="padding:15px;" class="badge-light">ARŞİV</span></a>
            </li>
			 <li class="nav-item px-3">
                <a class="nav-link" href="index.php?islem=tum-talepler"><span style="padding:15px;" class="badge-seconday">TÜM TALEPLER</span></a>
            </li>
        </ul>
        <ul class="nav navbar-nav ml-auto">
           
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <span class="d-md-down-none"><?=$_SESSION['name']?> <?=$_SESSION['surname']?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>Hesap</strong>
                    </div>
                    <a class="dropdown-item" href="index.php?islem=profil-duzenle"><i class="fa fa-user"></i> Profil</a>
                    <a class="dropdown-item" href="index.php?islem=sifre-degistir"><i class="fa fa-wrench"></i> Şifre Değiştir</a>
                    <a class="dropdown-item" href="index.php?islem=cikis"><i class="fa fa-lock"></i> Çıkış Yap</a>
                </div>
            </li>
        </ul>

    </header>
