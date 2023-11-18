<?php $this->load->view("template/header.php") ?>

        <?php $this->load->view("template/nav.php") ?>

        <div class="layout-page">

        <?php $this->load->view("template/search.php") ?>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
            <div class="buy-now">
                <a
                  href=<?= base_url($url) ?>
                  class="btn btn-primary btn-buy-now"
                  style="box-shadow:0 1px 20px 1px #696CFF;"><?= $titre_bouton ?></a
                >
              </div>  
            <div class="card">
                <h5 class="card-header"> <?= $titre_liste ?></h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Personnel</th>
                        <th>Poste</th>
                        <th>Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <?php foreach ($besoins as $b): ?>
                        <tr>
                            <td>
                            <span class="fw-medium"><?= $b['nompersonnel'] ?></span>
                            </td>
                            <td><?= $b['nomposte'] ?></td>
                            <td><?= $b['datebesoin'] ?></td>
                            <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                <a class="dropdown-item" style="cursor:pointer;"  onclick="filterDetailBesoinById('<?= $b['idbesoin'] ?>')"
                                    ><i class="bx bx-edit-alt me-1"></i> Voir détails </a
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
                        <div class="card-body row">
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
                                    Quantité (semaine)
                                </p>
                                <p class="mb-4">
                                    You have done <span class="fw-medium">72%</span> more sales today. Check your new badge in
                                    your profile.
                                </p>
                            </div>
                            <div class="row" style="display:flex; justify-content:space-between; " >
                              <a  id="refus" href="#" class="col-sm-5 btn btn-sm btn-outline-danger">Refuser</a>
                              <a id="accept"  href="#" class="col-sm-5 btn btn-sm btn-outline-primary">Accepter</a>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div style="position: absolute; top: 10px; right: 10px; cursor: pointer;" onclick="hidePopup()">
                        <i class="bx bx-x-circle" style="font-size: 24px;"></i>
                    </div>
                  </div>
                </div>
                <script>
                    var detail_besoin = <?= json_encode($detail_besoin); ?>;
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
                    function updateDetailPopup(list , idBesoin) {
                        // Obtenez la référence de la div
                        var popupDiv = document.getElementById('popup_besoin');

                        // Obtenez la référence du conteneur pour les articles
                        var articlesContainer = popupDiv.querySelector('.col-sm-6:nth-child(1) p:nth-child(2)');

                        // Obtenez la référence du conteneur pour les quantités
                        var quantitesContainer = popupDiv.querySelector('.col-sm-6:nth-child(2) p:nth-child(2)');

                        var refus = document.getElementById("refus");
                        var accept = document.getElementById("accept");

                        refus.href = "<?= base_url("besoin/refus?idbesoin=") ?>"+idBesoin;
                        accept.href = "<?= base_url("besoin/accept?idbesoin=") ?>"+idBesoin;

                        // Effacez le contenu actuel
                        articlesContainer.innerHTML = '';
                        quantitesContainer.innerHTML = '';

                        // Bouclez sur la liste pour ajouter chaque élément
                        list.forEach(function(item, index) {
                            // Ajoutez le nom de l'article
                            articlesContainer.innerHTML += '<br><span class="mb-4 fw-medium">' + item.nomarticle + '</span><hr>';

                            // Ajoutez la quantité
                            quantitesContainer.innerHTML += '<br>' + item.quantite + '</span><hr>';
                        });
                    }

                    function filterDetailBesoinById(idBesoin) {
                        // Utilisez la méthode filter pour obtenir les éléments avec le bon idbesoin
                        var filteredList = detail_besoin.filter(function(item) {
                            return item.idbesoin === idBesoin;
                        });
                        console.log( filteredList );
                        updateDetailPopup(filteredList , idBesoin);
                        showPopup();
                        // return filteredList;
                    }
                    // var filteredItems = filterDetailBesoinById("7");
                    // console.log(filteredItems);

                </script>
            <!-- / Content -->

<?php  $this->load->view("template/footer_table.php")  ?>
