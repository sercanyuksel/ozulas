<?php

if($_POST)
{
    
    $brand=$_POST['brand'];
   
    if(empty($brand))
    {
        echo '
      
        <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="alert alert-danger" style="padding:60px;">
        <h1><i class="fa fa-warning"></i>Marka Adını Boş Bırakamazsanız.</h1><br/>
        Yönlendiriliyorsunuz...
        </div>
        </div>
        </div>
        	
        ';
     header("Refresh:2; url=index.php?islem=marka-ekle");
    }
    else
    {
        $sth=$conn->prepare("INSERT INTO brand (brand) VALUES (?)");
        $sth=$sth->execute(array(
            $brand
        ));
        if($sth)
        {
            echo '
            
              <div class="row justify-content-center">
              <div class="col-md-12">
              <div class="alert alert-success" style="padding:60px;">
              <h1><i class="fa fa-check-circle-o"></i> Marka Ekleme Başarılı .</h1><br/>
              Yönlendiriliyorsunuz...
              </div>
              </div>
              </div>
                  
              ';
           header("Refresh:2; url=index.php?islem=markalar");
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
           header("Refresh:2; url=index.php?islem=marka-ekle");
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
                    <strong>Marka Ekle</strong>                
                </div>
                <div class="card-body">
                <form method="POST">
                   
                <div class="form-group">
                    <label for="company">Marka Adı :</label>
                    <input type="text" name="brand" class="form-control" id="brand" placeholder="Marka Adını Giriniz.">
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