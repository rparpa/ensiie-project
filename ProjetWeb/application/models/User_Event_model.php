<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_Event_model extends MY_Model
{
    public $_table       = 'user_event';
    public $has_many     = array(
            '' => array('model' => '_model', 'primary_key' => '_id'),
    );
    public $belongs_to   = array(
            '' => array('model' => '_model', 'primary_key' => '_id'),
    );


}
