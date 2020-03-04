<?php

class VueConversations extends VueGenerique {

	function __construct() {
        parent::__construct("conversations");
    }

    function loadPage($tab) {
        $conversations = $this->getConversations($tab);

        include $this->contenu;
    }

    function getConversations($tab) {   
        if (empty($tab))
        	return "<div class='lead-min'>Sorry, you don't belong to any chatroom<div>";

        $str = "";
        
        foreach($tab as $key=>$value) {
            $str .= '<a class="nav-link lead-min" href="index.php?module=module_chat&key=' . $key . '">' . $value . '</a>';
        }

        return $str;
    }
}

?>
