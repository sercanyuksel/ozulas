<?php
$id=$_GET['id'];
$sth=$conn->prepare("SELECT * from requests WHERE id=?");
$sth->execute(array($id));
$request=$sth->fetch(PDO::FETCH_ASSOC);
$sth=$conn->prepare("SELECT * from cars");
$sth->execute();
$cars=$sth->fetchAll(PDO::FETCH_ASSOC);
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
$sth=$conn->prepare("SELECT * from car_camera WHERE car_id=?");
$sth->execute(array($request['car_id']));
$car_cameras=$sth->fetchAll(PDO::FETCH_ASSOC);
if($_POST)
{
   
    
        $id=$_POST['req_id'];
        $resp=$_POST['resp'];
        $result=$_POST['result'];
      
        
        $sth=$conn->prepare("UPDATE requests SET response=?,response_status=? WHERE id=?"); 
        $sth=$sth->execute(array(
            $resp,$result,$id
        ));
        if($sth)
        {
            echo '
              <div class="row justify-content-center">
              <div class="col-md-12">
              <div class="alert alert-success" style="padding:60px;">
              <h1><i class="fa fa-check-circle-o"></i> Talep Düzenleme Başarılı .</h1><br/>
              Yönlendiriliyorsunuz...
              </div>
              </div>
              </div>
              ';
           header("Refresh:2; url=index.php?islem=talepler");
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
           header("Refresh:2; url=index.php?islem=talep-revize&id=".$id);
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
                <form method="POST" id="frm" action="">

                    <div class="form-group">
                        <label for="company">Talebin Durumu :</label>
                        <input type="text" disabled value="<?=$cur_status?>" />
                    </div>

                    <div class="form-group">
                        <label for="company">Talep Tarihi :</label>
                        <input type="text" disabled value="<?=$create_date?>" />
                    </div>

                    
                    <div class="form-group">
                        <label for="company">Talebi Açan :</label>
                        <input type="text" disabled value="<?=$creator['name']?> <?=$creator['surname']?>" />
                    </div>

                    <div class="form-group">
                        <label for="company">Araç Kodu:</label>
                        <select disabled class="form-control" name="car_id" id="car_id1">
                        <option value="-1" disabled selected="selected">Araç Seçin</option>
                        <?php foreach($cars as $car) { ?>
                            <option value="<?=$car['id']?>" <?php if($car['id']==$selected_car['id']) echo 'selected="selected"'; ?>><?=$car['code']?></option>
                        <?php } ?>                        
                        </select><br/>
                      
                    </div>


                    <div class="form-group">
                        <label for="company">Görüntüsü İstenen Cameralar :</label>
                        <select disabled multiple  class="form-control" name="camera[]" id="camss"> 
                        <?php if(strlen($request['camera_id'])>0){
                            $cameras=explode("-",$request['camera_id']);
                            foreach($car_cameras as $cameracar){
                                
                                $sth=$conn->prepare("SELECT * from camera_types WHERE id=?");
                                $sth->execute(array($cameracar['type_id']));
                                $cur_camera=$sth->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <option <?php  if(in_array($cameracar['type_id'],$cameras)) echo 'selected'; ?> value="<?=$cur_camera['id']?>"><?=$cur_camera['camera']?></option>
                                <?php
                            }
                        } ?>
                        </select>
                        <script type="text/javascript">
                        var options = "<?=$request['camera_id']?>";
                        var indexes=options.split("-");
                        
                        var selecteds=[];
                        for(i=0;i<indexes.length;i++){
                           
                            selecteds.push(indexes[i]);
                        }
                         $('#camss').val(selecteds);
                        </script>
                    </div>

                    <div class="form-group">
                        <label for="company">Başlangıç Saati :</label>
                        <input type="time" disabled  name="s_time" value="<?=$request['start_time']?>" />                        
                    </div>

                    <div class="form-group">
                        <label for="company">Bitiş Saati :</label>
                        <input type="time" disabled  name="e_time" value="<?=$request['stop_time']?>" />                        
                    </div>

                    <div class="form-group">
                        <label for="company">Talebi Üstlenen :</label>
                        <input type="text" disabled value="<?=$handler['name']?> <?=$handler['surname']?>" />                        
                    </div>

                    <div class="form-group">
                        <label for="desc">Talep Açıklama :</label>
                        <textarea  rows="4" disabled name="desc" class="form-control" id="desc"><?=$request['description']?></textarea>
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
                        <select  class="form-control" name="result" id="result"> 
                            <option value="0" <?php if($request['response_status']==0) echo'selected="selected"';?>>Olumsuz</option>
                            <option value="1" <?php if($request['response_status']==1) echo'selected="selected"';?>>Olumlu</option>                      
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="desc">Talep Cevap :</label>
                        <textarea  rows="4"   name="resp" class="form-control" id="desc"><?=$request['response']?></textarea>
                    </div>

                    <input type="hidden"  name="req_id" value="<?=$id?>" id="req_id"/>
                    <input type="hidden"  value="<?=$_SESSION['user_id']?>" id="ses_id"/>
                    <input type="hidden"  value="<?=$request['car_id']?>" id="car_id"/>   
                    <div class="row">
                        <div class="col-6">
                            <button  type="submit"  class="btn btn-danger px-4"?>>Düzenle</button>
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