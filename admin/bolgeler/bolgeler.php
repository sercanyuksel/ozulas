<?php
$areas=$conn->query("SELECT * from area",PDO::FETCH_ASSOC);
?>
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i> Bölgeler
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>Bölge Kodu</th>
                                                <th>Hat Kodu</th>
                                                <th>Hat Adı</th>
                                                <th>İşlemler</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($areas as $area){?>
                                           <tr>
                                                <td><a href="index.php?islem=bolge-duzenle&id=<?=$area['id']?>"><?=$area['code']?></a></td>
                                                <td><?=$area['name']?></td>
                                                <td><?=$area['name2']?></td>
                                                <td class="text-center"><a href="index.php?islem=bolge-duzenle&id=<?=$area['id']?>" title="incele"><i class="icon-magnifier"></i></a>| <a id="delete" href="index.php?islem=bolge-sil&id=<?=$area['id']?>" title="Sil"><i class="icon-close"></i></a></td>
                                           </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                         
                            </div>
                            </div>
                    </div>
            </div>

