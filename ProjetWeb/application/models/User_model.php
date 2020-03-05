<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends MY_Model
{
    public $_table       = 'user';
    public $has_many     = array(
            '' => array('model' => '_model', 'primary_key' => '_id'),
    );
    public $belongs_to   = array(
            '' => array('model' => '_model', 'primary_key' => '_id'),
    );

    /* Sauvegarde des users dans la partie front */

    public function save($user_id = null)
    {
        $postdata['email']    = $this->input->post('email');
        $postdata['nom']      = $this->input->post('nom');
        $postdata['prenom']   = $this->input->post('prenom');
        $postdata['date_naissance'] = $this->input->post('date_naissance');
        $postdata['login'] = $this->input->post('login');
        if ($this->input->post('organisateur')==NULL)
            $postdata['is_organisateur'] = false;
        else
            $postdata['is_organisateur'] = true;

        if ($user_id != null)
        {
            $this->user_model->update($user_id, $postdata);
        }
        /* Insciption user -> init non valide avec un hash pour pouvoir validé son compte */
        else
        {
            $postdata['email_valide'] = true;
            $postdata['hash']         = md5(uniqid());
            $postdata['created_at']   = date("Y-m-d H:i:s");
            $postdata['password']     = hash('sha256', $this->input->post('password'));
            $user_id                  = $this->user_model->insert($postdata);
        }
        return $user_id;
    }

    public function supprimer($user_id){
      $this->user_model->delete($user_id);
    }

    public function is_valid_form($user_id = null)
    {
        /* Condition s'appliquant dans tous les cas */
        $this->form_validation->set_rules('nom', '"Nom"', 'trim|required');
        $this->form_validation->set_rules('prenom', '"Prénom"', 'trim|required');
        $this->form_validation->set_rules('date_naissance', '"Date de naissance"', 'trim|required');

        /* Inscription/Ajout */
        if ($user_id == null)
        {
            $this->form_validation->set_rules('email', '"E-mail"', 'trim|required|valid_email|is_unique[user.email]');
            $this->form_validation->set_rules('login', '"Login"', 'trim|required|is_unique[user.login]');
            $this->form_validation->set_rules('password', '"Mot de passe"', 'trim|required');
            $this->form_validation->set_rules('confirm', '"Confirmation du mot de passe"', 'trim|required|matches[password]');
        }
        /* Modifiaction */
        else
        {
            $this->form_validation->set_rules('email', '"E-mail"', 'trim|required|valid_email|is_unique[user.email.'.$user_id.']');
            $this->form_validation->set_rules('login', '"Login"', 'trim|required|is_unique[user.login.'.$user_id.']');
        }

        if ($this->form_validation->run())
            return TRUE;

        return FALSE;
    }

     public function rechercher() {
        /* On récupère chaque mot de la chaine de caractères entrée dans la recherch
         * ex: "toto toto titi titi tata"
         * array ("toto", "titi", "tata")
         * */
        if ($this->input->get('s') != NULL)
            $recherche = $this->input->get('s');
        else
            return false;

        $mots     = array_unique(str_word_count($recherche, 1));
        $tab_users = array();

        /* On recupere pour chaque mot les users ayant la chaine dans leur nom, prenom, login
         */
        foreach ($mots as $m)
        {
            $this->db->select('*');
            $this->db->where('deleted_at', NULL);
            $this->db->group_start();
            $this->db->like('nom', $m, 'match', 'both', 'match', 'both');
            $this->db->or_like('prenom', $m, 'match', 'both');
            $this->db->or_like('login', $m, 'match', 'both');
            $this->db->group_end();

            $query   = $this->db->get('user');
            $results = $query->result();
            foreach ($results as $r)
            {
                $tab_users[] = $r;
            }
        }

        /* nous avons un tableau du genre ("toto", "titi", "toto titi", "toto titi", "tata") */
        $tab_poids = $this->poids_recherche($tab_users);
        $users=array();
        foreach ($tab_poids as $poids)
        {
            $users[] = $poids['user'];
        }
        return $users;
    }

    /**
     * Fonction utilisée dans rechercher
     * @param array $tab_produits
     * @return type
     */
    public function poids_recherche($tab)
    {
        /* Tableau des valeurs des id des users (unique) */
        $tmp       = array();
        /* tableau de la forme : {"titi toto",2}, {"titi", 1}, {"toto", 1} */
        $tab_final = array();
        /* Pour chaque user: */
        foreach ($tab as $user)
        {
            /* Si l'id de l'user est deja dans tmp alors
             * on recupere la clé de tmp correspondant a la valeur de
             * l'id puis on incremete le nb de ce user dans le
             * tableau final
             */
            if (in_array($user->id, $tmp))
            {
                $key = array_search($user->id, $tmp);
                $tab_final[$key]['nombre'] ++;
            }
            /*users
             * Sinon on ajoute une case aux 2 tableaux avec le nouveau user
             */
            else
            {
                $tab_final[] = ['user' => $user, 'nombre' => 1];
                $tmp[]       = $user->id;
            }
        }
        /* Tri du tableau par ordre decroissant du nombre */
        usort($tab_final, function ($a, $b)
        {
            $a = $a['nombre'];
            $b = $b['nombre'];
            if ($a == $b)
                return 0;
            return ($a > $b) ? -1 : 1;
        });
        return $tab_final;
    }

}
