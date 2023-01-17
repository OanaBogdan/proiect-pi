<?php
include 'config/conn.php';
session_start();
if (empty($_SESSION["username"])) {
  $_SESSION['error'] = 'Trebuie să vă autentificați pentru a accesa această pagină';
  header('location: ./login.php');
  exit();
}
if ($_SESSION['user_type'] != 1) {
  $_SESSION['error'] = 'Nu aveți permisiunea de a accesa această pagină';
  header('location: ./index.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
  <title>BookLover -- Admin</title>
  <link rel="icon" type="image/png" href="images/favicon.png">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
  <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
  <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
  <link rel="stylesheet" type="text/css" href="plugins/slick-1.8.0/slick.css">
  <link rel="stylesheet" type="text/css" href="styles/main_styles.css">
  <link rel="stylesheet" type="text/css" href="styles/responsive.css">
  <script src="https://kit.fontawesome.com/b378e79b5c.js" crossorigin="anonymous"></script>

</head>

<body>
  <div class="super_container">

    <!-- Header -->

    <header class="header">
      <!-- Header Main -->
      <div class="header_main">
        <div class="container">
          <div class="row justify-content-between">
            <!-- Logo -->
            <div class="col-lg-2">
              <div id="logo"><a href="index.php"><img src="images/logo.png" alt="logo" class="logo-size"></a></div>
            </div>
            <!-- Search -->

            <div class="order-2 text-lg-left text-center">
              <div class="header_search">
                <div class="header_search_content" style="width: 500px">
                  <div class="header_search_form_container">
                    <form action="#" class="header_search_form clearfix">
                      <input type="search" required="required" class="header_search_input" placeholder="Cauta produse...">
                      <div class="custom_dropdown d-none">
                        <div class="custom_dropdown_list">
                          <span class="custom_dropdown_placeholder clc" id="span_category">Toate</span>
                          <i class="fas fa-chevron-down"></i>
                          <ul class="custom_list clc">
                            <li><a class="clc active" href="#" data-value="all">Toate</a></li>
                            <?php
                            $sql = "SELECT * FROM category";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                              <li><a class="clc" href="#" data-value="<?php echo $row['name'] ?>">
                                  <?php echo $row['name'] ?>
                                </a></li>
                            <?php } ?>
                          </ul>
                        </div>
                      </div>
                      <button type="submit" class="header_search_button trans_300" value="Submit"><img src="images/search.png" alt=""></button>
                    </form>
                    <div class="search_results"></div>

                  </div>
                </div>
              </div>
            </div>

            <!-- Account -->
            <?php
            if (isset($_SESSION["username"])) {
            ?>
              <div class="order-lg-3 text-lg-left text-right">
                <div class="account_cart d-flex flex-row align-items-center justify-content-end">
                  <div class="account d-flex flex-row align-items-center justify-content-end">
                    <div class="account_content"><a class="dropdown-toggle" href="#" id="settingsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa-solid fa-user fa-2xl"></i> </a>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="settingsDropdown">
                        <span class="">
                          <center> Bine ai revenit <b>
                              <?php echo ($_SESSION['username']) ?>
                            </b></center>
                        </span>

                        <a class="dropdown-item mt-3" href="profile.php">Profil</a><a class="dropdown-item" href="orders.php">Comenzi</a><a class="dropdown-item" href="logout.php">Logout</a>
                      </div>
                    </div>
                  </div>
                <?php } else { ?>
                  <div class="order-lg-3 text-lg-left text-right">
                    <div class="account_cart d-flex flex-row align-items-center justify-content-end">
                      <div class="account d-flex flex-row align-items-center justify-content-end">
                        <div class="account_content"> <a class="dropdown-toggle" href="#" id="settingsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa-solid fa-user fa-2xl"></i></a>
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="settingsDropdown"><a class="dropdown-item" href="login.php">Conectare</a><a class="dropdown-item" href="register.php">Inregistrare</a></div>
                        </div>
                      </div>
                    <?php } ?>


                    <!-- Cart -->
                    <div class="account">
                      <div class="cart_container d-flex flex-row align-items-center justify-content-end"><a href="cart.php">
                          <div class="cart_icon"><i class="fa-solid fa-cart-arrow-down fa-2xl"></i>

                          </div>
                        </a></div>
                    </div>

                    <!-- Admin -->
                    <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 1) { ?>
                      <div class="account">
                        <div class="cart_container d-flex flex-row align-items-center justify-content-end">
                          <a href="admin.php"><i class="fa-solid fa-lock fa-2xl"></i></a>
                        </div>
                      </div>
                    <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
          </div>
    </header>

    <!-- Interface -->
    <!-- Crud page HTML for products -->
    <!-- Buton Adauga Produs deasupra in dreapta de produse -->
    <div class="container">
      <div class="row">
        <div class="col-md-12 m-3">
          <div class="float-right">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addProductModal">Adauga
              produs</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal pentru adaugare produs -->
    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addProductModalLabel">Adauga produs</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="addProductForm" action="config/handler.php" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="name">Nume produs</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nume produs" required>
              </div>
              <div class="form-group">
                <label for="price">Pret</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="Pret" step=".01" required>
              </div>
              <div class="form-group">
                <label for="description">Descriere</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
              </div>
              <!-- Category from db with php -->
              <div class="form-group" style="margin-right:0px !important;">
                <label for="category">Categorie</label>
                <select class="form-control" id="category" name="category" style="margin-left:-0px" required>
                  <option value="">Selecteaza categorie</option>
                  <?php
                  $query = $conn->query("SELECT * FROM category ORDER BY id");
                  while ($row = $query->fetch_assoc()) {
                    echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="image">Imagine</label>
                <input type="file" class="form-control-file" id="image" name="image" required>
              </div>
              <button type="submit" name="add_produs" class="btn btn-primary">Adauga</button>
            </form>
          </div>
        </div>
      </div>
    </div>



    <div class="container">
      <div class="row">
        <div class="col-md-12 m-3">
          <!-- Retrive products from database -->
          <div class="records_content">

            <?php
            // Include the database configuration file
            require_once 'config/conn.php';

            // Get records from the database
            $query = $conn->query("SELECT * FROM product ORDER BY id DESC");

            if ($query->num_rows > 0) {
              while ($row = $query->fetch_assoc()) {
            ?>
                <!-- Display products as rows with big width -->
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-3">
                            <img src="images/item/<?php echo $row['image']; ?>" alt="" class="img-fluid">
                          </div>
                          <div class="col-md-9">
                            <h5 class="card-title">
                              <?php echo $row['name']; ?>
                            </h5>
                            <p class="card-text">Descriere:<?php echo $row['description']; ?></p>
                            <p class="card-text">Pret: <?php echo $row['price']; ?> RON</p>
                            <p class="card-text">Categorie: <?php echo $row['category_name']; ?></p>
                            <!-- Button de editare cu date and send data in it  -->
                            <button type="button" class="btn btn-primary editBtn" id="edit_btn" data-toggle="modal" data-target="#editProductModal" data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>" data-price="<?php echo $row['price']; ?>" data-description="<?php echo $row['description']; ?>" data-category="<?php echo $row['category_name']; ?>" data-image="<?php echo $row['image']; ?>">Editeaza</button>
                            <!-- Button de stergere simplu -->
                            <button type="button" class="btn btn-danger deleteBtn" id="delete_btn" data-toggle="modal" data-target="#deleteProductModal" data-id="<?php echo $row['id']; ?>">Sterge</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <br>
              <?php }
            } else { ?>
              <p>Produsele nu au fost gasite...</p>
            <?php }
            ?>
          </div>
        </div>
      </div>
    </div>
    <!-- Edit Modal -->
    <div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editProductModalLabel">Editeaza produs</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="editProductForm" action="config/handler.php" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="edit_name">Nume</label>
                <input type="text" class="form-control" id="edit_name" name="edit_name" placeholder="Nume" required>
              </div>
              <div class="form-group">
                <label for="edit_price">Pret</label>
                <input type="number" class="form-control" id="edit_price" name="edit_price" placeholder="Pret" required>
              </div>
              <div class="form-group">
                <label for="edit_description">Descriere</label>
                <textarea class="form-control" id="edit_description" name="edit_description" rows="3" required></textarea>
              </div>
              <div class="form-group">
                <label for="edit_category">Categorie</label>
                <select class="form-control" id="edit_category" name="edit_category" style="margin-left:-0px" required>
                  <option value="">Selecteaza categorie</option>
                  <?php
                  $query = $conn->query("SELECT * FROM category ORDER BY id");
                  while ($row = $query->fetch_assoc()) {
                    echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                  }
                  ?>
                </select>
              </div>
              <input type="hidden" name="edit_id" id="edit_id">
              <button type="submit" class="btn btn-primary" name="edit_produs" id="editProductBtn">Editeaza</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Delete Modal -->
    <div class="modal fade" id="deleteProductModal" tabindex="-1" role="dialog" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteProductModalLabel">Sterge produs</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="deleteProductForm" action="config/handler.php" method="post">
              <input type="hidden" name="delete_id" id="delete_id">
              <h5>Sunteti sigur ca doriti sa stergeti acest produs?</h5>
              <button type="submit" class="btn btn-danger" name="delete_produs" id="deleteProductBtn">Sterge</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer -->
    <footer class="footer">
      <div class="container d-none">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2341.223672009748!2d21.229903377672276!3d45.74713930346177!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47455d84610655bf%3A0xfd169ff24d29f192!2sUniversitatea%20de%20Vest%20din%20Timi%C8%99oara!5e0!3m2!1sro!2sro!4v1670189221372!5m2!1sro!2sro" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        <div class="row">
          <div class="col-lg-3 footer_col">
            <div class="footer_column">
              <p>Bulevardul Vasile Pârvan 4, Timișoara 300223</p>
            </div>
          </div>
        </div>
      </div>
  </div>
  </footer>
  <!-- Copyright -->
  <div class="copyright">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
            <div class="copyright_content"> Copyright &copy;
              <script>
                document.write(new Date().getFullYear());
              </script>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
<script src="./js/jquery-3.3.1.min.js"></script>
<script src="./styles/bootstrap4/popper.js"></script>
<script src="./styles/bootstrap4/bootstrap.min.js"></script>
<script src="./js/admin.js"></script>
<script src="./js/custom.js"></script>
<script src="./js/search.js"></script>

</html>