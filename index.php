<?php
include 'config/conn.php';

session_start();
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = array();
}
unset($_SESSION['qty_array']);
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
  <title>BookLover -- Homepage</title>
  <link rel="icon" type="image/png" href="images/favicon.png">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
  <script src="https://kit.fontawesome.com/b378e79b5c.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
  <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
  <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">

  <link rel="stylesheet" type="text/css" href="plugins/slick-1.8.0/slick.css">
  <link rel="stylesheet" type="text/css" href="styles/main_styles.css">
  <link rel="stylesheet" type="text/css" href="styles/responsive.css">
</head>

<body>
  <div class="super_container">
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
    <?php
    //info message
    if (isset($_SESSION['message'])) {
    ?>
      <div class="row">
        <div class="col-sm-12 col-sm-offset-6">
          <div class="alert alert-info text-center">
            <?php echo $_SESSION['message']; ?>
          </div>
        </div>
      </div>
    <?php
      unset($_SESSION['message']);
    } ?>
    <?php
    //info message
    if (isset($_SESSION['error'])) {
    ?>
      <div class="row">
        <div class="col-sm-12 col-sm-offset-6">
          <div class="alert alert-danger text-center">
            <?php echo $_SESSION['error']; ?>
          </div>
        </div>
      </div>
    <?php
      unset($_SESSION['error']);
    } ?>

    <!--  Nuovi Arrivi -->

    <div class="new_arrivals">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="tabbed_container">
              <div class="tabs clearfix tabs-right">
                <div class="new_arrivals_title">Carti</div>
                <ul class="clearfix">
                  <li class="active">Drama</li>
                  <li>Psihologic</li>
                  <li>Romantic</li>
                  <li>Actiune</li>
                  <li>Comedie</li>
                </ul>
                <div class="tabs_line"><span></span></div>
              </div>
              <div class="row">
                <div class="col-lg-12" style="z-index:1;">

                  <!-- Pannello Prodotto -->
                  <div class="product_panel panel active">
                    <div class="arrivals_slider slider">
                      <?php
                      $query = "SELECT * from product WHERE category_name='Drama' order by id desc LIMIT 15";
                      $result = mysqli_query($conn, $query);
                      while ($row = mysqli_fetch_assoc($result)) {
                      ?>
                        <!-- Item  -->
                        <div class="arrivals_slider_item">
                          <div class="border_active"></div>
                          <div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                            <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="images/item/<?php echo $row['image']; ?>" alt=""></div>
                            <div class="product_content">
                              <div class="product_price">RON<?php echo $row['price']; ?></div>
                              <div class="product_name">
                                <div>
                                    <?php echo $row['name']; ?>
                                  </div>
                              </div>
                              <div class="product_extras">
                                <a href="product.php?id=<?php echo $row['id']; ?>"><button class="product_cart_button">Cumpara</button></a>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php } ?>
                    </div>
                    <div class="arrivals_slider_dots_cover"></div>
                  </div>

                  <!-- Categoria 2 -->
                  <div class="product_panel panel">
                    <div class="arrivals_slider slider">

                      <?php
                      $query = "SELECT * from product WHERE category_name='Psihologic' order by id desc LIMIT 15";
                      $result = mysqli_query($conn, $query);
                      while ($row = mysqli_fetch_assoc($result)) {
                      ?>
                        <!-- Item  -->
                        <div class="arrivals_slider_item">
                          <div class="border_active"></div>
                          <div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                            <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="images/item/<?php echo $row['image']; ?>" alt=""></div>
                            <div class="product_content">
                              <div class="product_price">RON<?php echo $row['price']; ?></div>
                              <div class="product_name">
                                <div>
                                    <?php echo $row['name']; ?>
                                  </div>
                              </div>
                              <div class="product_extras">
                                <a href="product.php?id=<?php echo $row['id']; ?>"><button class="product_cart_button">Cumpara</button></a>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php } ?>

                    </div>
                    <div class="arrivals_slider_dots_cover"></div>
                  </div>

                  <!-- Categoria 3 -->
                  <div class="product_panel panel">
                    <div class="arrivals_slider slider">

                      <?php
                      $query = "SELECT * from product WHERE category_name='Romantic' order by id desc LIMIT 15";
                      $result = mysqli_query($conn, $query);
                      while ($row = mysqli_fetch_assoc($result)) {
                      ?>
                        <!-- Item  -->
                        <div class="arrivals_slider_item">
                          <div class="border_active"></div>
                          <div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                            <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="images/item/<?php echo $row['image']; ?>" alt=""></div>
                            <div class="product_content">
                              <div class="product_price">RON<?php echo $row['price']; ?></div>
                              <div class="product_name">
                                <div>
                                    <?php echo $row['name']; ?>
                                  </div>
                              </div>
                              <div class="product_extras">
                                <a href="product.php?id=<?php echo $row['id']; ?>"><button class="product_cart_button">Cumpara</button></a>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php } ?>

                    </div>
                    <div class="arrivals_slider_dots_cover"></div>
                  </div>

                  <!-- Categoria 4 -->
                  <div class="product_panel panel">
                    <div class="arrivals_slider slider">

                      <?php
                      $query = "SELECT * from product WHERE category_name='Actiune' order by id desc LIMIT 15";
                      $result = mysqli_query($conn, $query);
                      while ($row = mysqli_fetch_assoc($result)) {
                      ?>
                        <!-- Item  -->
                        <div class="arrivals_slider_item">
                          <div class="border_active"></div>
                          <div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                            <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="images/item/<?php echo $row['image']; ?>" alt=""></div>
                            <div class="product_content">
                              <div class="product_price">RON<?php echo $row['price']; ?></div>
                              <div class="product_name">
                                <div>
                                    <?php echo $row['name']; ?>
                                  </div>
                              </div>
                              <div class="product_extras">
                                <a href="product.php?id=<?php echo $row['id']; ?>"><button class="product_cart_button">Cumpara</button></a>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php } ?>

                    </div>
                    <div class="arrivals_slider_dots_cover"></div>
                  </div>

                  <!-- Categoria 5 -->
                  <div class="product_panel panel">
                    <div class="arrivals_slider slider">

                      <?php
                      $query = "SELECT * from product WHERE category_name='Comedie' order by id desc LIMIT 15";
                      $result = mysqli_query($conn, $query);
                      while ($row = mysqli_fetch_assoc($result)) {
                      ?>
                        <!-- Item  -->
                        <div class="arrivals_slider_item">
                          <div class="border_active"></div>
                          <div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                            <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="images/item/<?php echo $row['image']; ?>" alt=""></div>
                            <div class="product_content">
                              <div class="product_price">RON<?php echo $row['price']; ?></div>
                              <div class="product_name">
                                <div>
                                    <?php echo $row['name']; ?>
                                  </div>
                              </div>
                              <div class="product_extras">
                                <a href="product.php?id=<?php echo $row['id']; ?>"><button class="product_cart_button">Cumpara</button></a>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php } ?>

                    </div>
                    <div class="arrivals_slider_dots_cover"></div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
      <div class="container d-none">
        <div class="row">
          <div class="col-lg-3 footer_col">
            <div class="footer_column">
              <div class="justify-content-center"><a href="about.php">About us</a>
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
  </div>
</body>
<script src="./js/jquery-3.3.1.min.js"></script>
<script src="./styles/bootstrap4/popper.js"></script>
<script src="./styles/bootstrap4/bootstrap.min.js"></script>
<script src="./plugins/greensock/TweenMax.min.js"></script>
<script src="./plugins/greensock/TimelineMax.min.js"></script>
<script src="./plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="./plugins/greensock/animation.gsap.min.js"></script>
<script src="./plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="./plugins/slick-1.8.0/slick.js"></script>
<script src="./plugins/easing/easing.js"></script>
<script src="./js/custom.js"></script>
<script src="./js/search.js"></script>

</html>