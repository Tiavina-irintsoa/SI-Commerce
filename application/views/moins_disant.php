          <!-- Content wrapper -->
          <style>.right-number{
            text-align:right;
          }
          table td{
            padding-right:1vw!important;
            padding-left:1vw!important;
          }</style>
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
                      <form method="post" action ="<?= site_url('proforma/submit') ?>">
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Livraison Partielle  </label>
                          <div class='px-5'>
                          <div class="form-check">
                          <input name="livraison" class="form-check-input" type="radio" value="1" id="defaultRadio2" checked="">
                            <label class="form-check-label" for="defaultRadio2">Oui</label>
                          </div>
                          <input type="hidden"  name="iddemande" value="<?=  $iddemande  ?>" />
                          <div class="form-check">
                            <input name="livraison" class="form-check-input" type="radio" value="0" id="defaultRadio2" >
                            <label class="form-check-label" for="defaultRadio2">Non</label>
                          </div>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Mode de paiement</label>
                          <div class='px-5'>
                          <?php
                            foreach ($modes as $mode) { ?>
                             <div class="form-check">
                              <input name="mode" class="form-check-input" type="radio" value="<?= $mode['idmodepaiement']?>" id="defaultRadio2" checked="">
                              <label class="form-check-label" for="defaultRadio2"><?= $mode['nommode'] ?></label>
                            </div>
                          <?php  } ?>
                          
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
                        <td colspan="7" style="color:black;">
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
                            <td class="right-number">
                            <?= $commande['quantite'] ?>
                            </td>
                            <td class="right-number">
                            <?= $commande['prixht'] ?>
                            </td>
                            <td class="right-number">
                            <?= $commande['tva'] ?>
                            </td>
                            <td class="right-number">
                            <?= $commande['ttc'] ?>
                            </td>
                            <td class="right-number">
                            <?= $commande['montant'] ?>
                            </td>
                        </tr>

                    <?php    } ?>
                    <tr style="font-weight:bold;">
                          <td colspan="3">
                            <span >TOTAL</span>
                          </td>
                          <td class="right-number">
                            
                          </td>
                          <td class="right-number">
                          <?= $fournisseur['totaltva'] ?>
                          </td>
                          <td class="right-number">
                          
                          </td>
                          <td class="right-number">
                          <?= $fournisseur['montant'] ?>
                          </td>
                        </tr>
                    <?php } endforeach; ?>
                        


                        <tr style="font-weight:bolder;font-size:17px;">
                          <td colspan='3'>TOTAL DES BONS DE COMMANDE</td>
                          <td class="right-number"> </td>
                          <td class="right-number"> <?= $bon['totaltva'] ?></td>
                          <td class="right-number"></td>
                          <td class="right-number"> <?= $bon['montant'] ?></td>
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
            <script>
    // Sélectionnez tous les éléments avec la classe .right-number
    var elements = document.querySelectorAll('.right-number');

    // Parcourez chaque élément et mettez à jour son contenu
    elements.forEach(function(element) {
        // Récupérez le contenu et le convertir en nombre
        var number = parseFloat(element.textContent);

        // Vérifiez si le contenu est un nombre
        if (!isNaN(number)) {
            // Mettez à jour le contenu avec le nombre formaté
            element.textContent = number.toLocaleString('fr-FR'); // Utilisez le format français pour les séparateurs de milliers
        }
    });
</script>
