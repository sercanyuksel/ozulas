<?php
$cars=$conn->query("SELECT c.*,a.code as acode from cars c INNER JOIN area a ON c.area_id=a.id",PDO::FETCH_ASSOC);
?>
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i> Araçlar
                                </div>
                                <div class="card-body">
                                <label for="filter">Arama :</label><input style="margin-left:5px;width:200px;" type="text" id="table_filter" onkeyup="myFunction()" />

                                    <table id="araclar" class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>Araç Kodu</th>
                                                <th>Bölge Adı</th>
                                                <th>İşlemler</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($cars as $car){?>
                                           <tr>
                                                <td><a href="index.php?islem=bolge-duzenle&id=<?=$car['id']?>"><?=$car['code']?></a></td>
                                                <td><?=$car['acode']?></td>
                                                <td class="text-center"><a href="index.php?islem=arac-duzenle&id=<?=$car['id']?>" title="incele"><i class="icon-magnifier"></i></a>| <a id="add" title="Araca Kamera Ekle" href="index.php?islem=arac-kamera&id=<?=$car['id']?>&count=1"><i class="icon-plus"></i></a>
                                                | <a id="vew" title="Araç Kamera Durumu" href="index.php?islem=kamera-durum&id=<?=$car['id']?>"><i class="icon-camera"></i></a>
                                            </td>
                                           </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                    <div class="row">
         <div class="col-12 text-right">
                            <input type="button"class="btn btn-primary px-4" value="Geri" onclick="history.back(-1)" />
                        </div>
                                </div>

                    </div>
                            </div>
                            </div>
                    </div>
            </div>

            <script type="text/javascript" src="araclar/handle.js"></script>
