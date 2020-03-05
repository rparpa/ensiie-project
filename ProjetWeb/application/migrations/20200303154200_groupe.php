<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_groupe extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
                'id'                              => array(
                        'type'           => 'INT',
                        'auto_increment' => TRUE,
                ),
                'nom'                       => array(
                        'type'       => 'VARCHAR',
                        'constraint' => 255,
                ),
                'description'                       => array(
                        'type'       => 'VARCHAR',
                        'constraint' => 255,
                ),
                'img_url'                       => array(
                        'type'       => 'VARCHAR',
                        'constraint' => 255,
                ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('groupe');
    }

    public function down()
    {
        $this->dbforge->drop_table('groupe', TRUE);
    }

}
