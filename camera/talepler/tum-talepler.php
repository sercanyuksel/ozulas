<?php
$sth=$conn->prepare("SELECT * from requests ORDER BY id DESC");
$sth->execute();
$requests=$sth->fetchAll();
$sth=$conn->prepare("SELECT * from users WHERE type_id=3 OR type_id=1");
$sth->execute();
$creators=$sth->fetchAll();
?>
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i> Talepler
                                </div>
                                <div class="card-body">
                                <div class="col-sm-12">
                                <label for="creator_filter">Talebi Açana Göre Filtrele :</label>
                                <select id="filter_creator" style="width:150px;">
                                <option value="all">Hepsi</option>
                                <?php foreach($creators as $creator){ ?>
                                    <option val="<?=$creator['name']?> <?=$creator['surname']?>"><?=$creator['name']?> <?=$creator['surname']?></option>
                                <?php } ?>
                                </select>
                                </div>
                             
                                <div class="col-sm-12" style="margin-bottom:5px;">
                                <label><font color="green" style="margin-right:15px;">Tarihe Göre Filrele:</font>Başlangıç :</label><input style="margin-left:5px;margin-right:5px;" type="date" id="s_date" /><label>Bitiş :</label><input style="margin-left:5px;" type="date" id="e_date" />
                                <button style="margin-left:5px;" id="filter_date" class="btn btn-info p-2">Filtrele</button>
                                <div style="float:right;"><label style= for="filter">Arama :</label><input style="margin-left:5px;width:200px;" type="text" id="table_filter" onkeyup="myFunction()" /></div>

                                </div>
                                    <table id="talepler" class="table table-bordered  table-sm">
                                        <thead>
                                            <tr>
                                                <th>Kayıt No</th>
                                                <th>Araç Kodu</th>
                                                <th>Talebi Açan</th>
                                                <th>Talebi Üstlenen</th>
                                                <th>Rapor Tarihi</th>
                                                <th>Durumu</th>
                                                <th>İşlemler</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
                                           <?php foreach($requests as $request){
                                            $oDate = new DateTime($request['created_at']);
                                            $create_date = $oDate->format("d-m-Y");
                                            $sth=$conn->prepare("SELECT * from users WHERE id=?");
                                            $sth->execute(array($request['creator_id']));   
                                            $creator=$sth->fetch(PDO::FETCH_ASSOC);
                                            $exist=false;
                                            if($request['handler_id']!=0)
                                            {
                                             $exist=true;
                                             $sth->execute(array($request['handler_id']));
                                             $handler=$sth->fetch(PDO::FETCH_ASSOC);                                                   
                                            }
                                            $sth=$conn->prepare("SELECT * from cars WHERE id=?");
                                            $sth->execute(array($request['car_id']));
                                            $car=$sth->fetch(PDO::FETCH_ASSOC);
                                            if($request['status']==0){
                                                $status='Açık';
                                                $color="badge-success";
                                            }
                                            if($request['status']==1){
                                                $status='İşlemde';
                                                $color="badge-warning";
                                            }
                                            if($request['status']==2){
                                                $status='Cevaplanmış';
                                                $color="badge-primary";
                                            }
                                            if($request['status']==3){
                                                $status='Kapalı';
                                                $color="";
                                            }
                                            ?>
                                                 <tr class="<?=$color?>">
                                                <td><a href="index.php?islem=talep-duzenle&id=<?=$request['id']?>">#<?=$request['talep_no']?></a></td>
                                                <td><?=$car['code']?></td>
                                                <td><?=$creator['name']?> <?=$creator['surname']?></td>
                                                <td><?php if($exist){echo $handler['name'].' '.$handler['surname'];} else{echo 'Henüz Talep Üstlenilmedi.';}?></td>
                                                <td><?=$create_date?></td>
                                                <td><?=$status?></td>
                                                <td class="text-center"><a href="index.php?islem=talep-duzenle&id=<?=$request['id']?>" title="incele"><i class="icon-magnifier"></i></a>
												 <a href="index.php?islem=talep-revize&id=<?=$request['id']?>" title="Düzenle"><i class="icon-wrench"></i></a>
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

            <script type="text/javascript" src="talepler/handle.js"></script>
