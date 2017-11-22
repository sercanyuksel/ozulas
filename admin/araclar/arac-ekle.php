<?php
$sth=$conn->query("SELECT * from brand");
$brands=$sth->fetchAll(PDO::FETCH_ASSOC);
$sth=$conn->query("SELECT * from area");
$areas=$sth->fetchAll(PDO::FETCH_ASSOC);
if($_POST)
{
    
    $code=$_POST['code'];
    $license=$_POST['license'];
    $area_id=$_POST['area'];
    $brand_id=$_POST['brand'];
    $model=$_POST['model'];
    $camera_count=$_POST['camera_count'];
    if(empty($code) || empty($license) || empty($area_id) || empty($brand_id) || empty($model) || empty($camera_count))
    {
        echo '
      
        <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="alert alert-danger" style="padding:60px;">
        <h1><i class="fa fa-warning"></i>Boş Alan Bırakmayınız.</h1><br/>
        Yönlendiriliyorsunuz...
        </div>
        </div>
        </div>
        	
        ';
     header("Refresh:2; url=index.php?islem=arac-ekle");
    }
    else
    {
        $sth=$conn->prepare("INSERT INTO cars (code,license,area_id,brand_id,model,camera_count) VALUES (?,?,?,?,?,?)");
        $sth=$sth->execute(array(
            $code,$license,$area_id,$brand_id,$model,$camera_count
        ));
        $last_row=$conn->query("SELECT id from cars ORDER by id DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
        $last_id=$last_row['id'];
        if($sth)
        {
            echo '
            
              <div class="row justify-content-center">
              <div class="col-md-12">
              <div class="alert alert-success" style="padding:60px;">
              <h1><i class="fa fa-check-circle-o"></i> Araç Ekleme Başarılı .Kamera Ayarlarına Yönlendiriliyorsunuz.</h1><br/>
              Yönlendiriliyorsunuz...
              </div>
              </div>
              </div>
                  
              ';
           header("Refresh:2; url=index.php?islem=arac-kamera&id=$last_id&count=$camera_count");
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
           header("Refresh:2; url=index.php?islem=bolge-ekle");
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
                    <strong>Araç Ekle</strong>                
                </div>
                <div class="card-body">
                <form method="POST">
                   
                <div class="form-group">
                    <label for="company">Araç Kodu :</label>
                    <input type="text" name="code" class="form-control" id="code" placeholder="Araç Kodunu Giriniz.">
                </div>

                <div class="form-group">
                    <label for="company">Araç Plakası :</label>
                    <input type="text" name="license" class="form-control" id="license" placeholder="Araç Plakasını Giriniz.">
                </div>

                <div class="form-group">
                    <label for="company">Araç Bölgesi :</label>
                    <select name="area">
                    <?php foreach($areas as $area){ ?>
                    <option value="<?=$area['id']?>"><?=$area['code']?>-<?=$area['name']?></option>
                    <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="company">Araç Markası :</label>
                    <select name="brand">
                    <?php foreach($brands as $brand){ ?>
                    <option value="<?=$brand['id']?>"><?=$brand['brand']?></option>
                    <?php } ?>
                    </select>
                </div>        

                <div class="form-group">
                    <label for="company">Model :</label>
                    <input type="text" name="model" class="form-control" id="model" placeholder="Araç Modelini Giriniz.">
                </div>

                <div class="form-group">
                    <label for="company">Kamera Sayısı :</label>
                    <input type="text" name="camera_count" class="form-control" id="camera_count" placeholder="Araç Kamera Sayısını Giriniz.">
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
<?php } ?>