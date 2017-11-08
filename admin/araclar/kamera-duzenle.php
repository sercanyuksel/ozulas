<?php
$id=$_GET['id'];
$sth=$conn->prepare("SELECT c.*,ca.camera as type from car_camera c INNER JOIN camera_types ca ON c.type_id=ca.id  WHERE c.car_id=?");
$sth->execute(array(
    $id
));
$cameras=$sth->fetchAll(PDO::FETCH_ASSOC);
$sth=$conn->prepare("SELECT * from camera_types");
$sth->execute();
$cam_types=$sth->fetchAll(PDO::FETCH_ASSOC);
if($_POST)
{  $i=0;
    foreach($_POST as $key=>$post){
     
        if(strpos($key,"status")!==false)
        {
         
            $status=$post;
            
            $i++;
            
        }
        if(strpos($key,"camera")!==false)
        {
          
            $camera=$post;
            
            $i++;
           
        }
          if($i!=0 && $i%2==0)
          {
             
              $sth=$conn->prepare("UPDATE  car_camera SET status=? WHERE car_id=? AND type_id=?");
              $sth->execute(array(
                  $status,$id,$camera
              ));
             
          }          
         

         
      }
       
        if($sth)
        {
            echo '
            
              <div class="row justify-content-center">
              <div class="col-md-12">
              <div class="alert alert-success" style="padding:60px;">
              <h1><i class="fa fa-check-circle-o"></i> Araç Kamera Düzenleme Başarılı .</h1><br/>
              Yönlendiriliyorsunuz...
              </div>
              </div>
              </div>
                  
              ';
           header("Refresh:2; url=index.php?islem=araclar");
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
           header("Refresh:2; url=index.php?islem=kamera-durum&id=".$id);
        }
    
    
}else{
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12   ">

            <div class="card">
                <div class="card-header">
                    <strong>Araç Kamera Düzenle</strong>                
                </div>
                <div class="card-body">
                <form METHOD="POST">
                    <?php foreach($cameras as $key=>$camera) { 
                        if($camera['status']==0) $status="Çalışıyor";else $status="Arızalı"?>
                        <div class="form-group">
                        <label for="company"><?=$key+1?>. Kamera Tipi :</label>
                        <select  name="camera<?=$key?>">
                        <?php foreach($cam_types as $cam){ ?>
                        <option <?php if($cam['id']==$camera['type_id']) echo'selected="selected"'; ?> value="<?=$cam['id']?>"><?=$cam['camera']?></option>
                        <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="company"><?=$key+1?>. Kamera Durumu :</label>
                        <select name="status<?=$key?>">
                        <option <?php if($camera['status']==0) echo 'selected="selected"'; ?> value="0">Çalışıyor</option>
                        <option <?php if($camera['status']==1) echo 'selected="selected"'; ?> value="1">Arızalı</option>
                        </select>
                    </div>
                    <?php } ?>

                    <div class="row">
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary px-4">Düzenle</button>
                        </div>
                    </div>
                    </form>
                </div>
                
               

            </div>

        </div>
    </div>
</div>
<?php } ?>