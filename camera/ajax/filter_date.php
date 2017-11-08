<?php
require('../include/ayar.php');
if($_GET){
    $s_date=$_GET['s_date'];
    $e_date=$_GET['e_date'];
    $s_date = new DateTime($s_date);
    $s_date = $s_date->format("Y-m-d H:i:s");   
    $e_date = new DateTime($e_date);
    $e_date = $e_date->format("Y-m-d H:i:s");
    
    $sth=$conn->prepare("SELECT * from requests WHERE (created_at BETWEEN ? AND ?) AND status!=3 AND status=!2 ORDER BY id DESC " );
    $sth->execute(array(
        $s_date,$e_date
    ));
    $requests=$sth->fetchAll();
    $sth=$conn->prepare("SELECT * from users WHERE type_id=3 OR type_id=1");
    $sth->execute();
    $creators=$sth->fetchAll();
    ?>
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
            <td class="text-center"><a href="index.php?islem=talep-duzenle&id=<?=$request['id']?>" title="incele"><i class="icon-magnifier"></i></a></td>
            </tr>
       <?php } ?>
    
      
<?php    
}
?>