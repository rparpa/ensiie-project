<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Access
{
    private $CI;

    function __construct()
    {
        // Assign by reference with "&" so we don't create a copy
        $this->CI = &get_instance();
    }

    public function has_access($module_slug)
    {
        $admin_id = $this->CI->auth->check_is_admin();
        return $this->CI->admin_x_module_model->has_access($admin_id, $module_slug);
    }

    public function check_has_access($module_code)
    {
        if (!$this->has_access($module_code))
            show_error("Vous n'avez pas les droits nécessaires pour gérer cette partie");
    }

    public function check_access_commande($etape)
    {
        if ($etape > $this->CI->session->userdata('commande_etape'))
        {
            $this->CI->session->set_userdata('commande_etape', 1);
            $this->CI->session->set_flashdata('error_message', 'Veuillez suivre les étapes du processus de commande dans le bon ordre !');
            redirect('panier');
        }
    }

    public function grant_access_commande($etape)
    {
        $this->CI->session->set_userdata('commande_etape', $etape);
    }

}