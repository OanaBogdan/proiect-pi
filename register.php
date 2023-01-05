<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<title>BookLover -- Register</title>
<link rel="icon" type="image/png" href="images/favicon.png">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="BookLover Shop Project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="styles/register.css">
</head>
<script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script src="js/particle.js"></script>
<script src="js/register.js"></script>
<body style="background:whitesmoke">
<div class="container">
  <div class="">
    <div class="">
      <div class="card card-signin flex-row">
        <div class="card-body">
          <h5 class="card-title text-center">Inregistrare</h5>
          <form class="form-signin" action="config/handler.php" method="post">
            <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>
            <?php if (isset($_GET['name'])) { ?>
            <div class="form-label-group">
              <input type="text" id="inputName" class="form-control" name="name" placeholder="Prenume" value="<?php echo $_GET['name']; ?>" required autofocus>
              <label for="inputName">Prenume</label>
            </div>
            <?php }else{ ?>
			  <div class="form-label-group">
              <input type="text" id="inputName" class="form-control" name="name" placeholder="Prenume" required autofocus>
              <label for="inputName">Prenume</label>
              </div>
			  <?php } ?>
            <?php if (isset($_GET['surname'])) { ?>
            <div class="form-label-group">
              <input type="text" id="inputSurname" class="form-control" name="surname" placeholder="Nume" value="<?php echo $_GET['surname']; ?>" required autofocus>
              <label for="inputSurname">Nume</label>
            </div>
            <?php }else{ ?>
			  <div class="form-label-group">
              <input type="text" id="inputSurname" class="form-control" name="surname" placeholder="Nume" required autofocus>
              <label for="inputSurname">Nume</label>
              </div>
			  <?php } ?>
			  
			  
			  <?php if (isset($_GET['username'])) { ?>
            <div class="form-label-group">
              <input type="text" id="inputUsername" class="form-control" name="username" placeholder="Username" value="<?php echo $_GET['username']; ?>" required autofocus>
              <label for="inputUsername">Username</label>
            </div>
            <?php }else{ ?>
			  <div class="form-label-group">
              <input type="text" id="inputUsername" class="form-control" name="username" placeholder="Username" required autofocus>
              <label for="inputUsername">Username</label>
              </div>
			  <?php } ?>
			  <?php if (isset($_GET['email'])) { ?>
            <div class="form-label-group">
              <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email" value="<?php echo $_GET['email']; ?>" required autofocus>
              <label for="inputEmail">Email</label>
            </div>
            <?php }else{ ?>
			  <div class="form-label-group">
              <input type="text" id="inputEmail" class="form-control" name="email" placeholder="Email" required autofocus>
              <label for="inputEmail">Email</label>
              </div>
			  <?php } ?>
            <div class="form-label-group">
              <input type="password" id="inputPassword" class="form-control" name="password1" placeholder="Password" required>
              <label for="inputPassword">Parola</label>
            </div>
            <div class="form-label-group">
              <input type="password" id="inputConfirmPassword" class="form-control" name="password2" placeholder="Password" required>
              <label for="inputConfirmPassword">Confirma parola</label>
            </div>
            <button class="btn btn-lg btn-primary btn-block text-uppercase" name="register" type="submit">Inregistrare</button>
            <a class="d-block text-center mt-2 small" href="login.php">Conectare</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
