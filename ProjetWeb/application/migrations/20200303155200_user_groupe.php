<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_user_groupe extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
                'groupe_id'                              => array(
                        'type'           => 'INT',
                ),
                'user_id'                       => array(
                        'type'       => 'INT',
                ),
                'est_valide'                       => array(
                        'type'       => 'TINYINT',
                        'constraint' => 1,
                        'default'    => 0,
                ),
        ));
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (groupe_id) REFERENCES groupe(id) ON DELETE NO ACTION ON UPDATE NO ACTION');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE NO ACTION ON UPDATE NO ACTION');
        $this->dbforge->create_table('user_groupe');
    }

    public function down()
    {
      $this->dbforge->drop_table('user_groupe', TRUE);
    }

}
