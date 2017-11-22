<?php
$id=$_GET['id'];
$sth=$conn->prepare("SELECT * from requests WHERE id=?");
$sth->execute(array($id));
$request=$sth->fetch(PDO::FETCH_ASSOC);

if($_POST)
{
    $uploadOk = 0;
    if($_FILES){
    $target_dir = $_SERVER['DOCUMENT_ROOT']."uploads/";
    $target_file = $target_dir.$request['talep_no'].'-'.mt_rand(). basename($_FILES["file"]["name"]);
    
      
        if($_FILES["file"]["tmp_name"]!="")
    {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            $uploadOk=1;
        } else {
            $uploadOk=0;
        }
        $sth=$conn->prepare("INSERT INTO request_files (filename,talep_id) VALUES (?,?)");
        $sth=$sth->execute(array(
            $target_file,$id
        ));
       
        
            if($sth && $uploadOk==1)
            {
                echo '
                
                  <div class="row justify-content-center">
                  <div class="col-md-12">
                  <div class="alert alert-success" style="padding:60px;">
                  <h1><i class="fa fa-check-circle-o"></i> Dosya Ekleme Başarılı .</h1><br/>
                  Yönlendiriliyorsunuz...
                  </div>
                  </div>
                  </div>
                      
                  ';
               header("Refresh:2; url=index.php?islem=talepler");
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
               header("Refresh:2; url=index.php?islem=talep-detay&id=".$id);
            }
    }
    else {
        echo '
        
          <div class="row justify-content-center">
          <div class="col-md-12">
          <div class="alert alert-danger" style="padding:60px;">
          <h1><i class="fa fa-warning"></i>Dosya Seçmediniz!</h1><br/>
          Yönlendiriliyorsunuz...
          </div>
          </div>
          </div>
              
          ';
       header("Refresh:2; url=index.php?islem=talep-detay&id=".$id);
    }
    }
    else{
        echo '
        <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="alert alert-danger" style="padding:60px;">
        <h1><i class="fa fa-danger"></i>Dosya Seçmediniz.Yönlendiriliyorsunzu</h1><br/>
        Yönlendiriliyorsunuz...
        </div>
        </div>
        </div>';
        header("Refresh:2; url=index.php?islem=talep-detay&id=".$id);
    }
  
    
    
}
else{
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12   ">

            <div class="card">
                <div class="card-header">
                    <strong>Dosya Ekle</strong>                
                </div>
                <div class="card-body">
                <form method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="company">Talep No :</label>
                        <input type="text" readonly name="talep_no" value="<?=$request['talep_no']?>" />
                    </div>

                    <div class="form-group">
                        <label for="company">
                            <?php if($request['response_status']==0) echo 'Resim :';else echo 'Video :' ?>
                        </label>
                        <input type="file" name="file"/>
                    </div>

                   

                    <div class="row">
                        <div class="col-6">
                            <button type="submit" class="btn btn-danger px-4" >Ekle</button>
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
<script type="text/javascript" src="talepler/handle.js"></script>
<?php }
?>