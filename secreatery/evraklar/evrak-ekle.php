<?php

if($_POST)

{  
  if($_FILES){

    $file_name = $_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
    $file_type = $_FILES['file']['type'];
    $file_size = $_FILES['file']['size'];
    $folder="C:/xampp/htdocs/uploads/";
    $id =$_POST['id'];
    $sending=$_POST['sending'];
    $date=$_POST['date'];
    $subject=$_POST['subject'];
    $file_no=$_POST['file_no'];
    /*if(empty($id) || empty($sending) || empty($date) || empty($file_id) || empty($subject) || empty($file_no))
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
    {*/
      
         
        move_uploaded_file($file_loc,$folder.$file_name);

        $sth=$conn->prepare("INSERT INTO documents (id,sending,date,subject,file,type,size,file_no) VALUES (?,?,?,?,?,?,?,?)");
        $sth=$sth->execute(array(
            $id,$sending,$date,$subject,$file_name ,$file_type,$file_size,$file_no
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
                <form method="POST" enctype="multipart/form-data">
                   
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

                <div class="form-group" >
                     <label for="company">Ek :</label>
                     <input type="file" name="file" class="form-control" enctype="multipart/form-data"/>
                     
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