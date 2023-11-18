<?php $this->load->view("template/header.php") ?>

        <?php $this->load->view("template/nav.php") ?>

        <div class="layout-page">

        <?php $this->load->view("template/search.php") ?>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              
              <div class="card" style="height:70vh; display:flex; align-items:center;  " >
                <div class="image" style="height:70%;" >
                  <img style="object-fit: cover;height:90%;  " src="<?= base_url("assets/img/representation-3d-revente-du-marche-removebg-preview.png") ?>" >
                    <h1>
                        Bienvenue à vous
                    </h1>
                  </div>
              </div>

              <hr class="my-5" />

            </div>
            <!-- / Content -->

<?php  $this->load->view("template/footer_table.php")  ?>
