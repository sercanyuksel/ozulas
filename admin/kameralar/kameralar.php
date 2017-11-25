<?php
$types=$conn->query("SELECT * from camera_types",PDO::FETCH_ASSOC);
?>
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i> Kamera Tipleri
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>Kamera Tipi</th>
                                                <th>İşlemler</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($types as $type){?>
                                           <tr>
                                                <td><a href="index.php?islem=kamera-duzenle&id=<?=$type['id']?>"><?=$type['camera']?></a></td>
                                                <td class="text-center"><a href="index.php?islem=kamera-duzenle&id=<?=$type['id']?>" title="incele"><i class="icon-magnifier"></i></a>| <a id="delete" href="index.php?islem=kamera-sil&id=<?=$type['id']?>" title="Sil"><i class="icon-close"></i></a></td>
                                           </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                         
                            </div>
                            </div>
                    </div>
            </div>

