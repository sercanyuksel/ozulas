<?php
require('../include/ayar.php');
if($_POST){
    $req_id=$_POST['id'];
    $sth=$conn->prepare("UPDATE requests SET status=20 WHERE id=?");
    $sth->execute(array(
        $req_id
    ));
   if($sth){
    echo '
    Talep Geri Gönderildi..
    ';
   }
   else echo 'Talep Geri Gönderilemedi.Hata Oluştu!';
       
            
    
}
?>