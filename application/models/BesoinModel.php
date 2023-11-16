<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BesoinModel extends CI_Model {

    public function get_par_nature(){
        $query = $this->db->get('v_besoin_par_nature');
        return $query->result_array();
    }
    public function insertAll($articles, $quantites, $date, $user) {
        $this->db->trans_start();
        $sql = "insert into besoin (idpersonnel, datebesoin) values ('%s', '%s') returning idbesoin";
        $sql = sprintf($sql,$user['matricule'],$date);
        $query  = $this->db->query($sql);
        $res = $query->row_array();
        for ($i = 0; $i < count($articles); $i++) {
            $detailBesoinData = array(
                'idbesoin' => $res['idbesoin'],
                'idarticle' => $articles[$i],
                'quantite' => $quantites[$i],
            );
            $this->db->insert('detailbesoin', $detailBesoinData);
        }

        $this->db->trans_complete();

        // Vérifiez si la transaction a réussi
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
}
?>
