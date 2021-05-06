<?php

class Test{
    public int $success;
}
$obj = new Test;
$obj->success = 1;
// $obj->value = "Vrai";

$value = "Test";
echo json_encode($obj);
// echo json_encode($value);
?>