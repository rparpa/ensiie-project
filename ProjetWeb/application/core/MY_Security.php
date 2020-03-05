<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Security extends CI_Security
{

    public function __construct()
    {
        parent::__construct();
    }

    public function csrf_show_error()
    {
        if (strpos($_SERVER['REQUEST_URI'], 'user/login') !== false)
            header('Location: /user/login_csrf_error', TRUE, 302);
        else
            header('Location: '.$_SERVER['REQUEST_URI'], TRUE, 302);

        exit(1);
    }

}