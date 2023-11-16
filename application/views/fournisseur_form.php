<?php $this->load->view("template/header.php") ?>

        <?php $this->load->view("template/nav.php") ?>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

        <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper" >
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y"   style="width:70%; margin: auto ;">
              <h4 class="py-3 mb-4"><span class="text-muted fw-light"></span> Fournisseur </h4>
              <div class="row"  >
                <div class="col-xxl" >
                  <div style="border-radius:15px;" class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="mb-0"><?= $nom ?></h5>
                      <small class="text-muted float-end">fournisseur</small>
                    </div>
                    <div class="card-body"  >
                      <form action="<?= $url ?>" method="post" >
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Nom</label>
                          <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                              <span id="basic-icon-default-fullname2" class="input-group-text"
                                ><i class="bx bx-user"></i
                              ></span>
                              <input
                                type="text"
                                value="<?= isset($input_value) && $input_value["nomfournisseur"] ?  $input_value['nomfournisseur'] : set_value("nomfournisseur")   ?>"
                                class="form-control"
                                id="basic-icon-default-fullname"
                                placeholder="John Doe"
                                aria-label="John Doe"
                                name="nomfournisseur"
                                aria-describedby="basic-icon-default-fullname2" />
                            </div>
                          </div>
                        </div>
                        
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Email</label>
                          <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                              <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                              <input
                                type="text"
                                value="<?= isset($input_value) && $input_value["emailfournisseur"] ?  $input_value['emailfournisseur'] : set_value("emailfournisseur") ?>"
                                id="basic-icon-default-email"
                                class="form-control"
                                placeholder="john.doe"
                                aria-label="john.doe"
                                name="emailfournisseur"
                                aria-describedby="basic-icon-default-email2" />
                              <span id="basic-icon-default-email2" class="input-group-text">@example.com</span>
                            </div>
                          </div>
                        </div>
                        <div class="row justify-content-end">
                          <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary"><?= $bouton ?></button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
<?php 
    $this->load->view("template/footer.php");
?>
