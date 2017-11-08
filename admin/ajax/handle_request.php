<?php
require('../include/ayar.php');

if($_POST)
{
$dt=new DateTime();
$taken_at = $dt->format('Y-m-d H:i:s');
$request_id=$_POST['id'];
$sid=$_POST['sid'];
$sth=$conn->prepare("UPDATE requests SET handler_id=?,taken_at=?,status=? WHERE id=?");
$sth->execute(array(
    $sid,$taken_at,1,$request_id
));
if($sth){

    echo 'Görev Üstlenildi.';
}
else 'Görev Üstlenilemedi!Hata Oluştu.';
}
?>