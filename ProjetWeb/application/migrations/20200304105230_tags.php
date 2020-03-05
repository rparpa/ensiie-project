<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_tags extends CI_Migration
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
                'est_valide'            => array(
                        'type'       => 'TINYINT',
                        'constraint' => 1,
                        'default'    => 0
                ),
                'soumetteur'                       => array(
                          'type'     => 'INT'
                )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (soumetteur) REFERENCES user(id) ON DELETE NO ACTION ON UPDATE NO ACTION');
        $this->dbforge->create_table('tags');

        $this->db->query("INSERT INTO `tags`( `nom`, `est_valide`, `soumetteur`)
                          VALUES
                          ('Numérique',1,0),
                          ('Intérieur',1,0),
                          ('Extérieur',1,0),
                          ('Escape Game',1,0),
                          ('Nature',1,0),
                          ('Ballade',1,0),
                          ('Musique',1,0),
                          ('Scolaire',1,0),
                          ('Sport',1,0),
                          ('Manga',1,0),
                          ('Jeu',1,0),
                          ('Découverte',1,0),
                          ('Convention',1,0);");

    }

    public function down()
    {
        $this->dbforge->drop_table('tags', TRUE);
    }

}
