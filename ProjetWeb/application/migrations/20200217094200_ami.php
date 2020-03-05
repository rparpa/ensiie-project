<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_ami extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
                'id'                              => array(
                        'type'           => 'INT',
                        'auto_increment' => TRUE,
                ),
                'demandeur_id'                       => array(
                        'type'           => 'INT',
                ),
                'receveur_id'            => array(
                        'type'           => 'INT',
                ),
                'accept'                       => array(
                  'type'       => 'TINYINT',
                  'constraint' => 1,
                  'default'    => 0
                ),
                'created_at'                      => array(
                        'type' => 'DATETIME',
                        'null' => true
                ),
                'updated_at'                      => array(
                        'type' => 'DATETIME',
                        'null' => true
                ),
                'deleted_at'                      => array(
                        'type' => 'DATETIME',
                        'null' => true
                )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (demandeur_id) REFERENCES user(id) ON DELETE NO ACTION ON UPDATE NO ACTION');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (receveur_id) REFERENCES user(id) ON DELETE NO ACTION ON UPDATE NO ACTION');
        $this->dbforge->create_table('ami');
    }

    public function down()
    {
        $this->dbforge->drop_table('user', TRUE);
    }

}
