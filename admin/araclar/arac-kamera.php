<?php
$id=$_GET['id'];
$cnt=$_GET['count'];
$i=0;
$sth=$conn->prepare("SELECT * from camera_types");
$sth->execute();
$cameras=$sth->fetchAll(PDO::FETCH_ASSOC);
if($_POST)
{
        $i=0;
       
       
        foreach($_POST as $key=>$post){
          
            if($i!=0 && $i%2==0)
            {
               
                $sth=$conn->prepare("INSERT INTO car_camera (type_id,status,car_id) VALUES (?,?,?)");
                $sth->execute(array(
                    $camera,$status,$id
                ));
               
            }          
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

            if($i==(2*$cnt))
            {
                
                $sth=$conn->prepare("INSERT INTO car_camera (type_id,status,car_id) VALUES (?,?,?)");
                $sth->execute(array(
                    $camera,$status,$id
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
           header("Refresh:2; url=index.php?islem=arac-kamera&id=$id&count=$cnt");
        }
    
    
}else{
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12   ">

            <div class="card">
                <div class="card-header">
                    <strong>Bölge Düzenle</strong>                
                </div>
                <div class="card-body">
                <form METHOD="POST">

                <?php for($i=0;$i<$cnt;$i++){ ?>
                    <div class="form-group">
                        <label for="company"><?=$i+1?>. Kamera Tipi :</label>
                        <select name="camera<?=$i+1?>">
                        <?php foreach($cameras as $camera){ ?>
                        <option value="<?=$camera['id']?>"><?=$camera['camera']?></option>
                        <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="company"><?=$i+1?>. Kamera Durumu :</label>
                        <select name="status<?=$i+1?>">
                        <option value="0">Çalışıyor</option>
                        <option value="1">Arızalı</option>
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