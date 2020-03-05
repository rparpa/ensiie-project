<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_user extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
                'id'                              => array(
                        'type'           => 'INT',
                        'auto_increment' => TRUE,
                ),
                'login'                       => array(
                        'type'       => 'VARCHAR',
                        'constraint' => 255,
                ),
                'password'                       => array(
                        'type'       => 'VARCHAR',
                        'constraint' => 255,
                ),
                'nom'                       => array(
                        'type'       => 'VARCHAR',
                        'constraint' => 255,
                ),
                'prenom'                       => array(
                        'type'       => 'VARCHAR',
                        'constraint' => 255,
                ),
                'email'                       => array(
                        'type'       => 'VARCHAR',
                        'constraint' => 255,
                ),
                'date_naissance'                      => array(
                        'type' => 'DATE',
                        'null' => true
                ),
                'premiere_connexion'            => array(
                        'type'       => 'TINYINT',
                        'constraint' => 1,
                        'default'    => 0
                ),
                'hash'                       => array(
                        'type'       => 'VARCHAR',
                        'constraint' => 255,
                ),
                'last_active'                      => array(
                        'type' => 'DATETIME',
                        'null' => true
                ),
                'connected'            => array(
                        'type'       => 'TINYINT',
                        'constraint' => 1,
                        'default'    => 0
                ),
                'email_valide'            => array(
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
                ),
                'is_admin'                      => array(
                        'type' => 'TINYINT',
                        'constraint' => 1,
                        'default'    => 0
                ),
                'is_organisateur'                      => array(
                        'type' => 'TINYINT',
                        'constraint' => 1,
                        'default'    => 0
                )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('user');
    }

    public function down()
    {
        $this->dbforge->drop_table('user', TRUE);
    }

}
