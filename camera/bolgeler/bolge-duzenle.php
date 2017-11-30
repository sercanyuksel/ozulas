<?php
$id=$_GET['id'];
$sth=$conn->prepare("SELECT * from area WHERE id=?");
$sth->execute(array(
    $id
));
$driver=$sth->fetch(PDO::FETCH_ASSOC);
if($_POST)
{
    $code=$_POST['code'];
    $name=$_POST['name'];
    $name2=$_POST['name2'];

    if(empty($code) || empty($name) || empty($name2))
    {
        echo '
      
        <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="alert alert-danger" style="padding:60px;">
        <h1><i class="fa fa-warning"></i> Bölge kodu Hat Kodu ve Hat Adını Boş Bırakamazsanız.</h1><br/>
        Yönlendiriliyorsunuz...
        </div>
        </div>
        </div>
        	
        ';
     header("Refresh:2; url=index.php?islem=bolge-duzenle&id=".$id);
    }
    else
    {
        $sth=$conn->prepare("UPDATE area SET code=?,name=?,name2=? WHERE id=?");
        $sth=$sth->execute(array(
            $code,$name,$name2,$id
        ));
        if($sth)
        {
            echo '
            
              <div class="row justify-content-center">
              <div class="col-md-12">
              <div class="alert alert-success" style="padding:60px;">
              <h1><i class="fa fa-check-circle-o"></i> Bölge Düzenleme Başarılı .</h1><br/>
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
           header("Refresh:2; url=index.php?islem=bolge-duzenle");
        }
    }
    
}else{
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12   ">

            <div class="card">
                <div class="card-header">
                    <strong>Bölge Düzenle</strong>                
                </div>
                <div class="card-body">
                <form METHOD="POST">

                    <div class="form-group">
                        <label for="company">Bölge Kodu :</label>
                        <input type="text" name="code" value="<?=$driver['code']?>" class="form-control" id="code">
                    </div>

                    <div class="form-group">
                        <label for="company">Hat Kodu :</label>
                        <input type="text" name="name" value="<?=$driver['name']?>" class="form-control" id="name" >
                    </div>
                    <div class="form-group">
                        <label for="company">Hat Adı :</label>
                        <input type="text" name="name2" value="<?=$driver['name2']?>" class="form-control" id="name2" >
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