<?php
 ob_start();
 header("content-type: text/html; charset=utf-8");
 require('include/ayar.php');
 session_start();

if(!$_SESSION['user']||$_SESSION['authority']!=2)
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
    
    

    case 'arizalar';
    include 'arizalar/arizalar.php';
    break;
    
    
    case 'ariza-duzenle';
    include 'arizalar/ariza-duzenle.php';
    break;

    
    
    case 'arac-duzenle';
    include 'araclar/arac-duzenle.php';
    break;

    
    case 'talepler';
    include 'talepler/talepler.php';
    break;
    
    
    case 'talep-duzenle';
    include 'talepler/talep-duzenle.php';
    break;

    case 'arsiv';
    include 'talepler/arsiv.php';
    break;

    default;
    include 'talepler/talepler.php';
    break;
    }
?>    
        </main>
    </div>

   <?php include('include/footer.php'); ?>