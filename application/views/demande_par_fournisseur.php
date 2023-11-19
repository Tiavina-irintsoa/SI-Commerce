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
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Delai de livraison</th>
                        <th>Fournisseur</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <?php foreach ($demandes as $b): ?>
                        <tr>
                            <td>
                            <span class="fw-medium"><?= $b['delailivraison'] ?></span>
                            </td>
                            <td>
                                <?= $b["nomfournisseur"] ?>
                            </td>
                            <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                <a style="cursor:pointer;" class="dropdown-item" onclick="filterDetailBesoinById('<?= $b['idfournisseur'] ?>')"
                                    ><i class="bx bx-edit-alt me-1"></i> Voir Détails </a
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

            <div class="col-lg-4 mb-4 order-0 hidden" id="popup_besoin"  style="position:absolute; right:300px; top:100px; opacity: 0; transition: opacity 0.5s, z-index 0.5s;"  >
                  <div class="card">
                    <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Détails 🛒</h5>
                    </div>
                    </div>
                      <div class="col-sm-12">
                        <form action="<?= base_url('proforma/saisie') ?>" method="post" class="card-body row">
                            <div  class="col-sm-6">
                                <p class="mb-4" style="font-weight: 600;"  >
                                    Article
                                </p>
                                <p class="mb-4">
                                    You have done <span class="fw-medium">72%</span> more sales today. Check your new badge in
                                    your profile. 
                                </p>
                            </div>
                            <div  class="col-sm-6">
                                <p class="mb-4" style="font-weight: 600;" >
                                    Quantité
                                </p>
                                <p class="mb-4">
                                    You have done <span class="fw-medium">72%</span> more sales today. Check your new badge in
                                    your profile.
                                </p>
                            </div>
                            <input type="hidden" name="iddemande" value="<?= $b['iddemande'] ?>"  />
                            <input type="hidden" id="idfournisseur" name="idfournisseur" />
                            <div class="row" style="display:flex; justify-content:space-between;justify-content:flex-end; " >
                              <button type="submit" id="accept"  class="col-sm-5 btn btn-sm btn-outline-primary">Saisie</button>
                            </div>
                        </form>
                      </div>
                    </div>
                    <div style="position: absolute; top: 10px; right: 10px; cursor: pointer;" onclick="hidePopup()">
                        <i class="bx bx-x-circle" style="font-size: 24px;"></i>
                    </div>
                  </div>
                </div>
                <script>
                    var detail_besoin = <?= json_encode($articles); ?>;
                    console.log(detail_besoin);
                    function showPopup() {
                        var popupDiv = document.getElementById('popup_besoin');
                        popupDiv.style.opacity = 1;
                        popupDiv.style.zIndex = 1;
                    }

                    function hidePopup() {
                        var popupDiv = document.getElementById('popup_besoin');
                        popupDiv.style.opacity = 0;
                        popupDiv.style.zIndex = -1;
                    }
                    function updateDetailPopup(list , idfournisseur) {
                        // Obtenez la référence de la div
                        var popupDiv = document.getElementById('popup_besoin');

                        // Obtenez la référence du conteneur pour les articles
                        var articlesContainer = popupDiv.querySelector('.col-sm-6:nth-child(1) p:nth-child(2)');

                        // Obtenez la référence du conteneur pour les quantités
                        var quantitesContainer = popupDiv.querySelector('.col-sm-6:nth-child(2) p:nth-child(2)');

                        // Effacez le contenu actuel
                        articlesContainer.innerHTML = '';
                        quantitesContainer.innerHTML = '';

                        var fournisseur_input = document.getElementById("idfournisseur");

                        fournisseur_input.value=idfournisseur;

                        // Bouclez sur la liste pour ajouter chaque élément
                        list.forEach(function(item, index) {
                            // Ajoutez le nom de l'article
                            articlesContainer.innerHTML += '<input type="hidden" name="idarticle[]"  value="'+item.idarticle+'" >\
                            <input type="hidden" name="nomarticle[]"  value="'+item.nomarticle+'" >\
                            <br><span class="mb-4 fw-medium">' + item.nomarticle + '</span><hr>';

                            // Ajoutez la quantité
                            quantitesContainer.innerHTML += '<br>' + item.quantite + '</span><hr>';
                        });
                    }

                    function filterDetailBesoinById(idfournisseur) {
                        // Utilisez la méthode filter pour obtenir les éléments avec le bon idfournisseur
                        var filteredList = detail_besoin.filter(function(item) {
                            return item.idfournisseur === idfournisseur;
                        });
                        console.log( filteredList );
                        updateDetailPopup(filteredList , idfournisseur);
                        showPopup();
                        // return filteredList;
                    }
                    // var filteredItems = filterDetailBesoinById("7");
                    // console.log(filteredItems);

                </script>   
            <!-- / Content -->

<?php  $this->load->view("template/footer_table.php")  ?>
