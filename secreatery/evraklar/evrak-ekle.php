<?php

if($_POST)
{
    $id =$_POST['id'];
    $sending=$_POST['sending'];
    $date=$_POST['date'];
    $addition=$_POST['addition'];
    $subject=$_POST['subject'];
    $file_no=$_POST['file_no'];
    if(empty($id) || empty($sending) || empty($date) || empty($addition) || empty($subject) || empty($file_no))
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
        $sth=$conn->prepare("INSERT INTO documents (id,sending,date,addition,subject,file_no) VALUES (?,?,?,?,?,?)");
        $sth=$sth->execute(array(
            $id,$sending,$date,$addition,$subject,$file_no
        ));
      
        if($sth)
        {
            echo '
            
              <div class="row justify-content-center">
              <div class="col-md-12">
              <div class="alert alert-success" style="padding:60px;">
              <h1><i class="fa fa-check-circle-o"></i> Evrak Ekleme Başarılı .</h1><br/>
              Yönlendiriliyorsunuz...
              </div>
              </div>
              </div>
                  
              ';
           header("Refresh:2; url=index.php?islem=evrak-ekle");
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
           header("Refresh:2; url=index.php?islem=evrak-ekle");
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
                    <strong>Evrak Ekle</strong>                
                </div>
                <div class="card-body">
                <form method="POST">
                   
                <div class="form-group">
                    <label for="company">Kayıt No :</label>
                    <input type="text" name="id" class="form-control" id="id">
                </div>

                <div class="form-group">
                    <label for="company">Gönderilen Kişi/Kurum :</label>
                    <input type="text" name="sending" class="form-control" id="sending" placeholder="Gönderilen Kişi/Kurum Giriniz.">
                </div>

                <div class="form-group">
                    <label for="company">Tarihi :</label>
                    <input type="date" name="date" class="form-control" id="date" placeholder="Tarih Giriniz.">
                </div>

                <div class="form-group">
                    <label for="company">Dosya :</label>
                    <input type="text" name="addition" class="form-control" id="addition" placeholder="Dosya Seçiniz.">
                </div>        

                <div class="form-group">
                    <label for="company">Konusu :</label>
                    <input type="text" name="subject" class="form-control" id="subject" placeholder="Konusunu Giriniz.">
                </div>

                <div class="form-group">
                    <label for="company">Dosya Numarası :</label>
                    <input type="text" name="file_no" class="form-control" id="file_no" placeholder="Muhafaza Edildiği Dosya Numarasını Giriniz.">
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