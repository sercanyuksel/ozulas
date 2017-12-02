<?php
$sth=$conn->prepare("SELECT * from accidents ORDER BY accidents_id ASC");
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
                                <label for="creator_filter">Talebi Açana Göre Filtrele :</label>
                                <select id="filter_creator" style="width:150px;">
                                <option value="-1" disabled selected="selected">Kaza Durumu Seçin</option>
                                <option value="all">Hepsi</option>
                                <option value="Yaralamalı">Yaralamalı</option>
                                <option value="Maddi Hasarlı">Maddi Hasarlı</option> 
                                <option value="Ölümlü">Ölümlü</option>  
                                </select>
                                <div style="float:right;"><label style= for="filter">Arama :</label><input style="margin-left:5px;width:200px;" type="text" id="table_filter" onkeyup="myFunction()" /></div>
                                </div>
                             
                                    <table id="kazalar" class="table table-bordered  table-sm">
                                        <thead>
                                            <tr>
                                                <td>Kaza No</td>
                                                <td>Araç Kodu</td>
                                                <td>Kaza Yapılan Araç</td>
                                                <td>Kaza Yeri</td>
                                                <td>Kaza Tarihi</td>
                                                <td>Talebin Açıldığı Tarih</td>
                                                <td>Kaza Durumu</td>
                                                <td>İşlemler</td>
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
                                            if($accident['kaza_durumu']=='Yaralamalı'){
                                                $status='Yaralamalı';
                                                $color="badge-success";
                                            }
                                            if($accident['kaza_durumu']=='Ölümlü'){
                                                $status='Ölümlü';
                                                $color="badge-warning";
                                            }
                                            if($accident['kaza_durumu']=='Maddi Hasarlı'){
                                                $status='Maddi Hasarlı';
                                                $color="badge-primary";
                                            }
                                            ?>
                                                 <tr class="<?=$color?>">
                                                <td><?=$accident_id?></td>
                                                <td><?=$car['code']?></td>
                                                <td><?=$kaza_arac?></td>
                                                <td><?=$kaza_yeri?></td>
                                                <td><?=$creator['name']?> <?=$creator['surname']?></td>
                                                <td><?=$create_date?></td>
                                                <td><?=$status?></td>
                                                <td class="text-center"><a href="index.php?islem=kaza-duzenle&id=<?=$accident['accidents_id']?>" title="incele"><i class="icon-magnifier"></i></a>
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