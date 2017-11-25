<?php
$id=$_GET['id'];
$sth=$conn->prepare("SELECT * from camera_types WHERE id=?");
$sth->execute(array(
    $id
));
$type=$sth->fetch(PDO::FETCH_ASSOC);
if($_POST)
{
    $type=$_POST['type'];
   

    if(empty($type))
    {
        echo '
      
        <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="alert alert-danger" style="padding:60px;">
        <h1><i class="fa fa-warning"></i> Kamera Tipini Boş Bırakamazsanız.</h1><br/>
        Yönlendiriliyorsunuz...
        </div>
        </div>
        </div>
        	
        ';
     header("Refresh:2; url=index.php?islem=kamera-duzenle&id=".$id);
    }
    else
    {
        $sth=$conn->prepare("UPDATE camera_types SET camera=? WHERE id=?");
        $sth=$sth->execute(array(
            $type,$id
        ));
        if($sth)
        {
            echo '
            
              <div class="row justify-content-center">
              <div class="col-md-12">
              <div class="alert alert-success" style="padding:60px;">
              <h1><i class="fa fa-check-circle-o"></i> Kamera Tipi Düzenleme Başarılı .</h1><br/>
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
           header("Refresh:2; url=index.php?islem=kamera-duzenle");
        }
    }
    
}else{
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12   ">

            <div class="card">
                <div class="card-header">
                    <strong>Kamera Tipi Düzenle</strong>                
                </div>
                <div class="card-body">
                <form METHOD="POST">

                    <div class="form-group">
                        <label for="company">Kamera Tipi :</label>
                        <input type="text" name="type" value="<?=$type['camera']?>" class="form-control" id="type">
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary px-4">Düzenle</button>
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