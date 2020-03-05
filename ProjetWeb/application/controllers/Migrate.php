<?php

class Migrate extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('migration');
        if (ENVIRONMENT != "development")
            die();
    }

    public function current()
    {

        if ($this->migration->current() === FALSE)
        {
            show_error($this->migration->error_string());
        }
    }

    public function latest()
    {
        if ($this->migration->latest() === FALSE)
        {
            show_error($this->migration->error_string());
        }
    }

    public function reset($version = null)
    {
        if ($version != null)
            $this->migration->version($version);
        else
            exit("Indiquez le numéro de version");
    }

}