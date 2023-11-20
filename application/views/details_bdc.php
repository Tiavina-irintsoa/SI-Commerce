<?php $this->load->view("template/header.php") ?>

        <?php $this->load->view("template/nav.php") ?>

        <div class="layout-page">

        <?php $this->load->view("template/search.php") ?>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <h5 class="card-header"> <?= $titre_liste ?></h5>
                <h5 class="card-header"> Livraison partielle : <?= $partielle ?></h5>
                <h5 class="card-header"> Mode de paiement : <?= $mode ?></h5>
              </div>

              <!-- <hr class="my-5" /> -->

            </div>

            <?php 
                $pus = 0; $tvas = 0; $totals = 0;
                foreach ($listes as $liste): 
                $pu = 0; $tva = 0; $total = 0;
            ?>
            <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <h5 class="card-header"> Fournisseur : <?= $liste[0]['nomfournisseur'] ?></h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Categorie</th>
                        <th>Designation</th>
                        <th>Quantite</th>
                        <th>Prix unitaire</th>
                        <th>TVA</th>
                        <th>Montant</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <?php foreach ($liste as $b): 
                                $pu += $b['prixunitaire'];
                                $tva += $b['tva']; 
                                $total += ($b['prixunitaire'] + $b['prixunitaire'] * $b['tva']) * $b['quantite'];
                    ?>
                        <tr>
                            <td>
                                <span class="fw-medium"><?= $b['libellecategorie'] ?></span>
                            </td>
                            <td>
                                <span class="fw-medium"><?= $b['nomarticle'] ?></span>
                            </td>
                            <td>
                                <span class="fw-medium"> <?= $b['quantite'] ?> </span>
                            </td>
                            <td>
                                <span class="fw-medium"> <?= number_format($b['prixunitaire'], 0, ',', ' ') ?> </span>
                            </td>
                            <td>
                                <span class="fw-medium"> <?= number_format($b['tva'], 0, ',', ' ') ?> </span>
                            </td>
                            <td>
                                <span class="fw-medium"> <?= number_format(($b['prixunitaire'] + $b['prixunitaire'] * $b['tva']) * $b['quantite'], 0, ',', ' ') ?> </span>
                            </td>
                        </tr>
                        <?php endforeach; 
                                $pus += $pu; $tvas += $tva; $totals += $total;
                        ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="fw-medium"> Total </span>
                            </td>
                            <td>
                                <span class="fw-medium"> <?= number_format($pu, 0, ',', ' ') ?> </span>
                            </td>
                            <td>
                                <span class="fw-medium"> <?= number_format($tva, 0, ',', ' ') ?> </span>
                            </td>
                            <td>
                                <span class="fw-medium"> <?= number_format($total, 0, ',', ' ') ?> </span>
                            </td>
                        </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <?php endforeach; ?>

            <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="fw-medium"> Total </span>
                            </td>
                            <td>
                                <span class="fw-medium"> <?= number_format($pus, 0, ',', ' ') ?> </span>
                            </td>
                            <td>
                                <span class="fw-medium"> <?= number_format($tvas, 0, ',', ' ') ?> </span>
                            </td>
                            <td>
                                <span class="fw-medium"> <?= number_format($totals, 0, ',', ' ') ?> </span>
                            </td>
                        </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <div class="dropdown">
                        <?php if ($user == 1) { ?>
                            <a class="dropdown-item" href="<?= base_url("bondecommande/send_pdg?id=".$b['idboncommande']) ?>">
                            <i class="bx bxs-file me-1"></i> Envoyer au PDG</a>
                        <?php } else{ ?> 
                            <a class="dropdown-item" href="<?= base_url("bondecommande/accepter_pdg?id=".$b['idboncommande']) ?>">
                            <i class="bx bxs-file me-1"></i> Accepter </a>
                        <?php } ?> 
                    </div>
                </div>
            </div>           
                
            <!-- / Content -->

<?php  $this->load->view("template/footer_table.php")  ?>
