<?php
$sth=$conn->prepare("SELECT * from accidents ORDER BY accidents_id DESC");
$sth->execute();
$accidents=$sth->fetchAll();
$sth=$conn->prepare("SELECT * from users WHERE type_id=3 OR type_id=1");
$sth->execute();
$creators=$sth->fetchAll();
?>
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i> Kazalar
                                </div>
                                <div class="card-body">
                                <div class="col-sm-12">
<<<<<<< HEAD
                                <label for="creator_filter">Kaza Durumuna Göre Filtrele :</label>
=======

>>>>>>> 2e539efdb85cb2aebe50e72b35fe4769efac37ba
                                <select id="filter_creator" style="width:150px;">
                                <option value="-1" disabled selected="selected">Kaza Durumu Seçin</option>
                                <option value="all">Hepsi</option>
                                <option value="Yara">Yaralamalı</option>
                                <option value="Mad">Maddi Hasarlı</option> 
                                <option value="Ol">Ölümlü</option>  
                                </select>

                                <div style="float:right;"><label style= for="filter">Arama :</label><input style="margin-left:5px;width:200px;" type="text" id="table_filter" onkeyup="myFunction()" /></div>
                                </div>
                             
                                    <table id="kazalar" class="table table-bordered  table-sm">
                                        <thead>
                                            <tr>
<<<<<<< HEAD
                                                <td>Kaza No</td>
                                                <td>Kaydı Açan</td>
                                                <td>Araç Kodu</td>
                                                <td>Kaza Yapılan Araç</td>
                                                <td>Kaza Yeri</td>
                                                <td>Sürücü Adı</td>
                                                <td>Kaza Tarihi</td>                                               
                                                <td>Kaza Durumu</td>
                                                <td>Fotoğraf</td>
                                                <td>İşlemler</td>
=======
                                                <th>Kaza No</th>
                                                <th>Araç Kodu</th>
                                                <th>Kaza Yapılan Araç</th>
                                                <th>Kaza Yeri</th>
                                                <th>Kaza Tarihi</th>
                                                <th>Talebin Açıldığı Tarih</th>
                                                <th>Kaza Durumu</th>
                                                <th>İşlemler</th>
>>>>>>> 2e539efdb85cb2aebe50e72b35fe4769efac37ba
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
                                           <?php foreach($accidents as $accident){
                                            $accident_id = $accident['accidents_id'];
                                            $kaza_arac = $accident['kaza_arac']; 
                                            $kaza_yeri = $accident['kaza_yeri'];    
                                            $oDate = new DateTime($accident['tarih']);
                                            $create_date = $oDate->format("d-m-Y");
                                            $sth=$conn->prepare("SELECT * from users WHERE id=?");
                                            $sth->execute(array($accident['creator_id']));   
                                            $creator=$sth->fetch(PDO::FETCH_ASSOC);
                                            $exist=false;
                                            $sth=$conn->prepare("SELECT * from cars WHERE id=?");
                                            $sth->execute(array($accident['car_id']));
                                            $car=$sth->fetch(PDO::FETCH_ASSOC);
                                            if($accident['kaza_durumu']=='Yara'){
                                                $status='Yaralamalı';
                                                $color="badge-success";
                                            }
                                            if($accident['kaza_durumu']=='Ol'){
                                                $status='Ölümlü';
                                                $color="badge-warning";
                                            }
                                            if($accident['kaza_durumu']=='Mad'){
                                                $status='Maddi Hasarlı';
                                                $color="badge-primary";
                                            }
                                            ?>
                                                <tr class="<?=$color?>">                                    
                                                <td><?=$accident_id?></td>
                                                <td><?=$creator['name']?> <?=$creator['surname']?></td>
                                                <td><?=$car['code']?></td>
                                                <td><?=$kaza_arac?></td>
                                                <td><?=$kaza_yeri?></td>
                                                <td><?=$accident['driver_id']?></td>
                                                <td><?=$create_date?></td>
                                                <td><?=$status?></td>
                                                <td><a href="../../uploads/<?=$accident['file_name']?>" download>Kaza Fotoğrafı</a></td>
                                                <td class="text-center">
                                                <a onclick="return confirmation()" href="index.php?islem=kaza-sil&accidents_id=<?=$accident['accidents_id']?>" title="Sil"><i class="icon-trash"></i></a>
                                                </td>
                                                </tr>
                                           <?php } ?>
                                        </tbody>
                                    </table>
                                   
                                </div>
                         
                            </div>
                            </div>
                    </div>
            </div>

            <script type="text/javascript" src="kazalar/handle.js"></script>
