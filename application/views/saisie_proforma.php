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
                <form  method="post" action="<?= base_url("proforma/saisie_submit") ?>" class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Nom </th>
                        <th>Prix Unitaire</th>
                        <th>Disponibilité</th>
                      </tr>
                    </thead>
                    <input type="hidden" name="iddemande" value="<?= $iddemande ?>" >
                    <input type="hidden" name="idfournisseur" value="<?= $idfournisseur ?>" >
                    <tbody class="table-border-bottom-0">
                    <?php foreach ($articles as $a): ?>
                        <tr>
                            <td>
                            <input type="hidden" name="idarticle[]" value="<?= $a["idarticle"] ?>" >
                            <span class="fw-medium"><?= $a['nomarticle'] ?></span>
                            </td>
                            <td class="" >
                                <input class="form-control"  type="text" name="pu[]" required  >
                            </td>
                            <td class="" >
                                <input class="form-control"  type="text" name="dispo[]" required  >                            
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                  </table>
                  <div class="buy-now">
                        <button 
                        type="submit"
                        class="btn btn-primary btn-buy-now"
                        style="box-shadow:0 1px 20px 1px #696CFF;">Valider</button
                        >
                    </div>
                </form>
              </div>

              <hr class="my-5" />

            </div>

            
                   
            <!-- / Content -->

<?php  $this->load->view("template/footer_table.php")  ?>
