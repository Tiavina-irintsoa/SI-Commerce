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
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Delai de livraison</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <?php foreach ($demandes as $b): ?>
                        <tr>
                            <td>
                            <span class="fw-medium"><?= $b['delailivraison'] ?></span>
                            </td>
                            <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?= base_url("proforma/demande_fournisseur?iddemande=".$b['iddemande']) ?>"
                                    ><i class="bx bx-edit-alt me-1"></i> Voir Détails </a
                                >
                                <a class="dropdown-item" href="<?= base_url("fournisseur/remove?") ?>"
                                    ><i class="bx bxs-file me-1"></i> Génerer bon de commande</a
                                >
                                </div>
                            </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>

              <hr class="my-5" />

            </div>

            
                
            <!-- / Content -->

<?php  $this->load->view("template/footer_table.php")  ?>
