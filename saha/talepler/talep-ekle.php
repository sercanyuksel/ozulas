<?php
// post varsa
//selam
//ceren keşke bir işi becerebilse
//dinçer neden malak
if($_POST)
{
    $dt=new DateTime();
	$created_at = $dt->format('Y-m-d H:i:s');
    $desc=$_POST['desc'];
    $car_id=$_POST['car_id'];
    $creator_id=$_SESSION['user_id'];
    if(empty($desc) || empty($car_id))
    {
        echo '
      
        <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="alert alert-danger" style="padding:60px;">
        <h1><i class="fa fa-warning"></i> Açıklama ve Araç Bölümlerini Boş Bırakamazsanız.</h1><br/>
        Yönlendiriliyorsunuz...
        </div>
        </div>
        </div>
        	
        ';
     header("Refresh:2; url=index.php?islem=talep-ekle");
    }
    else
    {
        $sth=$conn->prepare("INSERT INTO requests (car_id,description,created_at,creator_id,status) VALUES (?,?,?,?,?)");
        $sth=$sth->execute(array(
            $car_id,$desc,$created_at,$creator_id,0
        ));
        if($sth)
        {
            echo '
            
              <div class="row justify-content-center">
              <div class="col-md-12">
              <div class="alert alert-success" style="padding:60px;">
              <h1><i class="fa fa-check-circle-o"></i> Talep Ekleme Başarılı .</h1><br/>
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
           header("Refresh:2; url=index.php?islem=talep-ekle");
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
                    <strong>Talep Ekle</strong>                
                </div>
                <div class="card-body">
                <form method="POST">
                   
                    <div class="form-group">
                        <label for="company">Araç :</label>
                        <select class="form-control" name="car_id">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>                        
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="desc">Açıklama :</label>
                        <textarea rows="4" name="desc" class="form-control" id="desc" placeholder="Talep Açıklamasını Girin."></textarea>
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