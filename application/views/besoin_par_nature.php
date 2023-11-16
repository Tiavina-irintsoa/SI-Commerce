<div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="py-3 mb-4"><span class="text-muted fw-light">Besoin /</span>Liste Par Nature</h4>
              <div class="card">
                <h5 class="card-header">Responsive Table</h5>
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
        