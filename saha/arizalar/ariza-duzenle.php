<?php
$id=$_GET['id'];
$sth=$conn->prepare("SELECT c.*,t.trouble as ctrouble,ca.code as code from car_troubles c INNER JOIN troubles t ON c.trouble_id=t.id INNER JOIN cars ca ON c.car_id=ca.id WHERE c.id=?");
$sth->execute(array(
    $id
));
$car_trouble=$sth->fetch(PDO::FETCH_ASSOC);

$sth=$conn->prepare("SELECT * from cars");
$sth->execute();
$cars=$sth->fetchAll(PDO::FETCH_ASSOC);

$sth=$conn->prepare("SELECT * from troubles");
$sth->execute();
$troubles=$sth->fetchAll(PDO::FETCH_ASSOC);
$mudahale=false;
if(@$car_trouble['mudahale_yeri']){
$mudahale=true;
}
$mudahale_saati=false;

if(@$car_trouble['mudahale_saati']!="00:00:00"){
    $mudahale_saati=true;
    }
    $donus=false;
    if(@$car_trouble['donus_saati']!="00:00:00"){
        $donus=true;
        }
        $mesai=false;
        if(@$car_trouble['mesai']){
            $mesai=true;
            }
            $sonuc=false;
            if(@$car_trouble['sonuc']){
                $sonuc=true;
                }

if($_POST)
{
    $mudahale_yeri=$_POST['mudahale_yeri'];
    $mudahale_saati=$_POST['mudahale_saati'];
    $donus_saati=$_POST['donus_saati'];
    $sonuc=$_POST['sonuc'];
    if($car_trouble['mesai']){
    $mesai=$car_trouble['mesai'];
    }
    else $mesai=$_POST['mesai'];

    if(empty($mudahale_yeri) || empty($mudahale_saati))
    {
        echo '
      
        <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="alert alert-danger" style="padding:60px;">
        <h1><i class="fa fa-warning"></i> Müdahale Yeri ve Saatini Boş Bırakamazsanız.</h1><br/>
        Yönlendiriliyorsunuz...
        </div>
        </div>
        </div>
        	
        ';
     header("Refresh:2; url=index.php?islem=ariza-duzenle&id=".$id);
    }
    else
    {
        $sth=$conn->prepare("UPDATE car_troubles SET mudahale_yeri=?,mudahale_saati=?,donus_saati=?,mesai=?,sonuc=? WHERE id=?");
        $sth=$sth->execute(array(
            $mudahale_yeri,$mudahale_saati,$donus_saati,$mesai,$sonuc,$id
        ));
        if($sth)
        {
            echo '
            
              <div class="row justify-content-center">
              <div class="col-md-12">
              <div class="alert alert-success" style="padding:60px;">
              <h1><i class="fa fa-check-circle-o"></i> Arıza Düzenleme Başarılı .</h1><br/>
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
           header("Refresh:2; url=index.php?islem=ariza-duzenle&id=".$id);
        }
    }
    
}else{
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12   ">

            <div class="card">
                <div class="card-header">
                    <strong>Arıza Düzenle</strong>                
                </div>
                <div class="card-body">
                <form METHOD="POST">
                <div class="form-group">
                        <label for="company">Talimat Veren :</label>
                        <input  type="text" disabled name="talimat_veren" class="form-control col-sm-12 col-md-6" id="company"  value="<?=$car_trouble['talimat_veren']?>">
                    </div>
                    <div class="form-group">
                        <label for="company">Araç Kodu :</label>
                        <select disabled name="arac_kodu" class="form-control" id="company">
                        <?php foreach($cars as $car) {
                        ?>
                        <option <?php if($car_trouble['car_id']==$car['id']) echo 'selected="selected"'; ?> value="<?=$car['id']?>">
                        <?=$car['code']?>
                        </option>
                        <?php }
                        ?>
                        </select>
                    </div>

                    <div class="form-group">
                    <label for="company">Araç Şoförü :</label>
                    <input disabled type="text" name="tarih" class="form-control col-sm-12 col-md-6" id="company"  value="<?=$car_trouble['driver']?>">
                    </div>
                    <div class="form-group">
                        <label for="company">Tarih :</label>
                        <input disabled type="text" name="tarih" class="form-control col-sm-12 col-md-6" id="company"  value="<?=$car_trouble['trouble_date']?>">
                    </div>
                    <div class="form-group">
                        <label for="company">İhbar Saati :</label>
                        <input disabled type="text" name="ariza_tarihi" class="form-control col-sm-12 col-md-6" id="company"  value="<?=$car_trouble['ihbar_saati']?>">
                    </div>
                    
                    <div class="form-group">
                    <label for="company">Arıza Nedeni :</label>
                    <select disabled name="ariza" class="form-control" id="company">
                    <?php foreach($troubles as $trouble) {
                    ?>
                    <option <?php if($car_trouble['trouble_id']==$trouble['id']) echo 'selected="selected"'; ?> value="<?=$trouble['id']?>">
                    <?=$trouble['trouble']?>
                    </option>
                    <?php }
                    ?>
                    </select>
                    </div>

                    <div class="form-group">
                        <label for="company">Müdahale Yeri :</label>
                        <input <?php if($mudahale) echo 'readonly value="'.$car_trouble['mudahale_yeri'].'"' ?> type="text" name="mudahale_yeri" class="form-control col-sm-12 col-md-6" id="company"  placeholder="Müdahale Yeri">
                    </div>

                    <div class="form-group">
                        <label for="company">Müdahale Saati :</label>
                        <input <?php if($mudahale_saati) echo 'readonly value="'.$car_trouble['mudahale_saati'].'"' ?> type="time" name="mudahale_saati" class="form-control col-sm-12 col-md-6" id="company"  >
                    </div>
                    
                    <div class="form-group">
                        <label for="company">Dönüş Saati :</label>
                        <input   <?php if($donus) echo 'readonly value="'.$car_trouble['donus_saati'].'"' ?> type="time" name="donus_saati" class="form-control col-sm-12 col-md-6" id="company"  >
                    </div>
                    
                    <div class="form-group">
                        <label for="company">Mesai İçi/Mesai Dışı :</label>
                        <select  <?php if($mesai) echo 'disabled'; ?> name="mesai">
                            <option <?php if($mesai){if($car_trouble['mesai']==0) echo 'selected="selected"'; } ?>value="0">Mesai İçi</option>
                            <option <?php if($mesai){if($car_trouble['mesai']==1) echo 'selected="selected"'; } ?> value="1">Mesai Dışı</option>
                    </select>
                    </div>

                    <div class="form-group">
                        <label for="company">Sonuç :</label>
                        <textarea  <?php if($sonuc) echo'readonly'; ?> name="sonuc" class="form-control col-sm-12 col-md-6" id="company"  rows="4"><?php if($sonuc) echo $car_trouble['sonuc']; ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <button <?php if($sonuc) echo 'disabled title="Arıza Talebi Kapanmış"'; ?> type="submit" class="btn btn-primary px-4">Düzenle</button>
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
<?php } ?>