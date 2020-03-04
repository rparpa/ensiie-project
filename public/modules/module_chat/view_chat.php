<?php

class VueChat extends VueGenerique {
    
    function __construct() {
        parent::__construct("chat");
    }

    function loadPage($tab, $roomName) {
        $conversations = $this->getConversations($tab);

        include $this->contenu;
    }

    function getConversations($tab) {
        $str = "";

        foreach($tab as $key=>$value) {
            $str .= '<a class="nav-link" href="index.php?module=module_chat&key=' . $key . '">' . $value . '</a>';
        }

        return $str;
    }
}

?>
