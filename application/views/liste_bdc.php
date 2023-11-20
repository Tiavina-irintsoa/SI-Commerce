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
                        <th>Date de creation</th>
                        <th>Detail</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <?php foreach ($listes as $b): ?>
                        <tr>
                            <td>
                                <span class="fw-medium"><?= $b['delailivraison'] ?></span>
                            </td>
                            <td>
                                <span class="fw-medium"><?= $b['datecreation'] ?></span>
                            </td>
                            <td>
                              <span class="fw-medium"> 
                                <a class="dropdown-item" href="<?= base_url("bondecommande/bdc_detail?id=".$b['idboncommande']."&user=".$user) ?>"
                                        ><i class="bx bx-edit-alt me-1"></i> Voir Détails 
                                </a> 
                              </span>
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
