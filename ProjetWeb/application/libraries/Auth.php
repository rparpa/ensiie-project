<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth
{
    protected $CI;

    function __construct()
    {
        // Assign by reference with "&" so we don't create a copy
        $this->CI = &get_instance();
    }

    public function is_user()
    {
        if (is_numeric($this->CI->session->userdata('user_id')))
            return true;
        return false;
    }


    public function check_is_user($is_admin=false)
    {
        if (!$this->is_user())
        {
            $this->CI->session->set_userdata('from_user', current_url());
            redirect('user/connexion', 'refresh');
            return;
        }
        else
        {
            $user_id = $this->CI->session->userdata('user_id');
            $this->CI->load->model("user_model");
            $user    = $this->CI->user_model->get($user_id);
            if (!$user)
                redirect("user/deconnexion");
            /*
            * Configuration de la variable is_admin
            */
            if ($user->is_admin)
                $this->CI->session->set_userdata('is_admin', 1);
            else
                $this->CI->session->set_userdata('is_admin',false);

            /*
            * Configuration de la variable is_organisateur
            */
            if ($user->is_organisateur)
                $this->CI->session->set_userdata('is_organisateur', 1);
            else
                $this->CI->session->set_userdata('is_organisateur',0);

            return $this->CI->session->userdata('user_id');
        }
    }

    ############################################################################

    public function is_admin()
    {
        if (is_numeric($this->CI->session->userdata('is_admin')))
            return true;
        return false;
    }

    public function is_orga()
    {
        if ($this->CI->session->userdata('is_organisateur'))
            return true;
        return false;
    }

    public function check_is_admin()
    {
        if (!$this->is_admin())
        {
            $this->CI->session->set_userdata('from_admin', current_url());
            redirect('back/admin/connexion', 'refresh');
            return;
        }
        else
        {
            $admin_id = $this->CI->session->userdata('admin_id');
            $this->CI->load->model("admin_model");
            $admin    = $this->CI->admin_model->get($admin_id);
            if (!$admin)
                redirect("back/admin/deconnexion");

            return $this->CI->session->userdata('admin_id');
        }
    }

    ############################################################################

}
