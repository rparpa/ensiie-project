<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilisateur extends CI_Controller {

	public function index()
	{
        echo '<pre>';
        print_r($this->user->getAllUser());
        echo '</pre>';
	}
}
