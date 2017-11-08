<?php
$id=$_GET['id'];
$sth=$conn->prepare("SELECT * from cars WHERE id=?");
$sth->execute(array(
    $id
));
$car=$sth->fetch(PDO::FETCH_ASSOC);
$sth=$conn->prepare("SELECT * from area");
$sth->execute();
$areas=$sth->fetchAll(PDO::FETCH_ASSOC);
if($_POST)
{
    $code=$_POST['code'];
    $area_id=$_POST['area_id'];
    $license=$_POST['license'];
    $m2m_gsm=$_POST['m2m_gsm'];
    $m2m_ip=$_POST['m2m_ip'];
    $gsm_15=$_POST['gsm_15'];
    $ip_15=$_POST['ip_15'];
    $hdd=$_POST['hdd'];
    $kayit_sure=$_POST['kayit_sure'];
    $dvr=$_POST['dvr'];
    if(empty($code))
    {
        echo '
      
        <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="alert alert-danger" style="padding:60px;">
        <h1><i class="fa fa-warning"></i>Kodu Boş Bırakamazsanız.</h1><br/>
        Yönlendiriliyorsunuz...
        </div>
        </div>
        </div>
        	
        ';
     header("Refresh:2; url=index.php?islem=arac-duzenle&id".$id);
    }
    else
    {
        $sth=$conn->prepare("UPDATE cars SET area_id=?,code=?,license=?,m2m_gsm=?,m2m_ip=?,15_gsm=?,15_ip=?,hdd=?,kayit_sure=?,dvr=? WHERE id=?");
        $sth=$sth->execute(array(
            $area_id,$code,$license,$m2m_gsm,$m2m_ip,$gsm_15,$ip_15,$hdd,$kayit_sure,$dvr,$id
        ));
        if($sth)
        {
            echo '
            
              <div class="row justify-content-center">
              <div class="col-md-12">
              <div class="alert alert-success" style="padding:60px;">
              <h1><i class="fa fa-check-circle-o"></i> Araç Düzenleme Başarılı .</h1><br/>
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
           header("Refresh:2; url=index.php?islem=araclar");
        }
    }
    
}else{
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12   ">

            <div class="card">
                <div class="card-header">
                    <strong>Araç Düzenle</strong>                
                </div>
                <div class="card-body">
                <form METHOD="POST">

                    <div class="form-group">
                        <label for="company">Araç Kodu :</label>
                        <input disabled type="text" name="code" value="<?=$car['code']?>" class="form-control" id="code">
                    </div>

                    <div class="form-group">
                        <label for="company">Bölge :</label>
                        <select disabled name="area_id" class="form-control" id="code">
                            <?php foreach($areas as $area){ ?>
                                <option value="<?=$area['id']?>" <?php if($area['id']==$car['area_id']) echo 'selected="selected"';?>><?=$area['code']?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="company">Plaka :</label>
                        <input disabled type="text" name="license" value="<?=$car['license']?>" class="form-control" id="name" >
                    </div>

                    <div class="form-group">
                        <label for="company">m2m_gsm :</label>
                        <input disabled type="text" name="m2m_gsm" value="<?=$car['m2m_gsm']?>" class="form-control" id="name" >
                    </div>

                    <div class="form-group">
                        <label for="company">m2m_ip :</label>
                        <input disabled type="text" name="m2m_ip" value="<?=$car['m2m_ip']?>" class="form-control" id="name" >
                    </div>

                    <div class="form-group">
                        <label for="company">15gb gsm :</label>
                        <input disabled type="text" name="gsm_15" value="<?=$car['15_gsm']?>" class="form-control" id="name" >
                    </div>

                    <div class="form-group">
                        <label for="company">15gb ip :</label>
                        <input disabled type="text" name="ip_15" value="<?=$car['15_ip']?>" class="form-control" id="name" >
                    </div>

                    <div class="form-group">
                        <label for="company">Hdd :</label>
                        <input disabled type="text" name="hdd" value="<?=$car['hdd']?>" class="form-control" id="name" >
                    </div>

                    <div class="form-group">
                        <label for="company">Kayıt Süre :</label>
                        <input disabled type="text" name="kayit_sure" value="<?=$car['kayit_sure']?>" class="form-control" id="name" >
                    </div>

                    <div class="form-group">
                        <label for="company">Dvr :</label>
                        <input disabled type="text" name="dvr" value="<?=$car['dvr']?>" class="form-control" id="name" >
                    </div>

                   
                    </form>
                </div>
                
               

            </div>

        </div>
    </div>
</div>
<?php } ?>