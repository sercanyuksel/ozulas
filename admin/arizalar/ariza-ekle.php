<?php

$sth=$conn->query("SELECT * from cars");
$cars=$sth->fetchAll(PDO::FETCH_ASSOC);

$sth=$conn->query("SELECT * from drivers");
$drivers=$sth->fetchAll(PDO::FETCH_ASSOC);

$sth=$conn->query("SELECT * from troubles");
$troubles=$sth->fetchAll(PDO::FETCH_ASSOC);

if($_POST)
{
    $arac_kodu=$_POST['arac_kodu'];

    $surucu_adi=$_POST['driver'];
    $ihbar_saati=$_POST['ihbar_saati'];
    $talimat_veren=$_POST['talimat_veren'];
    $dt=new DateTime();
    $created_at = $dt->format('Y-m-d');
    $ariza_tipi=$_POST['ariza_tipi'];

    if(empty($arac_kodu))
    {
        echo '
      
        <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="alert alert-danger" style="padding:60px;">
        <h1><i class="fa fa-warning"></i> Araç Kodunu Boş Bırakamazsanız.</h1><br/>
        Yönlendiriliyorsunuz...
        </div>
        </div>
        </div>
        	
        ';
     header("Refresh:2; url=index.php?islem=ariza-ekle");
    }
    else
    {
        $sth=$conn->prepare("INSERT INTO car_troubles (car_id,ihbar_saati,driver,talimat_veren,trouble_date,trouble_id) VALUES (?,?,?,?,?,?)");
        $sth=$sth->execute(array(
            $arac_kodu,$ihbar_saati,$surucu_adi,$talimat_veren,$created_at,$ariza_tipi
        ));
        if($sth)
        {
            echo '
            
              <div class="row justify-content-center">
              <div class="col-md-12">
              <div class="alert alert-success" style="padding:60px;">
              <h1><i class="fa fa-check-circle-o"></i> Arıza Ekleme Başarılı .</h1><br/>
              Yönlendiriliyorsunuz...
              </div>
              </div>
              </div>
                  
              ';
           header("Refresh:2; url=index.php?islem=arizalar");
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
           header("Refresh:2; url=index.php?islem=ariza-ekle");
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
                    <strong>Arıza Ekle</strong>                
                </div>
                <div class="card-body">
                <form method="POST">

            <div class="form-group">
                <label for="company">Araç Kodu :</label><br>
                <select id="car_id" name="arac_kodu" class="form-control col-sm-12 col-md-6">
                <option disabled selected="selected"> Araç kodu seçiniz... </option>
                <?php foreach($cars as $car){ ?>
                <option value="<?=$car['id']?>"><?=$car['code']?></option>
                <?php } ?>
                </select><br />
                <input type="text" style="width:20%;" class="form-control" id="filterCar" placeholder="Araç Filtrele"></input>

            </div> 
               

                    <div class="form-group">
                    <label for="company">Sürücü :</label><br> 
                    <input type="text" name="driver" class="form-control col-sm-12 col-md-6" id="company" placeholder="Sürücü Adı ve Soyadını Giriniz.">
                    </select>
                </div> 

                    <div class="form-group">
                        <label for="company">İhbar Saati :</label>
                        <input type="time" name="ihbar_saati" class="form-control col-sm-12 col-md-6" id="company" placeholder="İhbar Saatini Giriniz.">
                    </div>

                    <div class="form-group">
                        <label for="company">Talimat Veren :</label>
                        <input type="text" name="talimat_veren" class="form-control col-sm-12 col-md-6" id="company" placeholder="Talimat Vereni Giriniz.">
                    </div>

                  

                    <div class="form-group">
                    <label for="company">Arıza Tipi :</label><br>
                    <select name="ariza_tipi" class="form-control col-sm-12 col-md-6">
                    <option disabled selected="selected"> Arıza tipi seçiniz... </option>
                    <?php foreach($troubles as $trouble){ ?>
                    <option value="<?=$trouble['id']?>"><?=$trouble['trouble']?></option>
                    <?php } ?>
                    </select>
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
<?php } ?>
<script type="text/javascript" src="arizalar/handle.js"></script>