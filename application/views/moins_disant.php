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
                        <th>Montant</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <?php foreach ($bon['fournisseurs'] as $fournisseur): if(count($fournisseur['commandes'])>0){ ?>
                      <tr>
                        <td colspan="7" style="background-color:#696cff;color:black;">
                          <?= $fournisseur['nomfournisseur'] ?>
                        </td>
                      </tr>
                        
                        <?php
                        foreach ($fournisseur['commandes'] as $commande) { ?>
                          <tr>
                            <td>
                            <span class="fw-medium"><?= $commande['nomcategorie'] ?></span>
                            </td>
                            <td><?= $commande['nomarticle'] ?></td>
                            <td style="text-align:right;">
                            <?= $commande['quantite'] ?>
                            </td>
                            <td style="text-align:right;">
                            <?= $commande['prixht'] ?>
                            </td>
                            <td style="text-align:right;">
                            <?= $commande['tva'] ?>
                            </td>
                            <td style="text-align:right;">
                            <?= $commande['ttc'] ?>
                            </td>
                            <td style="text-align:right;">
                            <?= $commande['montant'] ?>
                            </td>
                        </tr>
                    <?php    } ?>


                        <?php } endforeach; ?>
                        <tr style="font-weight:bold;">
                          <td colspan="3">
                            <span >TOTAL</span>
                          </td>
                          <td style="text-align:right;">
                            
                          </td>
                          <td style="text-align:right;">
                          <?= $fournisseur['totaltva'] ?>
                          </td>
                          <td style="text-align:right;">
                          
                          </td>
                          <td style="text-align:right;">
                          <?= $fournisseur['montant'] ?>
                          </td>
                        </tr>
                        <tr style="font-weight:bolder;font-size:17px;">
                          <td colspan='2'>TOTAL DES BONS DE COMMANDE</td>
                          <td style="text-align:right;"> </td>
                          <td style="text-align:right;"> <?= $bon['totaltva'] ?></td>
                          <td style="text-align:right;"></td>
                          <td style="text-align:right;"> <?= $bon['montant'] ?></td>
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
