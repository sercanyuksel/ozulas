<?php
require('../include/ayar.php');

if($_POST)
{
$dt=new DateTime();
$taken_at = $dt->format('Y-m-d H:i:s');
$request_id=$_POST['id'];

$sth=$conn->prepare("UPDATE requests SET status=10 WHERE id=?");
$sth->execute(array(
    $request_id
));
if($sth){

    echo 'Talep Geri Çekildi.';
}
else echo 'Talep Geri Çekilemedi !Hata Oluştu.';
}
?>