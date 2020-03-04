<?php

class ModeleStats extends ModeleGenerique {

    function getStats() {
        $ret = array(); 
        $req = $this->connexion->prepare("SELECT COUNT(*) from Message") ;
        $req->execute(); 
        
        $result = $req->fetch(PDO::FETCH_ASSOC) ;
        $ret['nbMsg'] =$result['COUNT(*)'];

        $req = $this->connexion->prepare("SELECT COUNT(*) from Conversation") ;
        $req->execute(); 
        
        $result = $req->fetch(PDO::FETCH_ASSOC) ;
        $ret['nbConv'] =$result['COUNT(*)'];

        $req = $this->connexion->prepare("SELECT COUNT(*) from Utilisateur") ;
        $req->execute(); 
        
        $result = $req->fetch(PDO::FETCH_ASSOC) ;
        $ret['nbRegister'] =$result['COUNT(*)'];

        $req = $this->connexion->prepare("SELECT COUNT(*) FROM `Message` where EXTRACT(MONTH FROM CURRENT_TIMESTAMP) = EXTRACT(MONTH FROM dateEmis)") ;
        $req->execute(); 
        
        $result = $req->fetch(PDO::FETCH_ASSOC) ;
        $ret['nbMsgMonth'] =$result['COUNT(*)'];


        $req = $this->connexion->prepare("SELECT COUNT(*) FROM `Conversation` where EXTRACT(MONTH FROM CURRENT_TIMESTAMP) = EXTRACT(MONTH FROM dateCreation)") ;
        $req->execute(); 
        
        $result = $req->fetch(PDO::FETCH_ASSOC) ;
        $ret['nbConvMonth'] =$result['COUNT(*)'];

        return $ret;
    }
} 

?>

