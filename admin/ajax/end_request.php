<?php
require('../include/ayar.php');
if($_POST){
    $req_id=$_POST['id'];
    $sth=$conn->prepare("UPDATE requests SET status=? WHERE id=?");
    $sth->execute(array(
        3,$req_id
    ));
   if($sth){
    echo '
    Talep Sonlandırıldı.
    ';
   }
   else echo 'Talep Sonlandırılamadı.Hata Oluştu!';
       
            
    
}
?>