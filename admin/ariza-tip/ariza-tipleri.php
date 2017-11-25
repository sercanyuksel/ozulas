<?php
$trouble_types=$conn->query("SELECT * from troubles",PDO::FETCH_ASSOC);
?>
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i> Arıza Tipleri
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>Arıza Tipi</th>
                                                <th>İşlemler</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($trouble_types as $trouble){?>
                                           <tr>
                                                <td><a href="index.php?islem=ariza-tip-duzenle&id=<?=$trouble['id']?>"><?=$trouble['trouble']?></a></td>
                                                <td class="text-center"><a href="index.php?islem=ariza-tip-duzenle&id=<?=$trouble['id']?>" title="incele"><i class="icon-magnifier"></i></a>| <a id="delete" href="index.php?islem=ariza-tip-sil&id=<?=$trouble['id']?>" title="Sil"><i class="icon-close"></i></a></td>
                                           </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                         
                            </div>
                            </div>
                    </div>
            </div>

