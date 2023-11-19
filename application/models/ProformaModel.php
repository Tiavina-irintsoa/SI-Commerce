<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class ProformaModel extends CI_Model{
        public function __construct(){
            parent::__construct();
            $this->load->Model('Generic_model' , 'gm');
        }
        

        public function insertSaisie( $detaisproforma , $idfournisseur , $iddemande  ){
            $this->db->trans_start();
            $this->gm->insert( "proforma" , array( "idfournisseur" => $idfournisseur , "iddemande" => $iddemande ) );
            $idproforma = $this->gm->getLast( "proforma" , "idproforma" );
            foreach( $detaisproforma as $d ){
                $d['idproforma'] = $idproforma["idproforma"];
                $this->gm->insert( "detailsproforma" , $d );
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return true;
            }
        }

        public function insertAll($articles,$date){
            $this->db->trans_start();
            $sql = "insert into demandeproforma (delailivraison) values ('%s') returning iddemande";
            $sql = sprintf($sql,$date);
            $query  = $this->db->query($sql);
            $res = $query->row_array();

            for ($i=0; $i <count($articles) ; $i++) { 
                $detailDemande = array(
                    'iddemande' => $res['iddemande'],
                    'idarticle' => $articles[$i]['idarticle'],
                    'quantite' => $articles[$i]['quantite']
                );
                $this->db->insert('detailsdemandeproforma', $detailDemande);
                for ($j=0; $j < count($articles[$i]['fournisseurs_choisis']); $j++) { 
                    $detailsFournisseurArticle = array(
                        'iddemande' => $res['iddemande'],
                        'idarticle' => $articles[$i]['idarticle'],
                        'idfournisseur' => $articles[$i]['fournisseurs_choisis'][$j]
                    );
                    $this->db->insert('fournisseurdemandeproforma', $detailsFournisseurArticle);
                }
            }
            $data = array(
                'dateproforma' => date('Y-m-d H:i:s'),
            );
            
            $this->db->where('dateproforma IS NULL', null, false);
            $this->db->where('datevalidation IS NOT NULL', null, false);
            $this->db->update('besoin', $data);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return true;
            }
        }
    }