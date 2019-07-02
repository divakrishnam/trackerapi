<?php

require_once('connection.php');

// $nama = 'Kiernan';
// $latitude = '0.0';
// $longtitude = '0.0';
// $waktu = '2019-07-07';

$nama = $_POST['nama'];
$latitude = $_POST['latitude'];
$longtitude = $_POST['longtitude'];
$waktu = $_POST['waktu'];

if(!$nama || !$latitude || !$longtitude || !$waktu){
    echo json_encode(array('value'=>0, 'message'=>'Required field is empty.'));
}else{
    
    if(!empty($_FILES["image"]["name"])){
        $nama = 'Kiernan';
        $latitude = '0.0';
        $longtitude = '0.0';
        $waktu = '2019-07-07';
        $gambar = "pictures/".basename($_FILES['image']['name']);
        if(move_uploaded_file($_FILES['image']['tmp_name'], $gambar)) {
            $query = mysqli_query($CON, "INSERT INTO tracker (nama, latitude, longtitude, waktu, gambar) VALUES ('$nama','$latitude','$longtitude','$waktu', '$gambar')");
            echo json_encode(array('value'=>1, 'message'=>'Data successfully added.'));
        }else{
            echo json_encode(array('value'=>2, 'message'=>'Picture failed to add.'));
        }
    }else{
        $query = mysqli_query($CON, "INSERT INTO tracker (nama, latitude, longtitude, waktu) VALUES ('$nama','$latitude','$longtitude','$waktu')");
        if($query){
            echo json_encode(array('value'=>1, 'message'=>'Data successfully added.'));
        }else{
            echo json_encode(array('value'=>0, 'message'=>'Data failed to add.'));
        }
    }
}

?>

<!-- <form action="create.php" method="post" enctype="multipart/form-data">
    Select Image File to Upload:
    <input type="file" name="image">
    <input type="submit" name="submit" value="Upload">
</form> -->