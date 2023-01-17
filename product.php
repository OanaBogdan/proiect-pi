<?php
include 'config/conn.php';
session_start();
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = array();
}
$id = $_GET['id'];

?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
  <title>BookLover -- Product</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
  <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
  <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
  <link rel="stylesheet" type="text/css" href="plugins/slick-1.8.0/slick.css">
  <script src="https://kit.fontawesome.com/b378e79b5c.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="styles/product_styles.css">
  <link rel="stylesheet" type="text/css" href="styles/product_responsive.css">
  <link rel="stylesheet" type="text/css" href="styles/main_styles.css">
  <link rel="stylesheet" type="text/css" href="styles/responsive.css">
  <style>
    .checked {
      color: orange;
    }
  </style>

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
    $query = "SELECT * from product WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
    ?>
      <div class="single_product">
        <div class="container">
          <div class="row">
            <!-- Selected Image -->
            <div class="col-lg-5 order-lg-2 order-1">
              <div class="image_selected"><img src="images/item/<?php echo $row['image']; ?>" alt=""></div>
            </div>

            <!-- Description -->
            <div class="col-lg-5 order-3">
              <div class="product_description">
                <div class="product_category">
                  <?php echo $row['category_name']; ?>
                </div>
                <div class="product_name"><?php echo $row['name']; ?></div>
                <div class="product_text">
                  <p>
                    <?php echo $row['description']; ?>
                  </p>
                </div>
                <div class="order_info d-flex flex-row">
                  <form action="">
                    <div class="clearfix" style="z-index: 1000;">
                    </div>
                    <div class="product_price">RON<?php echo $row['price']; ?></div>
                    <div class="button_container">
                      <a class="button cart_button" href="cart/add_cart.php?id=<?php echo $row['id']; ?>">Adaugă în
                        coș</a>
                    </div>
                  </form>
                </div>
                <!-- Take average value of rating from database from ratings table  -->
                <?php
                $query = "SELECT AVG(value) as rating FROM ratings WHERE product_id = '$id'";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);
                $rating = $row['rating'];
                ?>
                <div class="product_rating_container d-flex flex-row align-items-center justify-content-start">
                  <div class="product_rating">
                    <ul class="d-flex flex-row align-items-center justify-content-start">

                      <?php
                      for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $rating) {
                          echo '<li><i class="fa-solid fa-star checked"></i></li>';
                        } else {
                          echo '<li><i class="fa-regular fa-star"></i></li>';
                        }
                      }
                      echo number_format($rating, 1)
                      ?>
                    </ul>
                    <!-- Make a review with stars and comment -->

                    <?php if (isset($_SESSION['username'])) { ?>

                      <div class="modal fade bd-example-modal-lg" id="addReview" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Adaugă o recenzie</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body text-center">
                              <form action="config/handler.php" method="POST">
                                <div class="form-group row">
                                  <label for="rating" class="col-sm-2 col-form-label">Rating</label>
                                  <div class="col-sm-10">
                                    <select class="form-control" name="rating" id="rating">
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="comment" class="col-sm-2 col-form-label">Comentariu</label>
                                  <div class="col-sm-10">
                                    <textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
                                  </div>
                                </div>
                                <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                                <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
                                <button type="submit" class="btn btn-primary" name="add_review">Adaugă</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#addReview">
                        Adaugă o recenzie
                      </button>

                    <?php } else { ?>
                      <p class="text-center">Trebuie să fii logat pentru a putea adăuga o recenzie</p>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Show All Reviews based on product id -->
        <?php
        $query = "SELECT * FROM ratings WHERE product_id = '$id'";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
          $user_id = $row['user_id'];
          $query = "SELECT * FROM users WHERE id = '$user_id'";
          $user = mysqli_query($conn, $query);
          $user = mysqli_fetch_assoc($user);
        ?>
          <div class="container mt-3">
            <div class="row" style="padding-left:0">
              <div class="col-md-12" style="padding-left:0">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-2">
                        <p class="text-secondary text-center"><strong><?php echo $user['username']; ?></strong></p>
                      </div>
                      <div class="col-md-10">
                        <p>

                          <span class="float-right">
                            <?php
                            for ($i = 1; $i <= 5; $i++) {
                              if ($i <= $row['value']) {
                                echo '<i class="fa-solid fa-star checked"></i>';
                              } else {
                                echo '<i class="fa-regular fa-star"></i>';
                              }
                            }
                            ?>
                          </span>
                        </p>
                        <div class="clearfix"></div>
                        <p><?php echo $row['content']; ?></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      <?php } ?>
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
<script src="./js/rating.js"></script>

</html>