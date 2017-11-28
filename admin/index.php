<?php
 ob_start();
 header("content-type: text/html; charset=utf-8");
 require('include/ayar.php');
 session_start();

if(!$_SESSION['user']||$_SESSION['authority']!=1)
{
    header('Location:../');
}
?>
   <?php include('include/header.php'); ?>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
   <?php include('include/navbar.php'); ?>

    <div class="app-body">
      <?php $page=@$_GET['islem']; 
        switch(substr($page,0,3))
        {
           case "sof";
           $active="Şoför İşlemleri";
           break;

           case "tal";
           $active="Talep İşlemleri";
           break;

           default;
           $active="Anasayfa";
           break;
        } 
      include('include/side.php'); 
      ?>

        <!-- Main content -->
        <main class="main">

            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li style="margin-top:10px;" class="breadcrumb-item"><?=$active?></li>
            </ol>

            <?php

switch($page){
    
    case 'cikis';
    include 'cikis.php';
    break;

    case 'araclar';
    include 'araclar/araclar.php';
    break;
    
    case 'arac-ekle';
    include 'araclar/arac-ekle.php';
    break;

    case 'arac-kamera';
    include 'araclar/arac-kamera.php';
    break;

    case 'kamera-durum';
    include 'araclar/kamera-duzenle.php';
    break;

    case 'arac-sil';
    include 'araclar/arac-sil.php';
    break;

    case 'arizalar';
    include 'arizalar/arizalar.php';
    break;
    
    case 'ariza-ekle';
    include 'arizalar/ariza-ekle.php';
    break;

    case 'ariza-duzenle';
    include 'arizalar/ariza-duzenle.php';
    break;

    case 'ariza-sil';
    include 'arizalar/ariza-sil.php';
    break;
    
    case 'arac-duzenle';
    include 'araclar/arac-duzenle.php';
    break;

    case 'bolgeler';
    include 'bolgeler/bolgeler.php';
    break;
    
    case 'bolge-ekle';
    include 'bolgeler/bolge-ekle.php';
    break;

    case 'bolge-sil';
    include 'bolgeler/bolge-sil.php';
    break;
    
    case 'bolge-duzenle';
    include 'bolgeler/bolge-duzenle.php';
    break;

    case 'markalar';
    include 'markalar/markalar.php';
    break;
    
    case 'marka-ekle';
    include 'markalar/marka-ekle.php';
    break;

    case 'marka-sil';
    include 'markalar/marka-sil.php';
    break;
    
    case 'marka-duzenle';
    include 'markalar/marka-duzenle.php';
    break;

    case 'kameralar';
    include 'kameralar/kameralar.php';
    break;
    
    case 'kamera-ekle';
    include 'kameralar/kamera-ekle.php';
    break;

    case 'kamera-sil';
    include 'kameralar/kamera-sil.php';
    break;
    
    case 'kamera-duzenle';
    include 'kameralar/kamera-duzenle.php';
    break;

    case 'talepler';
    include 'talepler/talepler.php';
    break;
    
    case 'talep-ekle';
    include 'talepler/talep-ekle.php';
    break;

    case 'arsiv';
    include 'talepler/arsiv.php';
    break;

    case 'talep-sil';
    include 'talepler/talep-sil.php';
    break;
    
    case 'talep-duzenle';
    include 'talepler/talep-duzenle.php';
    break;

    case 'soforler';
    include 'soforler/soforler.php';
    break;
    
    case 'sofor-ekle';
    include 'soforler/sofor-ekle.php';
    break;

    case 'sofor-sil';
    include 'soforler/sofor-sil.php';
    break;
    
    case 'sofor-duzenle';
    include 'soforler/sofor-duzenle.php';
    break;

    case 'ariza-tipleri';
    include 'ariza-tip/ariza-tipleri.php';
    break;
    
    case 'ariza-tip-ekle';
    include 'ariza-tip/ariza-tip-ekle.php';
    break;

    case 'ariza-tip-sil';
    include 'ariza-tip/ariza-tip-sil.php';
    break;
    
    case 'ariza-tip-duzenle';
    include 'ariza-tip/ariza-tip-duzenle.php';
    break;

    case 'evrak-ekle';
    include 'evraklar/evrak-ekle.php';
    break;

    case 'evraklar';
    include 'evraklar/evraklar.php';
    break;

    default;
    include 'talepler/talepler.php';
    break;




    }
?>    
        </main>
    </div>

   <?php include('include/footer.php'); ?>