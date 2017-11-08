<?php
$id=$_GET['id'];
$sth=$conn->prepare("SELECT * from requests WHERE id=?");
$sth->execute(array($id));
$request=$sth->fetch(PDO::FETCH_ASSOC);
if($request['handler_id']==0){
$dt=new DateTime();
$taken_at = $dt->format('Y-m-d H:i:s');
$sid=$_SESSION['user_id'];
$sth=$conn->prepare("UPDATE requests SET handler_id=?,taken_at=?,status=? WHERE id=?");
$sth->execute(array(
    $sid,$taken_at,1,$id
));
}

$sth=$conn->prepare("SELECT * from requests WHERE id=?");
$sth->execute(array($id));
$request=$sth->fetch(PDO::FETCH_ASSOC);
$sth=$conn->prepare("SELECT * from users WHERE id=?");
$sth->execute(array($request['creator_id']));
$creator=$sth->fetch(PDO::FETCH_ASSOC);
if($request['handler_id']!=0){
$sth->execute(array($request['handler_id']));
$handler=$sth->fetch(PDO::FETCH_ASSOC);
}
else{
    $handler=["name"=>"Talep Henüz ","surname"=>"Üstlenilmedi."];
}
$oDate = new DateTime($request['created_at']);
$create_date = $oDate->format("d-m-Y");
if($request['taken_at']>0){
    $oDate = new DateTime($request['taken_at']);
    $taken_date = $oDate->format("d-m-Y H:i:s");    
}
else $taken_date="*******";
if($request['solved_at']>0){
    $oDate = new DateTime($request['solved_at']);
    $solved_date = $oDate->format("d-m-Y H:i:s");    
}
else $solved_date="*******";
$sth=$conn->prepare("SELECT * from cars WHERE id=?");
$sth->execute(array($request['car_id']));
$selected_car=$sth->fetch(PDO::FETCH_ASSOC);
if($request['status']==0){
    $cur_status="Açık Talep";
}
if($request['status']==1){
    $cur_status="İşlemde";
}
if($request['status']==2){
    $cur_status="Cevaplanmış Talep";
}
if($request['status']==3){
    $cur_status="Kapalı Talep";
}
if($_POST)
{
    $dt=new DateTime();
    $solved_at = $dt->format('Y-m-d H:i:s');
    $result=$_POST['result'];
    $response=$_POST['resp'];
    if($result!=0 && $result!=1)
    {
        echo '
      
        <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="alert alert-danger" style="padding:60px;">
        <h1><i class="fa fa-warning"></i> Talep Sonucunu Boş Bırakamazsanız.</h1><br/>
        Yönlendiriliyorsunuz...
        </div>
        </div>
        </div>
        	
        ';
     header("Refresh:2; url=index.php?islem=talep-duzenle&id=$id");
    }
    else
    {
        $sth=$conn->prepare("UPDATE requests SET solved_at=?,response=?,response_status=?,status=?  WHERE id=?"); 
        $sth=$sth->execute(array(
            $solved_at,$response,$result,2,$id
        ));
        if($sth)
        {
            echo '
            
              <div class="row justify-content-center">
              <div class="col-md-12">
              <div class="alert alert-success" style="padding:60px;">
              <h1><i class="fa fa-check-circle-o"></i> Talep Cevaplama Başarılı .</h1><br/>
              Yönlendiriliyorsunuz...
              </div>
              </div>
              </div>
                  
              ';
           header("Refresh:2; url=index.php?islem=talep-detay&id=".$id);
        }
        else
        {
            echo '
            
              <div class="row justify-content-center">
              <div class="col-md-12">
              <div class="alert alert-danger" style="padding:60px;">
              <h1><i class="fa fa-warning"></i>Beklenmeyen bir hata oluştu.</h1><br/>
              Yönlendiriliyorsunuz...
              </div>
              </div>
              </div>
                  
              ';
           header("Refresh:2; url=index.php?islem=talep-ekle");
        }
    }
    
}
else{
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12   ">

            <div class="card">
                <div class="card-header">
                    <strong>Talep Düzenle</strong>                
                </div>
                <div class="card-body">
                <form method="POST">

                    <div class="form-group">
                        <label for="company">Talebin Durumu :</label>
                        <input type="text" disabled value="<?=$cur_status?>" />
                    </div>

                    <div class="form-group">
                        <label for="company">Rapor Tarihi :</label>
                        <input type="text" disabled value="<?=$create_date?>" />
                    </div>

                    <div class="form-group">
                        <label for="company">Araç :</label>
                        <select disabled class="form-control" name="car_id" id="car_id"> 
                            <option value="<?=$selected_car['id']?>"><?=$selected_car['code']?></option>                      
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="company">Talebi Açan :</label>
                        <input type="text" disabled value="<?=$creator['name']?> <?=$creator['surname']?>" />
                    </div>

                    <div class="form-group">
                        <label for="company">Görüntüsü İstenen Cameralar :</label>
                        <select multiple disabled class="form-control" name="result" id="result"> 
                        <?php if(strlen($request['camera_id'])>0){
                            $cameras=explode("-",$request['camera_id']);
                            foreach($cameras as $camera){
                                $sth=$conn->prepare("SELECT * from camera_types WHERE id=?");
                                $sth->execute(array($camera));
                                $cur_camera=$sth->fetch(PDO::FETCH_ASSOC);
                                echo '<option>'.$cur_camera['camera'].'</option>';
                            }
                        } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="company">Başlangıç Saati :</label>
                        <input type="text" disabled value="<?=$request['start_time']?>" />                        
                    </div>

                    <div class="form-group">
                        <label for="company">Bitiş Saati :</label>
                        <input type="text" disabled value="<?=$request['stop_time']?>" />                        
                    </div>

                    <div class="form-group">
                        <label for="company">Talebi Üstlenen :</label>
                        <input type="text" disabled value="<?=$handler['name']?> <?=$handler['surname']?>" />                        
                    </div>

                    <div class="form-group">
                        <label for="desc">Talep Açıklama :</label>
                        <textarea disabled rows="4" name="desc" class="form-control" id="desc"><?=$request['description']?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="company">Talep İşleme Alınma Tarihi :</label>
                        <input type="text" disabled value="<?=$taken_date?>" />
                    </div>

                    <div class="form-group">
                        <label for="company">Talep Sonlanma Tarihi :</label>
                        <input type="text" disabled value="<?=$solved_date?>" />
                    </div>

                    <div class="form-group">
                        <label for="company">Talep Sonucu :</label>
                        <select <?php if($request['status']==2)echo'disabled'; ?> class="form-control" name="result" id="result"> 
                            <option value="0" <?php if($request['response_status']==0) echo'selected="selected"';?>>Olumsuz</option>
                            <option value="1" <?php if($request['response_status']==1) echo'selected="selected"';?>>Olumlu</option>                      
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="desc">Talep Cevap :</label>
                        <textarea  rows="4" <?php if($request['status']==2)echo'disabled'; ?>  name="resp" class="form-control" id="desc"><?=$request['response']?></textarea>
                    </div>

                    <input type="hidden"  value="<?=$id?>" id="req_id"/>
                    <input type="hidden"  value="<?=$_SESSION['user_id']?>" id="ses_id"/>
					
					   <?php if($request['status']==2||$request['status']==3){ 
                        $sth=$conn->prepare("SELECT * from request_files WHERE talep_id=?");
                        $sth->execute(array(
                            $request['id']
                        ));
                        $file=$sth->fetch(PDO::FETCH_ASSOC);
                        $file=explode("/",$file['filename']);
                        $file=end($file);
                        ?>
                    <div class="form-group">
                        <label for="desc">Dosyalar :</label>
						<?php 
						$ext=explode(".",$file);
						$ext=end($ext);
						if($ext!="png" && $ext!="jpeg" && $ext!="jpg"){ ?>
                        <i class="icon-folder"></i> <a href="../../uploads/<?=$file?>" download><?=$file?></a>
						<?php }else{ ?>
						<img src="../../uploads/<?=$file?>" />
						<?php } ?>
                    </div>
                    <?php } ?>
					
                    <div class="row">
                        <div class="col-6">
                            <button type="submit" class="btn btn-danger px-4" <?php if($request['status']!=1 || $request['status']==2) {echo 'disabled title="Önce İşleme Alın veya Zaten İşleme Alınmış veya Talep Kapanmış."';}?>>Cevapla</button>
                        </div>
                    </div>

                </form>
                </div>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript" src="talepler/handle.js"></script>
<?php }
?>