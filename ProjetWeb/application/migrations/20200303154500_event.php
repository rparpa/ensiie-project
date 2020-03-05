<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_event extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
                'id'                              => array(
                        'type'           => 'INT',
                        'auto_increment' => TRUE,
                ),
                'organisateur_id'                 => array(
                        'type'           => 'INT',
                ),
                'titre'                       => array(
                        'type'       => 'VARCHAR',
                        'constraint' => 100,
                ),
                'description'                       => array(
                        'type'       => 'VARCHAR',
                        'constraint' => 500,
                ),
                'img_url'                       => array(
                        'type'       => 'VARCHAR',
                        'constraint' => 200,
                ),
                'tags'                       => array(
                        'type'       => 'VARCHAR',
                        'constraint' => 1000,
                ),
                'est_publique'                       => array(
                  'type'       => 'TINYINT',
                  'constraint' => 1,
                  'default'    => 0
                ),
                'date_debut'                      => array(
                        'type' => 'DATE',
                        'null' => true
                ),
                'date_fin'                      => array(
                        'type' => 'DATE',
                        'null' => true
                ),
                'latitude'                       => array(
                        'type'       => 'VARCHAR',
                        'constraint' => 20,
                ),
                'longitude'                       => array(
                        'type'       => 'VARCHAR',
                        'constraint' => 20,
                )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (organisateur_id) REFERENCES user(id) ON DELETE NO ACTION ON UPDATE NO ACTION');
        $this->dbforge->create_table('event');
    }

    public function down()
    {
        $this->dbforge->drop_table('user', TRUE);
    }

}
