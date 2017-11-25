<?php
$brands=$conn->query("SELECT * from brand",PDO::FETCH_ASSOC);
?>
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i> Markalar
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>Marka Adı</th>
                                                <th>İşlemler</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($brands as $brand){?>
                                           <tr>
                                                <td><a href="index.php?islem=marka-duzenle&id=<?=$brand['id']?>"><?=$brand['brand']?></a></td>
                                                <td class="text-center"><a href="index.php?islem=marka-duzenle&id=<?=$brand['id']?>" title="incele"><i class="icon-magnifier"></i></a>| <a id="delete" href="index.php?islem=marka-sil&id=<?=$brand['id']?>" title="Sil"><i class="icon-close"></i></a></td>
                                           </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                         
                            </div>
                            </div>
                    </div>
            </div>

