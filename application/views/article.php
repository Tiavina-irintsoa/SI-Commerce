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
                <h5 class="card-header"> Listes des fournisseurs </h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <?php foreach ($articles as $article): ?>
                        <tr>
                            <td>
                            <span class="fw-medium"><?= $article['nomarticle'] ?></span>
                            </td>
                            <td><?= $article['libellecategorie'] ?></td>
                            <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?= base_url("article/edit?{$id}={$article[$id]}") ?>"
                                    ><i class="bx bx-edit-alt me-1"></i> Modifier </a
                                >
                                <a class="dropdown-item" href="<?= base_url("article/remove?{$id}={$article[$id]}") ?>"
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
