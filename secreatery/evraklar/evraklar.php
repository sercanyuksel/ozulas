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
                                                <th>Dosya</th>
                                                <th>Konusu</th>
                                                <th>Dosya Numarası</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($documents as $document){?>
                                           <tr>
                                                <td><?=$document['id']?></td>
                                                <td><?=$document['sending']?></td>
                                                <td><?=$document['date']?></td>
                                                <td><?=$document['addition']?></td>
                                                <td><?=$document['subject']?></td>
                                                <td><?=$document['file_no']?></td>
                        
                                           </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                    <nav>
                                        <ul class="pagination">
                                            <li class="page-item"><a class="page-link" href="#">Prev</a>
                                            </li>
                                            <li class="page-item active">
                                                <a class="page-link" href="#">1</a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#">2</a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#">3</a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#">4</a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#">Next</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                         
                            </div>
                            </div>
                    </div>
            </div>

