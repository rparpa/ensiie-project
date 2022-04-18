<?php

use Db\Connection;
use Db\SwapManager;
use models\Swap;

$trocManager = new SwapManager(Connection::get());

if (isset($_GET['createTroc'])) {
    $troc = new Swap(1, date('d-m-Y'),'01-01-9999', false);

    $trocManager->insertTroc($troc);
}


if (isset($_GET['refuseTroc'])) {
    $troc = new Swap(1, date('d-m-Y'),'01-01-9999', false);

    $troc->setEndDate(date('d-m-Y'));
    $troc->setIsDone(true);
    $troc->setStatus(false);

    $trocManager->refuseTroc($troc);
}

if (isset($_GET['acceptTroc'])) {
    $troc = new Swap(1, date('d-m-Y'),'01-01-9999', false);


    $troc->setEndDate(date('d-m-Y'));
    $troc->setIsDone(true);
    $troc->setStatus(true);

    $trocManager->acceptTroc($troc);
}

echo '<form method="GET"> 
        <input type="submit" name="createTroc"
                value="Create Swap"/> 
        
        <input type="submit" name="refuseTroc"
                value="Refuse Swap"/> 
                
        <input type="submit" name="acceptTroc"
                value="Accept Swap"/> 
    </form>';

