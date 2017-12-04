<?php
 ob_start();
 header("content-type: text/html; charset=utf-8");
 require('include/ayar.php');
 session_start();
if(!$_SESSION['user']||$_SESSION['authority']!=7)
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
           $active="Şoförler";
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
                <li class="breadcrumb-item"><?=$active?></li>
            </ol>

            <?php

switch($page){
    
    case 'arizalar';
    include 'arizalar/arizalar.php';
    break;
   
    case 'ariza-ekle';
    include 'arizalar/ariza-ekle.php';
    break;

    case 'ariza-duzenle';
    include 'arizalar/ariza-duzenle.php';
    break;

    case 'cikis';
    include 'cikis.php';
    break;

    default;
    include 'arizalar/arizalar.php';
    break;
    }
?>    
        </main>
    </div>

   <?php include('include/footer.php'); ?>