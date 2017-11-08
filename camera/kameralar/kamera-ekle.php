<?php

if($_POST)
{
    
    $camera=$_POST['type'];
   
    if(empty($camera))
    {
        echo '
      
        <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="alert alert-danger" style="padding:60px;">
        <h1><i class="fa fa-warning"></i>Kamera Tipini Boş Bırakamazsanız.</h1><br/>
        Yönlendiriliyorsunuz...
        </div>
        </div>
        </div>
        	
        ';
     header("Refresh:2; url=index.php?islem=kamera-ekle");
    }
    else
    {
        $sth=$conn->prepare("INSERT INTO camera_types (camera) VALUES (?)");
        $sth=$sth->execute(array(
            $camera
        ));
        if($sth)
        {
            echo '
            
              <div class="row justify-content-center">
              <div class="col-md-12">
              <div class="alert alert-success" style="padding:60px;">
              <h1><i class="fa fa-check-circle-o"></i> Kamera Tipi Ekleme Başarılı .</h1><br/>
              Yönlendiriliyorsunuz...
              </div>
              </div>
              </div>
                  
              ';
           header("Refresh:2; url=index.php?islem=kameralar");
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
           header("Refresh:2; url=index.php?islem=kamera-ekle");
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
                    <strong>Kamera Ekle</strong>                
                </div>
                <div class="card-body">
                <form method="POST">
                   
                <div class="form-group">
                    <label for="company">Kamera  Tipi :</label>
                    <input type="text" name="type" class="form-control" id="type" placeholder="Kamera Tipini Girin.">
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