          <style>
             .detailsProforma{
                display:grid;
                grid-template-columns:3fr 2fr;
                width:100%;
                margin-bottom:6vh;
            }
            .article{
                display:flex;
                align-items:center;
            }
          </style>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="py-3 mb-4"><span class="text-muted fw-light">Proforma/</span>Demander</h4>
              <?php
                if(isset($erreur)){ ?>
                  <div class="alert alert-danger"><?= $erreur ?></div>
              <?php  }
              ?>
              <!-- Basic Layout & Basic with Icons -->
              <div class="row">
                <!-- Basic Layout -->
                <div class="col-xxl">
                  <div class="card mb-4">
                    
                    <div class="card-body">
                      <form method="post" action ="<?= site_url('demandeProforma/submit') ?>">
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Délai de livraison </label>
                          <div class="col-sm-10">
                            <input type="date"  value="<?= $today ?>" class="form-control" id="basic-default-name" name = "date" />
                          </div>
                        </div>
                        
                        <div class="px-0  row mb-4">
                          <label class="col-sm-4 col-form-label" for="basic-default-company">Choix de fournisseur</label>
                        <div class="demande mx-5 ">
                        <?php
                            foreach ($articles as $article ) { ?>
                            <div class=" detailsProforma">
                                <div class="article">
                                <label class="col-form-label align-items-center" for="basic-default-company "><?= $article['nomarticle'] ?></label>
                                </div>
                                <div class="fournisseurs col-md">
                                    <?php
                                    foreach ($article['fournisseurs'] as $fournisseur) { ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="FOURNISSEUR<?= $article['idarticle']?>[]" value="<?= $fournisseur['idfournisseur'] ?>" id="" >
                                            <label class="form-check-label" for=""> <?= $fournisseur['nomfournisseur'] ?> </label>
                                        </div>
                                    <?php    } ?>
                                    <?php
                                        if(count($article['fournisseurs']) == 0 ){ ?>
                                            <div  style="width:85%" class="alert alert-danger">
                                                Cet article n'a pas de fournisseurs. <a style="color:red;text-decoration:underline;" href="<?= site_url('fournisseur'); ?>" target="_blank">Voulez-vous ajouter ? </a>
                                            </div>
                                    <?php    }
                                    else if(count($article['fournisseurs']) < 3 ){ ?>
                                        <div  style="width:85%" class="alert alert-danger alert-dismissible">
                                            Cet article a moins de 3 fournisseurs. <a style="color:red;text-decoration:underline;" target="_blank" href="<?= site_url('fournisseur'); ?>">Voulez-vous ajouter ? </a>
                                        </div>
                                <?php    }
                                    ?>
                                </div>
                            </div>
                          </hr>
                        <?php    }
                        ?>    
                        </div>

                        
                        
                        <div class="row justify-content-center"> 
                          <div class="mt-5 col-3">
                            <button type="submit" class="btn btn-primary">Envoyer la demande</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- Basic with Icons -->
                
              </div>
            </div>
            <!-- / Content -->

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var detailsProformas = document.querySelectorAll('.detailsProforma');

                    detailsProformas.forEach(function (detailsProforma) {
                        var checkboxes = detailsProforma.querySelectorAll('.form-check-input');

                        // Compte le nombre de cases cochées
                        

                        // Coche toutes les cases si le nombre total est inférieur à 3
                        if (checkboxes.length < 3) {
                            checkboxes.forEach(function (checkbox) {
                                checkbox.checked = true;
                            });
                        }
                        else{
                            for (let index = 0; index < 3; index++) {
                                checkboxes[index].checked= true;
                                
                            }
                        }
                        
                    });
                });

            </script>