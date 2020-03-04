<?php

class VueFlag extends VueGenerique {

    function __construct() {
        parent::__construct("flag");
    }

    function loadPage($tab, $message) {
        $error = parent::getErrorDiv($message);
        
        $messages = $this->getMessages($tab);

        include $this->contenu;
    }

    function getMessages($tab) {
        if (empty($tab))
            return "<p class='text-center lead-min'>Sorry, everyone has been kind lately.<p>";

        $str = "";
        
        foreach($tab as $key=>$value) {
            $str .= '<div class="padding-top">'
                . '<p>'
                    . 'User : <a href="index.php?module=module_profile&u=">@' . $key . '</a>'
                . '</p>';

            for ($i = 0; $i < count($value); $i++) { 
                $str .= '<blockquote class="quote margin-s">' . $value[$i] . '</blockquote>';
            }
                    
            $str .= '<p>'
                        . '<label class="radio-inline padding-left-xxs"><input type="radio" name="' . $key . '" value="0">Ignore</label>'
                        . '<label class="radio-inline padding-left-xxs"><input type="radio" name="' . $key . '" value="1">5mn ban</label>'
                        . '<label class="radio-inline padding-left-xxs"><input type="radio" name="' . $key . '" value="2">1h ban</label>'
                        . '<label class="radio-inline padding-left-xxs"><input type="radio" name="' . $key . '" value="3">4h ban</label>'
                        . '<label class="radio-inline padding-left-xxs"><input type="radio" name="' . $key . '" value="4">12h ban</label>'
                        . '<label class="radio-inline padding-left-xxs"><input type="radio" name="' . $key . '" value="5">1 day ban</label>'
                        . '<label class="radio-inline padding-left-xxs"><input type="radio" name="' . $key . '" value="6">Permanent ban</label>' 
                    . '</p>'
                . '</div>';
        }

        return $str;
    }
}

?>
