<?php $this->load->view("template/header.php") ?>

        <?php $this->load->view("template/nav.php") ?>

        <div class="layout-page">

        <?php $this->load->view("template/search.php") ?>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
            <div class="buy-now">
                <a
                  href=<?= base_url("article/create") ?>
                  target="_blank"
                  class="btn btn-primary btn-buy-now"
                  style="box-shadow:0 1px 20px 1px #696CFF;">Afficher tous les besoins non validés</a
                >
              </div>  
            <div class="card">
                <h5 class="card-header"> Listes des besoin de cette semaine </h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Personnel</th>
                        <th>Poste</th>
                        <th>Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <?php foreach ($besoins as $b): ?>
                        <tr>
                            <td>
                            <span class="fw-medium"><?= $b['nompersonnel'] ?></span>
                            </td>
                            <td><?= $b['nomposte'] ?></td>
                            <td><?= $b['datebesoin'] ?></td>
                            <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?= base_url("besoin/details?idbesoin={$b['idbesoin']}") ?>"
                                    ><i class="bx bx-edit-alt me-1"></i> Voir détails </a
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

            <div class="col-lg-4 mb-4 order-0" id="popup_besoin"  style="position:absolute; right:300px; top:100px; "  >
                  <div class="card">
                    <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Détails 🛒</h5>
                    </div>
                    </div>
                      <div class="col-sm-12">
                        <div class="card-body row">
                            <div  class="col-sm-6">
                                <p class="mb-4" style="font-weight: 600;"  >
                                    Article
                                </p>
                                <p class="mb-4">
                                    You have done <span class="fw-medium">72%</span> more sales today. Check your new badge in
                                    your profile.
                                </p>
                            </div>
                            <div  class="col-sm-6">
                                <p class="mb-4" style="font-weight: 600;" >
                                    Quantité (semaine)
                                </p>
                                <p class="mb-4">
                                    You have done <span class="fw-medium">72%</span> more sales today. Check your new badge in
                                    your profile.
                                </p>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            <!-- / Content -->

<?php  $this->load->view("template/footer_table.php")  ?>
