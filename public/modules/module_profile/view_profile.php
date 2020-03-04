<?php

class VueProfile extends VueGenerique {

	public $info; 

    function __construct() {
        parent::__construct("profile");
        $this->info = array();
    }

	function setInfo($result) {
		$this->info = $result; 
	}

    function displayInfo($field) {
        if (empty($this->info[$field]))
            echo '<div class="font-italic text-muted">none</div>';
        else
            echo $this->info[$field]; 
    }

    function loadPage() {
        if ($this->info["pseudo"] == $_SESSION["pseudo"]) {
            $edit = '<p>'
                    . '<a href="index.php?module=module_password"><button class="btn btn-link">Change your password</button></a>'
                . '</p>'
                . '<hr>'
                . '<p class="text-center">'
                    . '<strong>ProTip!</strong> Updating your profile with your name, location, and a profile picture helps other users get to know you.'
                . '</p>'
                . '<p class="text-center">'
                    . '<a href="index.php?module=module_edit"><button class="btn btn-success btn-lg">Edit profile</button></a>'
                . '</p>';
        } else 
            $edit = NULL;

        include $this->contenu;
    }

    function loadAvatar() {
        $test = glob('uploads/avatar' . $this->info["idUser"] . '*');
        if(!empty($test))
            echo $test[0];
        else
            echo 'include/templates/images/user.png';
    }
}

?>
