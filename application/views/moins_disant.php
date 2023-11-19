          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="py-3 mb-4"><span class="text-muted fw-light">Bon de commande/</span> Generer</h4>
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
                      <form method="post" action ="<?= site_url('besoin/submit') ?>">
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Livraison Partielle  </label>
                          <div class='px-5'>
                          <div class="form-check">
                            <input name="livraison" class="form-check-input" type="radio" value="" id="defaultRadio2" checked="">
                            <label class="form-check-label" for="defaultRadio2">Oui</label>
                          </div>
                          <div class="form-check">
                            <input name="livraison" class="form-check-input" type="radio" value="" id="defaultRadio2" checked="">
                            <label class="form-check-label" for="defaultRadio2">Non</label>
                          </div>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Mode de paiement</label>
                          <div class='px-5'>
                          <div class="form-check">
                            <input name="mode" class="form-check-input" type="radio" value="" id="defaultRadio2" checked="">
                            <label class="form-check-label" for="defaultRadio2">Cheque</label>
                          </div>
                          <div class="form-check">
                            <input name="mode" class="form-check-input" type="radio" value="" id="defaultRadio2" checked="">
                            <label class="form-check-label" for="defaultRadio2">Virement</label>
                          </div>
                          </div>
                        </div>
                        
                        <div class="container-xxl flex-grow-1 container-p-y">
            
              <div class="card">
                <h5 class="card-header">Bon de commande (moins disant)</h5>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Categorie</th>
                        <th>Designation</th>
                        <th>Quantite</th>
                        <th>PU (HT)</th>
                        <th>TVA</th>
                        <th>PU (TTC)</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <?php //foreach ($fournisseurs as $fournisseur): ?>
                      <tr>
                        <td colspan="6" style="background-color:#696cff;color:black;">
                          FOURNISSEUR 2
                        </td>
                      </tr>
                        <tr>
                            <td>
                            <span class="fw-medium">Frounitres de bureau</span>
                            </td>
                            <td>Cahiers</td>
                            <td>
                              5
                            </td>
                            <td>
                              1000
                            </td>
                            <td>
                              200
                            </td>
                            <td>
                              1200
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <span class="fw-medium">Frounitres de bureau</span>
                            </td>
                            <td>Cahiers</td>
                            <td>
                              5
                            </td>
                            <td>
                              1000
                            </td>
                            <td>
                              200
                            </td>
                            <td>
                              1200
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <span class="fw-medium">Frounitres de bureau</span>
                            </td>
                            <td>Cahiers</td>
                            <td>
                              5
                            </td>
                            <td>
                              1000
                            </td>
                            <td>
                              200
                            </td>
                            <td>
                              1200
                            </td>
                        </tr>

                        <?php //endforeach; ?>
                        <tr style="font-weight:bold;">
                          <td colspan="3">
                            <span >TOTAL</span>
                          </td>
                          <td>
                            3000
                          </td>
                          <td>
                            600
                          </td>
                          <td>
                            3600
                          </td>
                        </tr>
                    
                      <tr>
                        <td colspan="6" style="background-color:#696cff;color:black;">
                          FOURNISSEUR 2
                        </td>
                      </tr>
                    <?php //foreach ($fournisseurs as $fournisseur): ?>
                        <tr>
                            <td>
                            <span class="fw-medium">Frounitres de bureau</span>
                            </td>
                            <td>Cahiers</td>
                            <td>
                              5
                            </td>
                            <td>
                              1000
                            </td>
                            <td>
                              200
                            </td>
                            <td>
                              1200
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <span class="fw-medium">Frounitres de bureau</span>
                            </td>
                            <td>Cahiers</td>
                            <td>
                              5
                            </td>
                            <td>
                              1000
                            </td>
                            <td>
                              200
                            </td>
                            <td>
                              1200
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <span class="fw-medium">Frounitres de bureau</span>
                            </td>
                            <td>Cahiers</td>
                            <td>
                              5
                            </td>
                            <td>
                              1000
                            </td>
                            <td>
                              200
                            </td>
                            <td>
                              1200
                            </td>
                        </tr>

                        <?php //endforeach; ?>
                        <tr style="font-weight:bold;">
                          <td colspan="3">
                            <span >TOTAL</span>
                          </td>
                          <td>
                            3000
                          </td>
                          <td>
                            600
                          </td>
                          <td>
                            TTC
                          </td>
                        </tr>
                        <tr style="font-weight:bolder;font-size:17px;">
                          <td colspan='3'>TOTAL</td>
                          <td>1111</td>
                          <td>22</td>
                          <td>34444</td>
                      </tr>
                    </tbody>
                  </table>
             
              </div>  

            </div>
                        <div class="row justify-content-center"> 
                          <div class="mt-5 col-3">
                            <button type="submit" class="btn btn-primary">Envoyer a la finance</button>
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
