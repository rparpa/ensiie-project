<?php

use Db\Connection;
use Db\TrocManager;
use models\Troc;

$trocManager = new TrocManager(Connection::get());

if (isset($_GET['createTroc'])) {
    $troc = new Troc(1, date('d-m-Y'),'01-01-9999', false);

    $trocManager->insertTroc($troc);
}


if (isset($_GET['refuseTroc'])) {
    $troc = new Troc(1, date('d-m-Y'),'01-01-9999', false);

    $troc->setEndDate(date('d-m-Y'));
    $troc->setIsDone(true);
    $troc->setIsAccepted(false);

    $trocManager->refuseTroc($troc);
}

if (isset($_GET['acceptTroc'])) {
    $troc = new Troc(1, date('d-m-Y'),'01-01-9999', false);


    $troc->setEndDate(date('d-m-Y'));
    $troc->setIsDone(true);
    $troc->setIsAccepted(true);

    $trocManager->acceptTroc($troc);
}

echo '<form method="GET"> 
        <input type="submit" name="createTroc"
                value="Create Troc"/> 
        
        <input type="submit" name="refuseTroc"
                value="Refuse Troc"/> 
                
        <input type="submit" name="acceptTroc"
                value="Accept Troc"/> 
    </form>';

