<?php
$id=$_GET['id'];
$sth=$conn->prepare("SELECT * from troubles WHERE id=?");
$sth->execute(array(
    $id
));
$trouble=$sth->fetch(PDO::FETCH_ASSOC);
if($_POST)
{
    $trouble=$_POST['trouble'];
   

    if(empty($trouble))
    {
        echo '
      
        <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="alert alert-danger" style="padding:60px;">
        <h1><i class="fa fa-warning"></i> Arıza Tipini Boş Bırakamazsanız.</h1><br/>
        Yönlendiriliyorsunuz...
        </div>
        </div>
        </div>
        	
        ';
     header("Refresh:2; url=index.php?islem=kamera-tip-duzenle&id=".$id);
    }
    else
    {
        $sth=$conn->prepare("UPDATE troubles SET trouble=? WHERE id=?");
        $sth=$sth->execute(array(
            $trouble,$id
        ));
        if($sth)
        {
            echo '
            
              <div class="row justify-content-center">
              <div class="col-md-12">
              <div class="alert alert-success" style="padding:60px;">
              <h1><i class="fa fa-check-circle-o"></i> Arıza Tipi Düzenleme Başarılı .</h1><br/>
              Yönlendiriliyorsunuz...
              </div>
              </div>
              </div>
                  
              ';
           header("Refresh:2; url=index.php?islem=ariza-tipleri");
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
           header("Refresh:2; url=index.php?islem=ariza-tip-duzenle");
        }
    }
    
}else{
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12   ">

            <div class="card">
                <div class="card-header">
                    <strong>Arıza Tipi Düzenle</strong>                
                </div>
                <div class="card-body">
                <form METHOD="POST">

                    <div class="form-group">
                        <label for="company">Arıza Tipi :</label>
                        <input type="text" name="trouble" value="<?=$trouble['trouble']?>" class="form-control" id="trouble">
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary px-4">Düzenle</button>
                        </div>
                    </div>
                    </form>
                </div>
                
               

            </div>

        </div>
    </div>
</div>
<?php } ?>