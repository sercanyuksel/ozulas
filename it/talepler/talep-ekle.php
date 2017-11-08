<?php
$sth=$conn->prepare("SELECT * from cars");
$sth->execute();
$cars=$sth->fetchAll();
if($_POST)
{
    $dt=new DateTime($_POST['tarih']);
    $created_at = $dt->format('Y-m-d');
    $desc=$_POST['desc'];
    $car_id=$_POST['car_id'];
    $creator_id=$_SESSION['user_id'];
    $camera_id="";
    $talep_no=$_POST['talep_no'];
    foreach($_POST['camera'] as $cam){
        $camera_id=$camera_id.'-'.$cam;
    }
    $camera_id=substr($camera_id,1);
    $start_time=$_POST['start_time'];
    $stop_time=$_POST['stop_time'];
    $talep_no=$_POST['talep_no'];
    $sth=$conn->prepare("SELECT * from requests WHERE talep_no=?");
    $sth->execute(array($talep_no));
    if($sth->rowCount()>0){
        echo '
        
          <div class="row justify-content-center">
          <div class="col-md-12">
          <div class="alert alert-danger" style="padding:60px;">
          <h1><i class="fa fa-warning"></i> Bu Talep Numarası İçin Kayıt Zaten Oluşturulmuş.</h1><br/>
          Yönlendiriliyorsunuz...
          </div>
          </div>
          </div>
              
          ';
       header("Refresh:2; url=index.php?islem=talep-ekle");
    }else{
    if(empty($desc) || empty($car_id))
    {
        echo '
      
        <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="alert alert-danger" style="padding:60px;">
        <h1><i class="fa fa-warning"></i> Açıklama ve Araç Bölümlerini Boş Bırakamazsanız.</h1><br/>
        Yönlendiriliyorsunuz...
        </div>
        </div>
        </div>
        	
        ';
     header("Refresh:2; url=index.php?islem=talep-ekle");
    }
    else
    {
        $sth=$conn->prepare("INSERT INTO requests (talep_no,car_id,description,created_at,creator_id,status,camera_id,start_time,stop_time) VALUES (?,?,?,?,?,?,?,?,?)");
        $sth=$sth->execute(array(
            $talep_no,$car_id,$desc,$created_at,$creator_id,0,$camera_id,$start_time,$stop_time
        ));
        if($sth)
        {
            echo '
            
              <div class="row justify-content-center">
              <div class="col-md-12">
              <div class="alert alert-success" style="padding:60px;">
              <h1><i class="fa fa-check-circle-o"></i> Talep Ekleme Başarılı .</h1><br/>
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
           header("Refresh:2; url=index.php?islem=talep-ekle");
        }
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
                    <strong>Talep Ekle</strong>                
                </div>
                <div class="card-body">
                <form  method="POST">
                   
                    <div class="form-group">
                        <label for="desc">Talep No :</label>
                        <input type="text" name="talep_no"  class="form-control" id="desc"></input>
                    </div>

                    <div class="form-group">
                        <label for="company">Araç Kodu:</label>
                        <select class="form-control" name="car_id" id="car_id">
                        <option value="-1" disabled selected="selected">Araç Seçin</option>
                        <?php foreach($cars as $car) { ?>
                            <option value="<?=$car['id']?>"><?=$car['code']?></option>
                        <?php } ?>                        
                        </select><br/>
                        <input type="text" style="width:20%;" class="form-control" id="filterCar" placeholder="Araç Filtrele"></input>
                    </div>
                    <div class="form-group">
                        <label for="desc">Tarih :</label>
                        <input style="width:25%;" type="date" name="tarih"  class="form-control" id="desc"></input>
                    </div>
                    <div class="form-group">
                        <label for="desc">Başlangıç Zamanı :</label>
                        <input type="time" name="start_time"  class="form-control" id="desc"></input>
                    </div>
                    
                    <div class="form-group">
                        <label for="desc">Bitiş Zamanı :</label>
                        <input type="time" name="stop_time"  class="form-control" id="desc"></input>
                    </div>

                    <div class="form-group">
                        <label for="desc">Açıklama :</label>
                        <textarea rows="4" name="desc" class="form-control" id="desc" placeholder="Talep Açıklamasını Girin."></textarea>
                    </div>
  
                    <div class="row">
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary px-4">Ekle</button>
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