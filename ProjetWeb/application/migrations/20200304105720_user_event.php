<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_user_event extends CI_Migration
{

    public function up()
    {

        $this->dbforge->add_field(array(
                'id_user'                              => array(
                        'type'           => 'INT'
                ),
                'id_event'                       => array(
                        'type'       => 'INT'
                )
        ));
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_user) REFERENCES user(id) ON DELETE NO ACTION ON UPDATE NO ACTION');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_event) REFERENCES event(id) ON DELETE NO ACTION ON UPDATE NO ACTION');
        $this->dbforge->create_table('user_event');

    }

    public function down()
    {

        $this->dbforge->drop_table('user_event', TRUE);
    }

}
