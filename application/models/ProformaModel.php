<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    require_once('PdfModel.php');
    require_once('EmailModel.php');
    class ProformaModel extends CI_Model{
        public function __construct(){
            parent::__construct();
            $this->load->Model('Generic_model' , 'gm');
            $this->load->Model('PdfModel');
            $this->load->Model('EmailModel');
        }
       
        
        public function getMoinsDisantParArticles($iddemande){
            $grandtotal = 0;
            $totaltva = 0;
            $this->db->select('idfournisseur,nomfournisseur');
            $this->db->from('v_demande_proforma_fournisseur_nom');
            $this->db->where('iddemande', $iddemande);
            $query = $this->db->get();
            $fournisseurs =array();
            $fournisseurs = $query->result_array();
            $countfournisseurs = count($fournisseurs);
            for ($i=0; $i < $countfournisseurs; $i++) { 
                $fournisseurs[$i]['commandes']=array();
                $fournisseurs[$i]['totaltva'] = 0;
                $fournisseurs[$i]['montant'] = 0;
            }
            $this->db->select('*');
            $this->db->from('v_demande_proform_details_article');
            $this->db->where('iddemande', $iddemande);

            $query = $this->db->get();
            $articles = $query->result_array();
            $nbarticles=  count($articles);
            for ($i=0; $i <$nbarticles; $i++) { 
                $this->db->select('*');
                $this->db->from('v_proforma_details_demande');
                $this->db->where('iddemande', $iddemande);
                $this->db->where('idarticle', $articles[$i]['idarticle']);
                $this->db->order_by('prixunitaire', 'asc');
                $this->db->order_by('disponible', 'desc');

                $query  = $this->db->get();
                $quantite_reste = $articles[$i]['quantite'];
                $prixfournisseur = $query->result_array();
                $ifournisseur = 0;
                $quantite_a_prendre;
                $nbpf = count($prixfournisseur);
                for ($j=0; $j <$nbpf ; $j++) { 
                    if($prixfournisseur[$j]['disponible']>$quantite_reste){
                        $quantite_a_prendre= $quantite_reste;
                    }
                    else{
                        $quantite_a_prendre= $prixfournisseur[$j]['disponible'];
                    }
                    $ifournisseur++;
                    for ($k=0; $k < $countfournisseurs ; $k++) { 
                        if($prixfournisseur[$j]['idfournisseur'] == $fournisseurs[$k]['idfournisseur']){
                            $fournisseurs[$k]['commandes'][] = array(
                                'nomcategorie' => $articles[$i]['libellecategorie'],
                                'nomarticle' => $articles[$i]['nomarticle'],
                                'quantite' => $quantite_a_prendre,
                                'prixht' => $prixfournisseur[$j]['prixunitaire'],
                                'tva' => $articles[$i]['tva']*$prixfournisseur[$j]['prixunitaire'],
                                'ttc' => (1+$articles[$i]['tva'])*$prixfournisseur[$j]['prixunitaire'],
                                'montant'=>(1+$articles[$i]['tva'])*$prixfournisseur[$j]['prixunitaire']*$quantite_a_prendre
                            );
                           
                            $fournisseurs[$k]['totaltva'] += $articles[$i]['tva']*$prixfournisseur[$j]['prixunitaire'];
                            $fournisseurs[$k]['montant'] += (1+$articles[$i]['tva'])*$prixfournisseur[$j]['prixunitaire']*$quantite_a_prendre;
                                
                            $grandtotal+=$fournisseurs[$k]['montant'];
                            $totaltva+=$fournisseurs[$k]['totaltva'];
                        }
                    }
                    $quantite_reste = $quantite_reste - $quantite_a_prendre;
                    
                    if($quantite_reste == 0){
                        break;
                    }
                }
                
            }
            return array(
                'fournisseurs'=>$fournisseurs,
                'montant'=>$grandtotal,
                'totaltva'=>$totaltva,
            );

        }
        public function verifier($iddemande){
            $this->db->select('idfournisseur');
            $this->db->from('proforma');
            $this->db->where('iddemande', $iddemande);

            $query = $this->db->get();
            $nbrecu = $query->num_rows();

            $this->db->select('idfournisseur');
            $this->db->from('v_demande_proforma_fournisseur');
            $this->db->where('iddemande', $iddemande);

            $query = $this->db->get();
            $nbenvoye = $query->num_rows();
            
            if($nbrecu!=$nbenvoye){
                return false;
            }
            return true;

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

        public function sendPDF($iddemande,$date,$user){
            $this->db->select('nomfournisseur,emailfournisseur,idfournisseur');
            $this->db->from('v_demande_proforma_fournisseur_nom');
            $this->db->where('iddemande', $iddemande);

            $query = $this->db->get();
            $fournisseurs = $query->result_array();
            for ($i=0; $i < count($fournisseurs) ; $i++) { 
                $fournisseurs[$i]['delai'] = $date;
                $this->db->select('*');
                $this->db->from('v_fournisseur_article_demande_proforma');
                $this->db->where(array('iddemande'=>$iddemande,'idfournisseur'=>$fournisseurs[$i]['idfournisseur']));
                $queryDetails = $this->db->get();['details'] ;
                $details = $queryDetails->result_array();
                for ($j=0; $j < count($details) ; $j++) { 
                    $fournisseurs[$i]['details'][$j] = array(
                        $details[$j]['nomarticle'],$details[$j]['quantite']
                    );
                    $path = $this->PdfModel->demande_proforma("Miraculous",$fournisseurs[$i]['nomfournisseur'],$date,$fournisseurs[$i]['details']);
                    $this->EmailModel->send($fournisseurs[$i]['emailfournisseur'],$fournisseurs[$i]['nomfournisseur'],$path,$date,$user);
                }
               
            }
        }
        public function sendDemande($articles,$date,$user){
            $iddemande = $this->insertAll($articles,$date);
            $this->sendPDF($iddemande,$date,$user);
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
            $datedemande = date('Y-m-d H:i:s');
            $data = array(
                'demandeproforma' => $datedemande,
            );
            
            $this->db->where('demandeproforma IS NULL', null, false);
            $this->db->where('datevalidation IS NOT NULL', null, false);
            $this->db->update('besoin', $data);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return $res['iddemande'];
            }
        }
    }