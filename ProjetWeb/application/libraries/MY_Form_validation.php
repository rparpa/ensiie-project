<?php

class MY_Form_validation extends CI_Form_validation
{

    public function is_unique($str, $field)
    {
        if (substr_count($field, '.') == 2) //is_unique[table.field.exclusion]
        {
            sscanf($field, '%[^.].%[^.].%[^.]', $table, $field, $id);
            return isset($this->CI->db) ? ($this->CI->db->limit(1)->get_where($table, array($field => $str, 'id !=' => $id))->num_rows() === 0) : FALSE;
        }
        else // is_unique de base
        {
            sscanf($field, '%[^.].%[^.]', $table, $field);
            return isset($this->CI->db) ? ($this->CI->db->limit(1)->get_where($table, array($field => $str))->num_rows() === 0) : FALSE;
        }
    }

}
