<?php
require('../include/ayar.php');
if($_GET){
    $car_id=$_GET['id'];
    $sth=$conn->prepare("SELECT c.*,ca.camera as type,ca.id as caid  from car_camera c INNER JOIN camera_types ca  ON c.type_id=ca.id WHERE c.car_id=? ");
    $sth->execute(array(
        $car_id
    ));
    $car_cameras=$sth->fetchAll();
   
        echo '
        <div class="form-group" id="dynamicInput">
        <label for="camera">Kamera :</label>
        <select class="form-control" name="camera[]" multiple id="camera">';
        foreach($car_cameras as $value)
        {
            if($value['status']==0){
         echo '<option value="'.$value['caid'].'" >'.$value['type'].'</option>';
            }
            else echo '<option class="broken" value="'.$value['caid'].'" disabled>'.$value['type'].' <font style="color:red;">Arızalı</font></option>';
        }
        echo '                     
        </select>
        </div>

            ';
    
}
?>