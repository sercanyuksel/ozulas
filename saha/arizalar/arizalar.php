<?php
$ses_id=$_SESSION['user_id'];
$car_troubles=$conn->query("SELECT c.*,t.trouble as ctrouble,car.code as car_code from car_troubles c INNER JOIN troubles t ON c.trouble_id=t.id INNER JOIN cars car ON car.id=c.car_id WHERE c.creator_id=$ses_id ",PDO::FETCH_ASSOC);
?>
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i> Arızalar
                                </div>
                                <div class="card-body">
                                <div style="float:right;"><label style= for="filter">Arama :</label><input style="margin-left:5px;width:200px;" type="text" id="table_filter" onkeyup="myFunction()" /></div>
                                    <table  id="talepler" class="table table-bordered  table-sm">
                                        <thead>
                                            <tr>
                                                <th>Arıza No</th>
                                                <th>Tarih</th>
                                                <th>Araç Kodu</th>
                                                <th>Sürücü</th>
                                                <th>Arızayı Üstlenen</th>
                                                <th>Arıza Nedeni</th>
                                                <th>Durumu</th>
                                                <th>İşlemler</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        if($car_troubles->rowCount()>0){
                                        foreach($car_troubles as $car_trouble){ 
                                            $dt=new DateTime($car_trouble['trouble_date']);
                                            $created_at = $dt->format('d-m-Y H:i:s');
                                            if($car_trouble['status']==0){
                                                $status='Açık';
                                                $color="badge-success";
                                            }
                                            if($car_trouble['status']==1){
                                                $status='İşlemde';
                                                $color="badge-warning";
                                            }
                                            if($car_trouble['status']==2){
                                                $status='Cevaplanmış';
                                                $color="badge-primary";
                                            }
                                            if($car_trouble['handler_id']!=0){
                                                $sth=$conn->prepare("SELECT name,surname from users WHERE id=?");
                                                $sth->execute(array(
                                                    $car_trouble['handler_id']
                                                ));
                                                $handler=$sth->fetch(PDO::FETCH_ASSOC);
                                            }
                                            else{
                                                $handler['name']="Henüz";
                                                $handler['surname']="Üstlenilmedi";
                                            }
                                            ?>
                                           <tr class="<?=$color?>">
                                                <td><a href="index.php?islem=ariza-duzenle&id=<?=$car_trouble['id']?>"><?=$car_trouble['id']?></a></td>
                                                <td><?=$created_at?></td>
                                                <td><?=$car_trouble['car_code']?></td> 
                                                <td><?=$car_trouble['driver']?></td> 
                                                <td><?=$handler['name']?> <?=$handler['surname']?></td>
                                                <td><?=$car_trouble['ctrouble']?></td>
                                                <td><?=$status?></td>

                                                <td class="text-center"><a  href="index.php?islem=ariza-duzenle&id=<?=$car_trouble['id']?>" title="incele"><i class="icon-magnifier"></i></a></td>
                                           </tr>
                                        <?php }}else{
                                           echo' Kayıt Bulunamadı.';
                                        } ?>
                                        </tbody>
                                    </table>
                                    <div class="col-12 text-right">
                            <input type="button"class="btn btn-primary px-4" value="Geri" onclick="history.back(-1)" />

                        </div>
                                </div>
                         
                            </div>
                            </div>
                    </div>
            </div>

 

            <script src="arizalar/handle.js"></script>