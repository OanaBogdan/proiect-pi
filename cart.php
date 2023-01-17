<?php
include 'config/conn.php';
session_start();
$in = implode(',', $_SESSION['cart']);
$cartTotal = 0;
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
  <title>BookLover -- Cart</title>
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
  <link rel="stylesheet" type="text/css" href="styles/main_responsive.css">
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
                      <input type="search" required="required" class="header_search_input"
                        placeholder="Cauta produse...">
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
                      <button type="submit" class="header_search_button trans_300" value="Submit"><img
                          src="images/search.png" alt=""></button>
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
                    <div class="account_content"><a class="dropdown-toggle" href="#" id="settingsDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                          class="fa-solid fa-user fa-2xl"></i> </a>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="settingsDropdown">
                        <span class="">
                          <center> Bine ai revenit <b>
                              <?php echo ($_SESSION['username']) ?>
                            </b></center>
                        </span>

                        <a class="dropdown-item mt-3" href="profile.php">Profil</a><a class="dropdown-item"
                          href="orders.php">Comenzi</a><a class="dropdown-item" href="logout.php">Logout</a>
                      </div>
                    </div>
                  </div>
                <?php } else { ?>
                  <div class="order-lg-3 text-lg-left text-right">
                    <div class="account_cart d-flex flex-row align-items-center justify-content-end">
                      <div class="account d-flex flex-row align-items-center justify-content-end">
                        <div class="account_content"> <a class="dropdown-toggle" href="#" id="settingsDropdown"
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                              class="fa-solid fa-user fa-2xl"></i></a>
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="settingsDropdown"><a
                              class="dropdown-item" href="login.php">Conectare</a><a class="dropdown-item"
                              href="register.php">Inregistrare</a></div>
                        </div>
                      </div>
                    <?php } ?>


                    <!-- Cart -->
                    <div class="account">
                      <div class="cart_container d-flex flex-row align-items-center justify-content-end"><a
                          href="cart.php">
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
    <!-- Cart -->

    <div class="cart_section">
      <div class="container">
        <div class="row">
          <div class="col-lg-10 offset-lg-1">
            <div class="cart_container">
              <center>
                <div class="cart_title">Cos</div>
              </center>



              <?php
              if (empty($_SESSION['cart'])) {
                ?>
                <div class="order_total">
                  <div class="order_total_content text-center">
                    <div class="order_total_title">Nu există articole în cos</div>
                  </div>
                </div>
              <?php } else {
                $query = "SELECT * FROM product WHERE id IN($in)";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                  $cartTotal = $cartTotal + ($row["price"]);
                  ?>
                  <div class="cart_items">
                    <ul class="cart_list">
                      <li class="cart_item clearfix">
                        <div class="cart_item_image"><img src="images/item/<?php echo $row['image']; ?>" alt=""></div>
                        <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                          <div class="cart_item_name cart_info_col">
                            <div class="cart_item_title">Nume</div>
                            <div class="cart_item_text">
                              <?php echo $row['name']; ?>
                            </div>
                          </div>
                          <div class="cart_item_price cart_info_col">
                            <div class="cart_item_title">Pret</div>
                            <div class="cart_item_text">RON<?php echo $row['price']; ?></div>
                          </div>
                          <div class="cart_item_total cart_info_col">
                            <div class="cart_item_title">Total</div>
                            <div class="cart_item_text">RON<?php echo $row['price']; ?></div>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                <?php }
                $_SESSION['total'] = $cartTotal;
                ?>

                <div class="order_total">
                  <div class="order_total_content text-md-right">
                    <div class="order_total_title">Comanda totală:</div>
                    <div class="order_total_amount">RON<?php echo $cartTotal; ?></div>
                  </div>
                </div>

                <div class="cart_buttons">
                  <a href="cart/svuota.php" class="button cart_button_clear">Cos gol</a>
                  <a href="checkout.php" class="button cart_button_checkout">Finalizează cumpărăturile</a>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>


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
<script src="js/jquery-3.3.1.min.js"></script>
  <script src="styles/bootstrap4/popper.js"></script>
  <script src="styles/bootstrap4/bootstrap.min.js"></script>
  <script src="plugins/greensock/TweenMax.min.js"></script>
  <script src="plugins/greensock/TimelineMax.min.js"></script>
  <script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
  <script src="plugins/greensock/animation.gsap.min.js"></script>
  <script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
  <script src="plugins/slick-1.8.0/slick.js"></script>
  <script src="plugins/easing/easing.js"></script>
  <script src="js/custom.js"></script>
  <script src="./js/search.js"></script>

</html>