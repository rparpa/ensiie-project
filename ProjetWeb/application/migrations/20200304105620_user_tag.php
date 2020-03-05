<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_user_tag extends CI_Migration
{

    public function up()
    {

        $this->dbforge->add_field(array(
                'id_tags'                              => array(
                        'type'           => 'INT'
                ),
                'id_user'                       => array(
                        'type'       => 'INT'
                )
        ));
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_tags) REFERENCES tags(id) ON DELETE NO ACTION ON UPDATE NO ACTION');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_user) REFERENCES user(id) ON DELETE NO ACTION ON UPDATE NO ACTION');
        $this->dbforge->create_table('user_tag');

    }

    public function down()
    {

        $this->dbforge->drop_table('user_tag', TRUE);
    }

}
