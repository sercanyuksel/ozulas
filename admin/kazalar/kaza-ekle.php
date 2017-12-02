<?php
$sth=$conn->prepare("SELECT * from cars");
$sth->execute();
$cars=$sth->fetchAll();

$sth1=$conn->prepare("SELECT * from drivers");
$sth1->execute();
$drivers=$sth1->fetchAll();
if($_POST)
{
    $dt=new DateTime($_POST['tarih']);
    $created_at = $dt->format('Y-m-d');
    $description=$_POST['description'];
    $car_id=$_POST['car_id'];
    $creator_id=$_SESSION['user_id'];
    $driver_id=$_POST['driver_id'];
    $kaza_yeri=$_POST['kaza_yeri'];
    $kaza_arac=$_POST['kaza_arac'];
    $kaza_durumu=$_POST['kaza_durumu'];

    $file_name = $_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
    $file_type = $_FILES['file']['type'];
    $file_size = $_FILES['file']['size'];
    $folder="C:/xampp/uploads/";


    if(empty($description) || empty($car_id))
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
     header("Refresh:2; url=index.php?islem=kaza-ekle");
    }
    else
    {
        move_uploaded_file($file_loc,$folder.$file_name);
        $sth=$conn->prepare("INSERT INTO accidents (car_id,description,creator_id,driver_id,kaza_yeri,kaza_arac,kaza_durumu,file_name,file_type,file_size,tarih) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        $sth=$sth->execute(array(
            $car_id,$description,$creator_id,$driver_id,$kaza_yeri,$kaza_arac,$kaza_durumu,$file_name ,$file_type,$file_size,$created_at
        ));
        if($sth)
        {
            echo '
            
              <div class="row justify-content-center">
              <div class="col-md-12">
              <div class="alert alert-success" style="padding:60px;">
              <h1><i class="fa fa-check-circle-o"></i> Kaza Ekleme Başarılı .</h1><br/>
              Yönlendiriliyorsunuz...
              </div>
              </div>
              </div>
                  
              ';
           header("Refresh:2; url=index.php?islem=kazalar");
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
           header("Refresh:2; url=index.php?islem=kaza-ekle");
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
                    <strong>Kaza Ekle</strong>                
                </div>
                <div class="card-body">
                <form method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="company">Araç Kodu:</label>
                        <select class="form-control" name="car_id" id="car_id">
                        <option value="-1" disabled selected="selected">Araç Seçin</option>
                        <?php foreach($cars as $car) { ?>
                            <option value="<?=$car['id']?>"><?=$car['code']?></option>

                        <?php } ?>                        
                        </select><br/>
                    </div>
                    <div class="form-group">
                        <label for="company">Kaza Durumu Seçin:</label>
                        <select class="form-control" name="kaza_durumu" id="kaza_durumu">
                        <option value="-1" disabled selected="selected">Kaza Durumu Seçin</option>
                        <option value="Yaralamalı">Yaralamalı</option>
                        <option value="Maddi Hasarlı">Maddi Hasarlı</option> 
                        <option value="Ölümlü">Ölümlü</option>       
                        </select><br/>
                    </div>
                    <div class="form-group">
                        <label for="desc"> Kaza Yapılan Araç Plaka:</label>
                        <input type="text" name="kaza_arac"  class="form-control" id="desc" placeholder="Plakayı Girin."></input>
                    </div>
                    <div class="form-group">
                        <label for="desc"> Kaza Yeri:</label>
                        <input type="text" name="kaza_yeri"  class="form-control" id="desc" placeholder="Kaza Yapılan Yeri Girin."></input>
                    </div>
                    <div class="form-group">
                    <div class="form-group">
                        <label for="company">Araç Kodu:</label>
                        <select class="form-control" name="driver_id" id="driver_id">
                        <option value="-1" disabled selected="selected">Şoför Seçin</option>
                        <?php foreach($drivers as $driver) { ?>
                            <option value="<?=$driver['id']?>"><?=$driver['name']?><?=$driver['surname']?></option>

                        <?php } ?>                        
                        </select><br/>
                    </div>
                        <label for="desc">Tarih :</label>
                        <input style="width:25%" type="date" name="tarih"  class="form-control" id="desc"></input>
                    </div>
                    <div class="form-group" >
                     <label for="company">Resim Ekle :</label>
                     <input type="file" name="file" class="form-control" enctype="multipart/form-data"/>
                     
                </div> 
                    <div class="form-group">
                        <label for="desc">Açıklama :</label>
                        <textarea rows="4" name="description" class="form-control" id="description" placeholder="Talep Açıklamasını Girin."></textarea>
                    </div>
  
                    <div class="row">
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary px-4">Ekle</button>


                        </div>
                        <div class="col-6 text-right">
                            <input type="button"class="btn btn-primary px-4" value="Geri" onclick="history.back(-1)" />

                        </div>
                    </div>

                </form>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
var options=
</script>
<script type="text/javascript" src="kazalar/handle.js"></script>
<?php }
?>