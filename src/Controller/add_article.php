<?php

file_put_contents('php://stderr', print_r($_POST['article'], TRUE));
  
$article = $_POST['article'];
file_put_contents('php://stderr', print_r($article['title'], TRUE));
 
foreach($article as $k => $v){
    file_put_contents('php://stderr', print_r($k.": ".$v."\n", TRUE));
}

echo json_encode(array('status' => "success"));
?>