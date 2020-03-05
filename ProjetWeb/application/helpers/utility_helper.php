<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function pre($array = array(), $titre = "")
{
    echo '<div style="background-color:#ccc; padding:10px; margin:30px; font-size:10px;">';
    if ($titre != '')
        echo '<strong>'.$titre.'</strong><hr>';
    echo '<pre>';
    print_r($array);
    echo "</pre>";
    echo "</div>";
}

function dd($array = array(), $titre = "")
{
    echo '<div style="background-color:#ccc; padding:10px; margin:30px; font-size:10px;">';
    if ($titre != '')
        echo '<strong>'.$titre.'</strong><hr>';
    echo '<pre>';
    print_r($array);
    echo "</pre>";
    echo "</div>";
    die();
}

function my_number_format($number)
{
    return number_format($number, 2, '.', '&nbsp;');
}

function price_format($number)
{
    return number_format($number, 2, '.', '&nbsp;&euro;');
}

function price_round($number)
{
    return round($number, 2);
}

function thumb($uri = '', $width = NULL, $height = NULL, $mode = 'resize')
{
    $ci                     = &get_instance();
    $dir                    = base_url('uploads/images_produit');
    $config['source_image'] = $uri;
    $url                    = $dir.'/'.$uri;
    $config['new_image']    = $url;
    if (!is_dir($dir))
        mkdir($dir);


    if ($width)
        $config['width']  = $width;
    if ($height)
        $config['height'] = $height;

    pre($url);
    if ($mode == "crop") // Si il y a un crop, le resize doit être cover
    {
        pre(getimagesize($url));
        list($w, $h, $type, $attr) = getimagesize($uri);

        //if ($w > $h)
        if ($w / $h > $width / $height)
            $config['master_dim'] = 'height';
        else
            $config['master_dim'] = 'width';
    }

    $ci->load->library('image_lib', $config);
    if (!$ci->image_lib->resize())
        die($ci->image_lib->display_errors());

    if ($mode == "crop")
    {
        list($new_w, $new_h, $type, $attr) = getimagesize($url);

        $config['source_image']   = $config['new_image'];
        $config['maintain_ratio'] = FALSE;
        $config['x_axis']         = floor(($new_w - $width) / 2);
        $config['y_axis']         = floor(($new_h - $height) / 2);
        $ci->image_lib->initialize($config);
        if (!$ci->image_lib->crop())
            die($ci->image_lib->display_errors());
    }

    return site_url($config['new_image']);
}
