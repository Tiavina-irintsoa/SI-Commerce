<div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="py-3 mb-4"><span class="text-muted fw-light">Besoin /</span>Liste Par Nature</h4>
              <div class="card">
              <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="mb-0">Besoins </h5>
                      <a href="<?=site_url('demandeProforma')?>">
                        <button type="button" class="float-end btn btn-primary">Faire une demande de Proforma</button>
                      </a>

                    </div>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr class="text-nowrap">
                        <th>Article</th>
                        <th>Quantite</th>
                        
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                        <?php
                            foreach ($besoins as $besoin ) { ?>
                                <tr>
                                    <td>
                                        <?= $besoin['nomarticle']?>
                                    </td>
                                    <td>
                                        <?= $besoin['quantite']?>
                                    </td>
                                </tr>
                        <?php    }
                        ?>
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
</div>
        