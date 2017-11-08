<?php

if($_POST)
{
    
    $code=$_POST['code'];
    $license=$_POST['license'];
    $area_id=$_POST['area'];
    $brand_id=$_POST['brand'];
    $model=$_POST['model'];
    $camera_count=$_POST['camera_count'];
    if(empty($code) || empty($name))
    {
        echo '
      
        <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="alert alert-danger" style="padding:60px;">
        <h1><i class="fa fa-warning"></i>Bölge Kodu ve Bölge Bölümlerini Boş Bırakamazsanız.</h1><br/>
        Yönlendiriliyorsunuz...
        </div>
        </div>
        </div>
        	
        ';
     header("Refresh:2; url=index.php?islem=bolge-ekle");
    }
    else
    {
        $sth=$conn->prepare("INSERT INTO area (code,name) VALUES (?,?)");
        $sth=$sth->execute(array(
            $code,$name
        ));
        if($sth)
        {
            echo '
            
              <div class="row justify-content-center">
              <div class="col-md-12">
              <div class="alert alert-success" style="padding:60px;">
              <h1><i class="fa fa-check-circle-o"></i> Bölge Ekleme Başarılı .</h1><br/>
              Yönlendiriliyorsunuz...
              </div>
              </div>
              </div>
                  
              ';
           header("Refresh:2; url=index.php?islem=bolgeler");
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
                    <strong>Bölge Ekle</strong>                
                </div>
                <div class="card-body">
                <form method="POST">
                   
                <div class="form-group">
                    <label for="company">Bölge Kodu :</label>
                    <input type="text" name="code" class="form-control" id="code" placeholder="Bölge Kodunu Giriniz.">
                </div>

                <div class="form-group">
                    <label for="company">Bölge Adı :</label>
                    <input type="text" name="name" class="form-control" id="area" placeholder="Bölge Adını Giriniz.">
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