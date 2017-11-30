<?php

$sth=$conn->prepare("SELECT * from type");
$sth->execute();
$types=$sth->fetchAll(PDO::FETCH_ASSOC);
if($_POST)
{
    $ad=$_POST['name'];
    $soyad=$_POST['surname'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $type=$_POST['type'];

    if(empty($username) && empty($password))
    {
        echo '
      
        <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="alert alert-danger" style="padding:60px;">
        <h1><i class="fa fa-warning"></i> Kullanıcı Adı ve Şifresini Boş Bırakamazsanız.</h1><br/>
        Yönlendiriliyorsunuz...
        </div>
        </div>
        </div>
        	
        ';
     header("Refresh:2; url=index.php?islem=kullanici-ekle");
    }
    else
    {
        $sth=$conn->prepare("INSERT INTO users (username,password,name,surname,type_id) VALUES (?,?,?,?,?)");
        $sth=$sth->execute(array(
            $username,$password,$ad,$soyad,$type
        ));
        if($sth)
        {
            echo '
            
              <div class="row justify-content-center">
              <div class="col-md-12">
              <div class="alert alert-success" style="padding:60px;">
              <h1><i class="fa fa-check-circle-o"></i> Kullanıcı Ekleme Başarılı .</h1><br/>
              Yönlendiriliyorsunuz...
              </div>
              </div>
              </div>
                  
              ';
           header("Refresh:2; url=index.php?islem=kullanicilar");
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
           header("Refresh:2; url=index.php?islem=kullanici-ekle");
        }
    }
    
}else{
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12   ">

            <div class="card">
                <div class="card-header">
                    <strong>Kullanıcı Ekle</strong>                
                </div>
                <div class="card-body">
                <form METHOD="POST">

                    <div class="form-group">
                        <label for="company">Kullanıcı Adı :</label>
                        <input type="text" name="username" class="form-control" id="brand" />
                    </div>

                    <div class="form-group">
                        <label for="company">Kullanıcı Şifresi :</label>
                        <input type="password" name="password"  class="form-control" id="brand" />
                    </div>

                    <div class="form-group">
                        <label for="company">Kullanıcı Tipi :</label>
                        <select name="type">
                            <?php foreach($types as $type) { ?>
                                <option value="<?=$type['id']?>"><?=$type['name']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="company">Adı :</label>
                        <input type="text" name="name" class="form-control" id="brand" />
                    </div>

                    <div class="form-group">
                        <label for="company">Soyadı :</label>
                        <input type="text" name="surname" class="form-control" id="brand" />
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