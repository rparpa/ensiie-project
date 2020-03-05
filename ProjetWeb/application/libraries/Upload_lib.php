<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Upload_lib
{
    private $CI;

    function __construct()
    {
        // Assign by reference with "&" so we don't create a copy
        $this->CI = &get_instance();
    }

    public function file_upload($params = array())
    {
        extract($params);

        if ($_FILES[$input_name]['name'] != "")
        {

            if (!is_dir($upload_path))
                mkdir($upload_path);


            $path = $_FILES[$input_name]['name'];
            //$ext  = pathinfo($path, PATHINFO_EXTENSION);

            if (!isset($file_name))
            {
                $this->CI->load->helper("text");
                $file_name = convert_accented_characters(pathinfo($path, PATHINFO_FILENAME));
            }

            $config['file_name']     = url_title($file_name, "_", true);
            $config['upload_path']   = $upload_path;
            $config['allowed_types'] = $allowed_types;

            $this->CI->load->library('upload', $config);

            if (!$this->CI->upload->do_upload($input_name))
            {
                $this->CI->session->set_flashdata('error_upload', $this->CI->upload->display_errors('<div class="alert alert-danger">', '</div>'));
            }
            else
            {
                return $this->CI->upload->data();
            }
        }

        return false;
    }

    public function file_upload_multiple($params = array())
    {
        extract($params);

        $success_upload = array();
        $error_upload   = array();

        if (!is_dir($upload_path))
            mkdir($upload_path);

        $files = $_FILES;
        $cpt   = count($_FILES[$input_name]['name']);
        for ($i = 0; $i < $cpt; $i++)
        {
            $_FILES['tmp']['name']     = $files[$input_name]['name'][$i];
            $_FILES['tmp']['type']     = $files[$input_name]['type'][$i];
            $_FILES['tmp']['tmp_name'] = $files[$input_name]['tmp_name'][$i];
            $_FILES['tmp']['error']    = $files[$input_name]['error'][$i];
            $_FILES['tmp']['size']     = $files[$input_name]['size'][$i];

            $this->CI->load->helper("text");
            $path      = $_FILES['tmp']['name'];
            $file_name = convert_accented_characters(pathinfo($path, PATHINFO_FILENAME));

            $config['file_name']     = url_title($file_name, "_", true);
            $config['upload_path']   = $upload_path;
            $config['allowed_types'] = $allowed_types;

            $this->CI->load->library('upload', $config);

            if (!$this->CI->upload->do_upload('tmp'))
            {
                $error_upload[] = $this->CI->upload->display_errors();
            }
            else
            {
                $success_upload[] = $this->CI->upload->data();
            }
        }

        if (!empty($error_upload))
            $this->CI->session->set_flashdata('errors_upload', implode('<br>', $error_upload));

        return $success_upload;
    }

}