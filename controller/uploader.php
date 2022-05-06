<?php


if ( 0 < $_FILES['file']['error'] ) {
    echo 'Error: ' . $_FILES['file']['error'] . '<br>';
}
else {

    $uniquesavename=time().uniqid(rand());
    $image = $uniquesavename. '.jpg';
    move_uploaded_file($_FILES['file']['tmp_name'], '../imagenes_rindepro/' .$image);
    echo $image;
}

?>
