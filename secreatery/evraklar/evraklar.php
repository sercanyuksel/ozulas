<?php
$documents=$conn->query("SELECT * FROM documents",PDO::FETCH_ASSOC);
                                                                                             
?>
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i> Evraklar
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>Kayıt No</th>
                                                <th>Gönderilen Kişi/Kurum</th>
                                                <th>Tarih</th>
                                                <th>Konusu</th>
                                                <th>Dosya Numarası</th>
                                                <th>Dosya</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($documents as $document){?>
                                           <tr>
                                                <td><?=$document['id']?></td>
                                                <td><?=$document['sending']?></td>
                                                <td><?=$document['date']?></td>
                                                <td><?=$document['subject']?></td>
                                                <td><?=$document['file_no']?></td>
                                                <td><a href="C:/xampp/htdocs/uploads/<?=$document['file']?>" download><?=$document['file']?></a></td>
                                           </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                         
                            </div>
                            </div>
                    </div>
            </div>

