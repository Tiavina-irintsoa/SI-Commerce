<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generic_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Charger la bibliothèque de base de données
        $this->load->database();
    }

    public function afficherRequete() {
        echo $this->db->last_query().'</br>';
    }

    public function getLast_Id(){
        $last_insert_id = $this->db->insert_id();
        return $last_insert_id;
    }


    public function getLast($table , $id_name , $result_type = 'array' ) {
        $this->db->from($table);
        $this->db->order_by($id_name, 'DESC');
        $this->db->limit(1);

        $query = $this->db->get();
        

        if ($query->num_rows() > 0) {                
            if ($result_type === 'object') {
                return $query->row();
            } else {
                return $query->row_array();
            }    
        }

        return null;
    }

    public function get_all($table, $order_by = null, $order_type = 'asc', $result_type = 'array', $where = null) {
        // Vérifiez si un ordre est spécifié
        if ($order_by !== null) {
            $this->db->order_by($order_by, $order_type);
        }
    
        // Ajoutez la clause WHERE si elle est spécifiée
        if ($where !== null) {
            $this->db->where($where);
        }
    
        // Récupérer tous les enregistrements de la table spécifiée
        return $this->db->get($table)->result($result_type);
    }
    
    
    public function get_by_id($table, $id, $result_type = 'array') {
        $this->db->from($table);
        $this->db->where($id['name'], $id['value']);
    
        $query = $this->db->get();
    
        if ($result_type === 'object') {
            return $query->row();
        } else {
            return $query->row_array();
        }    
    }
    
    public function get_by_id_list($table, $id, $result_type = 'array') {
        $this->db->from($table);
        $this->db->where($id['name'], $id['value']);
    
        $query = $this->db->get();
    
        if ($result_type === 'object') {
            return $query->result();
        } else {
            return $query->result();
        }    
    }

    public function insert($table, $data) {
        // Insérer un nouvel enregistrement
        return $this->db->insert($table, $data);
    }

    public function update($table, $id , $data) {
        $this->db->set( $data );
        $this->db->where( array( $id['name']  => $id['value'] ) );
        return $this->db->update($table);
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