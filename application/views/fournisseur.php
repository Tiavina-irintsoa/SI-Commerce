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
                  href=<?= base_url("fournisseur/create") ?>
                  target="_blank"
                  class="btn btn-primary btn-buy-now"
                  style="box-shadow:0 1px 20px 1px #696CFF;">Ajouter fournisseur</a
                >
              </div>
              <div class="card">
                <h5 class="card-header"> Listes des fournisseurs </h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <?php foreach ($fournisseurs as $fournisseur): ?>
                        <tr>
                            <td>
                            <span class="fw-medium"><?= $fournisseur['nomfournisseur'] ?></span>
                            </td>
                            <td><?= $fournisseur['emailfournisseur'] ?></td>
                            <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?= base_url("fournisseur/edit?{$id}={$fournisseur[$id]}") ?>"
                                    ><i class="bx bx-edit-alt me-1"></i> Modifier </a
                                >
                                <a class="dropdown-item" href="<?= base_url("fournisseur/remove?{$id}={$fournisseur[$id]}") ?>"
                                    ><i class="bx bx-trash me-1"></i> Supprimer</a
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
