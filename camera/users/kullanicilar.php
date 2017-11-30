<?php
$brands=$conn->query("SELECT u.*,t.name as tname from users u INNER JOIN type t ON t.id=u.type_id",PDO::FETCH_ASSOC);
?>
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i> Kullanıcılar
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>Kullanıcı Adı</th>
                                                <th>Kullanıcı Şifresi</th>
                                                <th>Kullanıcı Tipi</th>
                                                <th>Ad</th>
                                                <th>Soyad</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($brands as $brand){?>
                                           <tr>
                                                <td><?=$brand['username']?></td>
                                                <td><?=$brand['password']?></td>
                                                <td><?=$brand['tname']?></td>
                                                <td><?=$brand['name']?></td>
                                                <td><?=$brand['surname']?></td>
                                           </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                         
                            </div>
                            </div>
                    </div>
            </div>

