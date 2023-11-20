<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class BonComModel extends CI_Model{
        public function get_bdcFinance(){
            $this->db->select('*');
            $this->db->from('boncommande');
            $this->db->join('demandeproforma', 'boncommande.iddemande = demandeproforma.iddemande', 'natural');
            $this->db->where('boncommande.datevalidationfinance IS NULL');
            $this->db->order_by('demandeproforma.delailivraison', 'ASC');
            $query = $this->db->get();
            return $query->result_array();
        }

        public function get_bdcAdjoint(){
            $this->db->select('*');
            $this->db->from('boncommande');
            $this->db->join('demandeproforma', 'boncommande.iddemande = demandeproforma.iddemande', 'natural');
            $this->db->where('boncommande.datevalidationfinance IS NOT NULL');
            $this->db->where('boncommande.datevalidationadjoint IS NULL');
            $this->db->order_by('demandeproforma.delailivraison', 'ASC');
            $query = $this->db->get();
            return $query->result_array();
        }

        public function get_fournisseur($id){
            $this->db->select('idfournisseur');
            $this->db->from('detailsboncommande');
            $this->db->where('idboncommande', $id);
            $this->db->group_by('idfournisseur', 'ASC');
            $query = $this->db->get();
            return $query->result_array();
        }

        public function get_information($id){
            $this->db->select('*');
            $this->db->from('boncommande');
            $this->db->join('modepaiement', 'modepaiement.idmodepaiement = boncommande.idmodepaiement', 'natural');
            $this->db->where('boncommande.idboncommande', $id);
            $query = $this->db->get();
            return$query->result_array()[0];
        }

        public function get_detail_bdc($id, $fournisseur){
            $this->db->select('*');
            $this->db->from('detailsboncommande');
            $this->db->join('article', 'article.idarticle = detailsboncommande.idarticle', 'natural');
            $this->db->join('categoriearticle', 'categoriearticle.idcategoriearticle = article.idcategoriearticle', 'natural');
            $this->db->join('fournisseur', 'fournisseur.idfournisseur = detailsboncommande.idfournisseur', 'natural');
            $this->db->where('detailsboncommande.idboncommande', $id);
            $this->db->where('detailsboncommande.idfournisseur', $fournisseur);
            $this->db->order_by('detailsboncommande.idfournisseur', 'ASC');
            $query = $this->db->get();
            return $query->result_array();
        }

        public function set_dateValidationFinance($id){
            $data = array(
                'datevalidationfinance' => 'now()'
            );            
            $this->db->where('idboncommande', $id);
            $this->db->update('boncommande', $data);
            $affected_rows = $this->db->affected_rows();
            if ($affected_rows > 0) {
            echo "Update successful";
            } else {
            echo "Update failed";
            }
        }

        public function set_datevalidationAdjoint($id){
            $data = array(
                'datevalidationadjoint' => 'now()'
            );            
            $this->db->where('idboncommande', $id);
            $this->db->update('boncommande', $data);
            $affected_rows = $this->db->affected_rows();
            if ($affected_rows > 0) {
            echo "Update successful";
            } else {
            echo "Update failed";
            }
        }
        
    }

    