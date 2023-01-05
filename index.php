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
  <meta name="description" content="BookLover Shop Project">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
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
            <div class="d-none">
              <div class="header_search">
                <div class="header_search_content">
                  <div class="header_search_form_container">
                    <form action="#" class="header_search_form clearfix w-50">
                      <input type="search" required="required" class="header_search_input" placeholder="Cauta produse...">
                      <div class="custom_dropdown d-none">
                        <div class="custom_dropdown_list">
                          <span class="custom_dropdown_placeholder clc" id="span_category">Toate</span>
                          <i class="fas fa-chevron-down"></i>
                          <ul class="custom_list clc">
                            <li><a class="clc" href="#" data-value="all">Toate</a></li>
                            <?php
                            $sql = "SELECT * FROM category";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                              <li><a class="clc" href="#" data-value="<?php echo $row['name'] ?>"><?php echo $row['name'] ?></a></li>
                            <?php } ?>
                          </ul>
                        </div>
                      </div>
                      <button type="submit" class="header_search_button trans_300" value="Submit"><img src="images/search.png" alt=""></button>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <div class="order-2 text-lg-left text-center">
              <div class="header_search">
                <div class="header_search_content"style="width: 600px">
                  <div class="header_search_form_container">
                    <form action="#" class="h-100 w-100">
                      <input type="search" required="required" class="header_search_input" style="width: 75%" placeholder="Cauta produse...">
                      <button type="submit" class="header_search_button trans_300" style="width: 25%" value="Submit"><img src="images/search.png" alt=""></button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Account -->
            <?php
            if (isset($_SESSION["username"])) {
            ?>
              <div class="order-lg-3  text-lg-left text-right">
                <div class="account_cart d-flex flex-row align-items-center justify-content-end">
                  <div class="account d-flex flex-row align-items-center justify-content-end">
                    <div class="account_content"><a class="dropdown-toggle" href="#" id="settingsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="./images/account.png" alt=""></a>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="settingsDropdown">
                        <span class="d-none">
                          <center><?php echo ($_SESSION['username']) ?>!</center>
                        </span>
                        <a class="dropdown-item" href="profile.php">Profil</a><a class="dropdown-item" href="orders.php">Comenzi</a><a class="dropdown-item" href="logout.php">Deconectare</a>
                      </div>
                    </div>
                  </div>
                <?php } else { ?>
                  <div class="col-lg-2 col-9 order-lg-3 order-3 text-lg-left text-right">
                    <div class="account_cart d-flex flex-row align-items-center justify-content-end">
                      <div class="account d-flex flex-row align-items-center justify-content-end">
                        <div class="account_content"> <a class="dropdown-toggle" href="#" id="settingsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="./images/account.png" alt=""></a>
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="settingsDropdown"><a class="dropdown-item" href="login.php">Conectare</a><a class="dropdown-item" href="register.php">Inregistrare</a></div>
                        </div>
                      </div>
                    <?php } ?>

                    <!-- Cart -->
                    <div class="cart">
                      <div class="cart_container d-flex flex-row align-items-center justify-content-end"><a href="cart.php">
                          <div class="cart_icon"><img src="./images/cart.png" alt="">
                            <div class="cart_count"><span><?php echo count($_SESSION['cart']); ?></span></div>
                          </div>
                        </a></div>
                    </div>
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
    <!-- Afacerea saptamanii -->

    <div class="deals_featured">
      <div class="container">
        <div class="row">
          <div class="col d-flex flex-lg-row flex-column align-items-center justify-content-start">

            <!-- Panoul afacerii -->

            <div class="deals">
              <div class="deals_title">Cea mai vanduta carte</div>
              <div class="deals_slider_container">

                <!-- Slider -->
                <div class="owl-carousel owl-theme deals_slider">
                  <?php
                  $query = "SELECT * from product WHERE category_name='Mister' LIMIT 1";
                  $result = mysqli_query($conn, $query);
                  while ($row = mysqli_fetch_assoc($result)) {
                  ?>
                    <!-- Item -->

                    <a href="product.php?id=<?php echo $row['id']; ?>">
                      <div class="owl-item deals_item">
                        <div class="deals_image "><img src="images/item/<?php echo $row['image']; ?>" alt=""></div>
                        <div class="deals_content">
                          <div class="deals_info_line d-flex flex-row justify-content-start">
                            <div class="deals_item_name "><?php echo $row['name']; ?></div>
                            <div class="deals_item_price ml-auto ">RON<?php echo $row['price']; ?></div>
                          </div>
                          <div class="available d-none">
                            <div class="available_line d-flex flex-row justify-content-start">
                              <div class="available_title">Disponibilitate: <span>6</span></div>
                              <div class="sold_title ml-auto">Deja vandut: <span>28</span></div>
                            </div>
                            <div class="available_bar"><span style="width:17%"></span></div>
                          </div>
                          <div class="deals_timer d-flex flex-row align-items-center justify-content-start d-none">
                            <div class="deals_timer_title_container d-none">
                              <div class="deals_timer_title">Grabeste-te</div>
                              <div class="deals_timer_subtitle">Se termina in:</div>
                            </div>
                            <div class="deals_timer_content ml-auto d-none">
                              <div class="deals_timer_box clearfix" data-target-time="">
                                <div class="deals_timer_unit">
                                  <div id="deals_timer1_hr" class="deals_timer_hr"></div>
                                  <span>ore</span>
                                </div>
                                <div class="deals_timer_unit">
                                  <div id="deals_timer1_min" class="deals_timer_min"></div>
                                  <span>minute</span>
                                </div>
                                <div class="deals_timer_unit">
                                  <div id="deals_timer1_sec" class="deals_timer_sec"></div>
                                  <span>secunde</span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                  <?php } ?>
                </div>
              </div>
              <div class="deals_slider_nav_container">
                <div class="deals_slider_prev deals_slider_nav"><i class="fas fa-chevron-left ml-auto"></i></div>
                <div class="deals_slider_next deals_slider_nav"><i class="fas fa-chevron-right ml-auto"></i></div>
              </div>
            </div>

            <!-- Reduceri -->
            <div class="featured">
              <div class="tabbed_container">
                <div class="tabs">
                  <ul class="clearfix">
                    <li class="active">Mister</li>
                    <li>Istorie</li>
                    <li>Psihologie</li>
                    <li>Drama</li>
                    <li>Amestec</li>
                  </ul>
                  <div class="tabs_line"><span></span></div>
                </div>

                <!-- Panou 1 -->

                <div class="product_panel panel active">
                  <div class="featured_slider slider">
                    <?php
                    $query = "SELECT * from product WHERE category_name='Mister'";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                      <!-- Item -->
                      <div class="featured_slider_item">
                        <div class="border_active"></div>
                        <div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                          <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="images/item/<?php echo $row['image']; ?>" alt=""></div>
                          <div class="product_content">
                            <div class="product_price discount">€<?php echo $row['price']; ?></div>
                            <div class="product_name">
                              <div><a href="product.php"><?php echo $row['name']; ?></a></div>
                            </div>
                            <div class="product_extras">
                              <a href="product.php?id=<?php echo $row['id']; ?>"><button class="product_cart_button">Descopera</button></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                  <div class="featured_slider_dots_cover"></div>
                </div>

                <!-- Panou 2 -->
                <div class="product_panel panel">
                  <div class="featured_slider slider">
                    <?php
                    $query = "SELECT * from product WHERE category_name='Istorie'";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                      <!-- Item -->
                      <div class="featured_slider_item">
                        <div class="border_active"></div>
                        <div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                          <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="images/item/<?php echo $row['image']; ?>" alt=""></div>
                          <div class="product_content">
                            <div class="product_price discount">€<?php echo $row['price']; ?></div>
                            <div class="product_name">
                              <div><a href="product.php"><?php echo $row['name']; ?></a></div>
                            </div>
                            <div class="product_extras">
                              <a href="product.php?id=<?php echo $row['id']; ?>"><button class="product_cart_button">Descopera</button></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                  <div class="featured_slider_dots_cover"></div>
                </div>

                <!-- Panou 3 -->
                <div class="product_panel panel">
                  <div class="featured_slider slider">
                    <?php
                    $query = "SELECT * from product WHERE category_name='Psihologie'";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                      <!-- Item -->
                      <div class="featured_slider_item">
                        <div class="border_active"></div>
                        <div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center ">
                          <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="images/item/<?php echo $row['image']; ?>" alt=""></div>
                          <div class="product_content">
                            <div class="product_price discount">€<?php echo $row['price']; ?></div>
                            <div class="product_name">
                              <div><a href="product.php"><?php echo $row['name']; ?></a></div>
                            </div>
                            <div class="product_extras">
                              <a href="product.php?id=<?php echo $row['id']; ?>"><button class="product_cart_button">Descopera</button></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                  <div class="featured_slider_dots_cover"></div>
                </div>

                
                <!-- Pannello 4 -->

                <div class="product_panel panel">
                  <div class="featured_slider slider">
                    <?php
                    $query = "SELECT * from product WHERE category_name='Drama'";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                      <!-- Item -->
                      <div class="featured_slider_item">
                        <div class="border_active"></div>
                        <div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                          <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="images/item/<?php echo $row['image']; ?>" alt=""></div>
                          <div class="product_content">
                            <div class="product_price discount">€<?php echo $row['price']; ?></div>
                            <div class="product_name">
                              <div><a href="product.php"><?php echo $row['name']; ?></a></div>
                            </div>
                            <div class="product_extras">
                              <a href="product.php?id=<?php echo $row['id']; ?>"><button class="product_cart_button">Descopera</button></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                  <div class="featured_slider_dots_cover"></div>
                </div>

                <div class="product_panel panel">
                  <div class="featured_slider slider">
                    <?php
                    $query = "SELECT * from product WHERE category_name='Amestec'";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                      <!-- Item -->
                      <div class="featured_slider_item">
                        <div class="border_active"></div>
                        <div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center ">
                          <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="images/item/<?php echo $row['image']; ?>" alt=""></div>
                          <div class="product_content">
                            <div class="product_price discount">€<?php echo $row['price']; ?></div>
                            <div class="product_name">
                              <div><a href="product.php"><?php echo $row['name']; ?></a></div>
                            </div>
                            <div class="product_extras">
                              <a href="product.php?id=<?php echo $row['id']; ?>"><button class="product_cart_button">Descopera</button></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                  <div class="featured_slider_dots_cover"></div>
                </div>



              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Categorie Popolari -->

    <div class="popular_categories mt-5 d-none">
      <div class="container d-none">
        <div class="row">
          <div class="col-lg-3">
            <div class="popular_categories_content">
              <div class="popular_categories_title">Categorii Populare</div>
            </div>
          </div>

          <!-- Slider -->

          <div class="col-lg-9">
            <div class="popular_categories_slider_container">
              <div class="owl-carousel owl-theme popular_categories_slider">
                <?php
                $query = "SELECT * from category LIMIT 5";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                  <!-- Item -->
                  <div class="owl-item">
                    <div class="popular_category d-flex flex-column align-items-center justify-content-center">
                      <div class="popular_category_image"><img src="images/category/<?php echo $row['image']; ?>" alt=""></div>
                      <div class="popular_category_text"><?php echo $row['name']; ?></div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--  Nuovi Arrivi -->

    <div class="new_arrivals d-none">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="tabbed_container">
              <div class="tabs clearfix tabs-right">
                <div class="new_arrivals_title">Sosiri noi</div>
                <ul class="clearfix">
                  <li class="active">Smartphone</li>
                  <li>Componente</li>
                </ul>
                <div class="tabs_line"><span></span></div>
              </div>
              <div class="row">
                <div class="col-lg-12" style="z-index:1;">

                  <!-- Pannello Prodotto -->
                  <div class="product_panel panel active">
                    <div class="arrivals_slider slider">
                      <?php
                      $query = "SELECT * from product WHERE category_name='Smartphone' order by id desc LIMIT 8";
                      $result = mysqli_query($conn, $query);
                      while ($row = mysqli_fetch_assoc($result)) {
                      ?>
                        <!-- Item  -->
                        <div class="arrivals_slider_item">
                          <div class="border_active"></div>
                          <div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                            <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="images/item/<?php echo $row['image']; ?>" alt=""></div>
                            <div class="product_content">
                              <div class="product_price">€<?php echo $row['price']; ?></div>
                              <div class="product_name">
                                <div><a href="product.php"><?php echo $row['name']; ?></a></div>
                              </div>
                              <div class="product_extras">
                                <a href="product.php?id=<?php echo $row['id']; ?>"><button class="product_cart_button">Descopera</button></a>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php } ?>
                    </div>
                    <div class="arrivals_slider_dots_cover"></div>
                  </div>

                  <!-- Seconda Categoria -->
                  <div class="product_panel panel">
                    <div class="arrivals_slider slider">

                      <?php
                      $query = "SELECT * from product WHERE category_name='Componente PC' order by id desc LIMIT 8";
                      $result = mysqli_query($conn, $query);
                      while ($row = mysqli_fetch_assoc($result)) {
                      ?>
                        <!-- Item  -->
                        <div class="arrivals_slider_item">
                          <div class="border_active"></div>
                          <div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                            <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="images/item/<?php echo $row['image']; ?>" alt=""></div>
                            <div class="product_content">
                              <div class="product_price">€<?php echo $row['price']; ?></div>
                              <div class="product_name">
                                <div><a href="product.php"><?php echo $row['name']; ?></a></div>
                              </div>
                              <div class="product_extras">
                                <a href="product.php?id=<?php echo $row['id']; ?>"><button class="product_cart_button">Descopera</button></a>
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
              <div class="copyright_content"> Copyright &copy;<script>
                  document.write(new Date().getFullYear());
                </script></div>
              <div class="logos ml-sm-auto">
                <ul class="logos_list">
                  <li><a href="#"><img src="images/logos_1.png" alt=""></a></li>
                  <li><a href="#"><img src="images/logos_2.png" alt=""></a></li>
                  <li><a href="#"><img src="images/logos_3.png" alt=""></a></li>
                  <li><a href="#"><img src="images/logos_4.png" alt=""></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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
</body>

</html>