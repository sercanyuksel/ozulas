<?php
$car_troubles=$conn->query("SELECT c.*,t.trouble as ctrouble from car_troubles c INNER JOIN troubles t ON c.trouble_id=t.id",PDO::FETCH_ASSOC);



?>
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i> Arızalar
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>Arıza No</th>
                                                <th>Tarih</th>
                                                <th>Araç Kodu</th>
                                                <th>İhbar Saati</th>
                                                <th>Arıza Nedeni</th>
                                                <th>İşlemler</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        if($car_troubles->rowCount()>0){
                                        foreach($car_troubles as $car_trouble){ 
                                            $dt=new DateTime($car_trouble['trouble_date']);
                                            $created_at = $dt->format('d-m-Y H:i:s');
                                            ?>
                                           <tr>
                                                <td><a href="index.php?islem=ariza-duzenle&id=<?=$car_trouble['id']?>"><?=$car_trouble['id']?></a></td>
                                                <td><?=$created_at?></td>
                                                <td><?=$car_trouble['driver']?></td> 
                                                <td><?=$car_trouble['ihbar_saati']?></td>
                                                <td><?=$car_trouble['ctrouble']?></td>  
                                                <td class="text-center"><a  href="index.php?islem=ariza-duzenle&id=<?=$car_trouble['id']?>" title="incele"><i class="icon-magnifier"></i></a></td>
                                           </tr>
                                        <?php }}else{
                                           echo' Kayıt Bulunamadı.';
                                        } ?>
                                        </tbody>
                                    </table>
                                   
                                </div>
                         
                            </div>
                            </div>
                    </div>
            </div>

 

            <script src="arizalar/handle.js"></script>