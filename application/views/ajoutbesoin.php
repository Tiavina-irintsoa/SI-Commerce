          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="py-3 mb-4"><span class="text-muted fw-light">Besoin/</span> Ajouter des besoins</h4>
              <?php
                if($erreur){ ?>
                  <div class="alert alert-danger"><?= $erreur ?></div>
              <?php  }
              ?>
              <!-- Basic Layout & Basic with Icons -->
              <div class="row">
                <!-- Basic Layout -->
                <div class="col-xxl">
                  <div class="card mb-4">
                    
                    <div class="card-body">
                      <form method="post" action ="<?= site_url('besoin/submit') ?>">
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Date de demande </label>
                          <div class="col-sm-10">
                            <input type="date" class="form-control" id="basic-default-name" name = "date" />
                          </div>
                        </div>
                        
                        <div class="px-0 row mb-4">
                          <label class="col-sm-2 col-form-label" for="basic-default-company">Article</label>
                          <div class="col-sm-10"  id="details">
                            <div class="row" >
                              <div class="col-sm-9">
                                <select class="form-control" name="article" id="select-article">
                                  <?php
                                    foreach ($articles as $article ) { ?>
                                        <option value="<?= $article['idarticle']?>"><?= $article['nomarticle']?> </option>
                                  
                                  <?php  }
                                  ?>
                                </select>
                              </div>
                              <div class="col-sm-3">
                                  <input type="number" class="form-control" id="basic-default-name" name = "quantite" placeholder="Quantite" />
                              </div>
                            </div>
                            <div class="display-flex justify-content-end mt-4" id="adddetails">
                              <button onclick="ajouterNouveauDetails()" type="button" style="width:100%;" class="btn btn-icon btn-outline-primary">
                                <span class="tf-icons bx bx-plus"></span>
                              </button>
                            </div>
                            </div>
                          
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
            function ajouterNouveauDetails() {
              // Créez un nouvel élément #details
              var nouveauDetails = document.createElement('div');
              nouveauDetails.className = 'row mt-1';

              var select_article = document.getElementById('select-article');
              // Ajoutez le contenu du nouveau #details (vous pouvez le personnaliser selon vos besoins)
              nouveauDetails.innerHTML = `
                <div class="col-sm-9 ">
                  <select class="form-control" id="basic-default-company" name="article">
                    `+select_article.innerHTML+`
                  </select>
                </div>
                <div class="col-sm-3">
                  <input type="number" class="form-control" id="basic-default-name" name="quantite" placeholder="Quantite" />
                </div>
              `;

              // Insérez le nouveau #details en haut du dernier #details
              var detailsContainer = document.getElementById('details');
              var button_add = document.getElementById('adddetails');
              detailsContainer.insertBefore(nouveauDetails, button_add);

              // Faites défiler la page vers le nouveau #details en utilisant un défilement fluide
              nouveauDetails.scrollIntoView({ behavior: 'smooth' });
            }
            </script>