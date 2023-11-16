<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generic_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Charger la bibliothèque de base de données
        $this->load->database();
    }

    
    public function get_all($table, $order_by = null, $order_type = 'asc') {
        // Vérifiez si un ordre est spécifié
        if ($order_by !== null) {
            $this->db->order_by($order_by, $order_type);
        }
    
        // Récupérer tous les enregistrements de la table spécifiée
        return $this->db->get($table)->result();
    }
    

    public function get_by_id($table, $id) {
        // Récupérer un enregistrement spécifique en fonction de l'ID
        return $this->db->get_where($table, array('id' => $id))->row();
    }

    public function insert($table, $data) {
        // Insérer un nouvel enregistrement
        return $this->db->insert($table, $data);
    }

    public function update($table, $id , $data) {
        // Mettre à jour un enregistrement en fonction de l'ID
        $this->db->where($id['name'] , $id['value']);
        return $this->db->update($table, $data);
    }

    public function delete($table, $id) {
        // Supprimer un enregistrement en fonction de l'ID
        return $this->db->delete($table, array($id['name'] => $id['value']));
    }

    public function soft_delete($table, $where) {
        // Mettez à jour la colonne datesuppression avec la date actuelle
        $this->db->set('datesuppression', date('Y-m-d H:i:s'));
        $this->db->where($where);
    
        // Exécutez la mise à jour
        return $this->db->update($table);
    }
    
}


?>