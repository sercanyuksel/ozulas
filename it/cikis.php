<?php


session_destroy();
echo'
<div class="row justify-content-center">
<div class="col-md-12">
<div class="alert alert-danger" style="padding:60px;">
<h1><i class="fa fa-warning"></i>Güvenli Çıkış Gerçekleştirildi!</h1><br/>
Yönlendiriliyorsunuz...
</div>
</div>
</div>
';
header('Refresh:2; url=../index.php');
?>