<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Event_model extends MY_Model
{
    public $_table       = 'event';
    public $has_many     = array(
            '' => array('model' => '_model', 'primary_key' => '_id'),
    );
    public $belongs_to   = array(
            '' => array('model' => '_model', 'primary_key' => '_id'),
    );

    /* Sauvegarde des events dans la partie front */
    public function save($event_id = null, $user_id = null)
    {
        $res = 0;
        $postdata['titre']          = $this->input->post('titre');
        $postdata['description']    = $this->input->post('description');
        $postdata['date_debut']     = $this->input->post('date_debut');
        $postdata['date_fin']       = $this->input->post('date_fin');
        $postdata['latitude']       = $this->input->post('latitude');
        $postdata['longitude']      = $this->input->post('longitude');
        if ($this->auth->is_orga()){
          $postdata['est_publique']      = 1;
        }else{
          $postdata['est_publique']      = $this->input->post('est_publique') != null ? $this->input->post('est_publique') : 0;
        }

        // Traitement de l'image si un fichier a été renseigné
        if ($_FILES["img_url"]["name"] != null && $_FILES["img_url"]["name"] != ""){
            $target_dir = "htdocs/assets/images/";
            $target_file = $target_dir . "" . $event_id . "" . basename($_FILES["img_url"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            $i = 0;
            while (file_exists($target_file)) {
                $target_file = $target_dir . "" . $i . "" . basename($_FILES["img_url"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $i++;
            }

            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["img_url"]["tmp_name"]);
            if($check !== false) { // C'est bien une image
                if (move_uploaded_file($_FILES["img_url"]["tmp_name"], $target_file)) {
                    echo "The file ". basename( $_FILES["img_url"]["name"]). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                    $res = $res - 2;
                }
            } else { // C'est pas une image
                $res = $res - 1;
            }

            $postdata['img_url'] = $target_file;
        }

        // Dernière vérification - Date de début < date de fin
        if ($postdata['date_fin'] < $postdata['date_debut']){
            $res = $res - 4;
        }

        // On stop avant update/insert si erreur détectée
        if ($res < 0) {
            $postdata['res'] = $res;
            return $postdata;
        }

        // Modification d'un événement
        if ($event_id != null)
        {
            $this->event_model->update($event_id, $postdata);
            $tag_event=$this->event_tags_model->get_many_by(array("id_event" => $event_id));
            $data["tags"]=array();
            foreach($tag_event as $tag) {
              $data["tags"][]=$tag->id_tags;
            }
            $tags=$this->input->post('tags');
            foreach ($tags as $tag) {
              if(!in_array($tag,$data["tags"])){
                $this->event_tags_model->insert(array("id_tags" => $tag,"id_event" => $event_id));
              }
            }
        }
        // Nouvel événement
        else
        {
            $postdata["organisateur_id"] = $user_id;
            $event_id = $this->event_model->insert($postdata);
            $tag_event=$this->event_tags_model->get_many_by(array("id_event" => $event_id));
            $data["tags"]=array();
            foreach($tag_event as $tag) {
              $data["tags"][]=$tag->id_tags;
            }

            foreach ($this->input->post('tags') as $tag) {
              if(!in_array($tag,$data["tags"])){
                $this->event_tags_model->insert(array("id_tags" => $tag,"id_event" => $event_id));
              }
            }
        }

        return $event_id;
    }

    public function is_valid_form($event_id = null, $user_id = null)
    {
        /* Condition s'appliquant dans tous les cas */
        $this->form_validation->set_rules('description', '"Description"', 'trim|required');
        $this->form_validation->set_rules('img_url', '"Banderole"', 'trim');
        $this->form_validation->set_rules('date_debut', '"Date de debut"', 'trim|required');
        $this->form_validation->set_rules('date_fin', '"Date de fin"', 'trim|required');
        $this->form_validation->set_rules('latitude', '"Latitude"', 'trim|numeric');
        $this->form_validation->set_rules('longitude', '"Longitude"', 'trim|numeric');

        /* User lambda */
        if (!$this->auth->is_orga())
        {
            $this->form_validation->set_rules('est_publique', '"Evenement publique"', 'trim');
        }

        /* Ajout */
        if ($event_id == null)
        {
            $this->form_validation->set_rules('titre', '"Titre"', 'trim|required|is_unique[event.titre]');
        }
        /* Modifiaction */
        else
        {
            $this->form_validation->set_rules('titre', '"Titre"', 'trim|required');
        }

        if ($this->form_validation->run())
            return TRUE;

        return FALSE;
    }

    public function rechercher($user_id) {
        /* On récupère chaque mot de la chaine de caractères entrée dans la recherch
         * ex: "toto toto titi titi tata"
         * array ("toto", "titi", "tata")
         * */
        $recherche_type = array();
        $recherche_tags = array();
        if ($this->input->get('s') != NULL){
            $mots = $this->clean_str($this->input->get('s'));
            $recherche_type = array_unique(str_word_count($mots, 1));
        }
        if ($this->input->get('t') != NULL){
            $mots = $this->clean_str($this->input->get('t'));
            $recherche_tags = array_unique(str_word_count($mots, 1));
        }
        else if ($this->input->get('s') == NULL && $this->input->get('t') == NULL)
            return false;
        /* ---------------------------------------------------------------------------------- */

        /* Liste des events déjà ajoutés */
        $id_events = array();
        $user_event = $this->user_event_model->get_many_by(array("id_user" => $user_id));
        foreach ($user_event as $ev) {
            array_push($id_events, $ev->id_event);
        }

        /* On récupère les tags lié à la recherche */
        $tags = array();
        foreach ($recherche_tags as $m)
        {
            $this->db->select('*');
            $this->db->like('nom', $m, 'match', 'both', 'match', 'both');

            $query   = $this->db->get('tags');
            $results = $query->result();
            foreach ($results as $r)
            {
                $tags[] = $r;
            }
        }
        /* On récupère les events qui ont ces tags */
        $ids_to_check = array();
        foreach ($tags as $tag) {
            $arr = $this->event_tags_model->get_many_by(array("id_tags" => $tag->id));
            foreach ($arr as $ev) {
                if (!in_array($ev->id_event, $ids_to_check))
                    array_push($ids_to_check, $ev->id_event);
            }
        }
        /* ---------------------------------------------------------------------------------- */

        $tab_events = array();
        /* On recupere pour chaque mot les events ayant la chaine dans leur titre
         */
        foreach ($recherche_type as $m)
        {
            $this->db->select('*');
            $this->db->where('organisateur_id !=', $user_id);
            $this->db->where('est_publique', 1);
            if (!empty($id_events)) $this->db->where_not_in('id', $id_events);
            $this->db->group_start();
            $this->db->like('titre', $m, 'match', 'both', 'match', 'both');
            $this->db->group_end();

            $query   = $this->db->get('event');
            $results = $query->result();
            foreach ($results as $r)
            {
                $tab_events[] = $r;
            }
        }

        if (isset($ids_to_check) && $ids_to_check != NULL){
            $this->db->select('*');
            $this->db->where('organisateur_id !=', $user_id);
            $this->db->where('est_publique', 1);
            $this->db->where_in('id', $ids_to_check);
            if (!empty($id_events)) $this->db->where_not_in('id', $id_events);

            $query   = $this->db->get('event');
            $results = $query->result();
            foreach ($results as $r)
            {
                $tab_events[] = $r;
            }
        }

        /* ---------------------------------------------------------------------------------- */

        /* nous avons un tableau du genre ("toto", "titi", "toto titi", "toto titi", "tata") */
        $tab_poids = $this->poids_recherche($tab_events);
        $events=array();
        foreach ($tab_poids as $poids)
        {
            $events[] = $poids['event'];
        }
        return $events;
    }

    public function rechercher_rapide($user_id) {
        /* Liste des events déjà ajoutés */
        $id_events = array();
        $user_event = $this->user_event_model->get_many_by(array("id_user" => $user_id));
        foreach ($user_event as $ev) {
            array_push($id_events, $ev->id_event);
        }

        /* On récupère les tags de l'utilisateur */
        $id_tags = array();
        $tag_user=$this->user_tags_model->get_many_by(array("id_user" => $user_id));
        foreach ($tag_user as $ev) {
            if (!in_array($ev->id_tags, $id_tags))
                array_push($id_tags, $ev->id_tags);
        }

        /* On récupère les events qui ont ces tags */
        $ids_to_check = array();
        foreach ($id_tags as $id) {
            $arr = $this->event_tags_model->get_many_by(array("id_tags" => $id));
            foreach ($arr as $ev) {
                if (!in_array($ev->id_event, $ids_to_check))
                    array_push($ids_to_check, $ev->id_event);
            }
        }
        /* ---------------------------------------------------------------------------------- */

        $tab_events = array();
        if (isset($ids_to_check) && $ids_to_check != NULL){
            $this->db->select('*');
            $this->db->where('organisateur_id !=', $user_id);
            $this->db->where('est_publique', 1);
            $this->db->where_in('id', $ids_to_check);
            if (!empty($id_events)) $this->db->where_not_in('id', $id_events);

            $query   = $this->db->get('event');
            $results = $query->result();
            foreach ($results as $r)
            {
                $tab_events[] = $r;
            }
        }

        /* ---------------------------------------------------------------------------------- */

        /* nous avons un tableau du genre ("toto", "titi", "toto titi", "toto titi", "tata") */
        $tab_poids = $this->poids_recherche($tab_events);
        $events=array();
        foreach ($tab_poids as $poids)
        {
            $events[] = $poids['event'];
        }
        return $events;
    }

    /**
     * Fonction utilisée dans rechercher
     * @param array $tab_produits
     * @return type
     */
    public function poids_recherche($tab)
    {
        /* Tableau des valeurs des id des events (unique) */
        $tmp       = array();
        /* tableau de la forme : {"titi toto",2}, {"titi", 1}, {"toto", 1} */
        $tab_final = array();
        /* Pour chaque event: */
        foreach ($tab as $event)
        {
            /* Si l'id de l'event est deja dans tmp alors
             * on recupere la clé de tmp correspondant a la valeur de
             * l'id puis on incremete le nb de ce event dans le
             * tableau final
             */
            if (in_array($event->id, $tmp))
            {
                $key = array_search($event->id, $tmp);
                $tab_final[$key]['nombre'] ++;
            }
            /*events
             * Sinon on ajoute une case aux 2 tableaux avec le nouveau event
             */
            else
            {
                $tab_final[] = ['event' => $event, 'nombre' => 1];
                $tmp[]       = $event->id;
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

    private function clean_str($str)
    {
        $url = $str;
        $url = preg_replace('#Ç#', 'C', $url);
        $url = preg_replace('#ç#', 'c', $url);
        $url = preg_replace('#è|é|ê|ë#', 'e', $url);
        $url = preg_replace('#È|É|Ê|Ë#', 'E', $url);
        $url = preg_replace('#à|á|â|ã|ä|å#', 'a', $url);
        $url = preg_replace('#@|À|Á|Â|Ã|Ä|Å#', 'A', $url);
        $url = preg_replace('#ì|í|î|ï#', 'i', $url);
        $url = preg_replace('#Ì|Í|Î|Ï#', 'I', $url);
        $url = preg_replace('#ð|ò|ó|ô|õ|ö#', 'o', $url);
        $url = preg_replace('#Ò|Ó|Ô|Õ|Ö#', 'O', $url);
        $url = preg_replace('#ù|ú|û|ü#', 'u', $url);
        $url = preg_replace('#Ù|Ú|Û|Ü#', 'U', $url);
        $url = preg_replace('#ý|ÿ#', 'y', $url);
        $url = preg_replace('#Ý#', 'Y', $url);
         
        return ($url);
    }
}
