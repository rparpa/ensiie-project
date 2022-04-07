<?php
var_dump($_POST);
$imagesLocation = '../images/items/';
$tmpName = $_FILES['file']['tmp_name'];
$name = $_FILES['file']['name'];
$size = $_FILES['file']['size'];
$error = $_FILES['file']['error'];
$tabExtension = explode('.', $name);
$extension = strtolower(end($tabExtension));
//Tableau des extensions que l'on accepte
$extensions = ['jpg', 'png', 'jpeg', 'gif'];
if(in_array($extension, $extensions)){
    $uniqueName = uniqid('', true);
    //uniqid génère quelque chose comme ca : 5f586bf96dcd38.73540086
    $file = $uniqueName.".".$extension;
    move_uploaded_file($tmpName, $imagesLocation.$file);
}
else{
    echo "Mauvaise extension";
}
?>