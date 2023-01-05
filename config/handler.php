<?php
include "conn.php";
if(isset($_POST['delete_produs'])){
  if(isset($_POST['delete_id'])){
    $id = $_POST['delete_id'];
    $sql = "DELETE FROM product WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    if($result){
      header("Location: ../admin.php?success=Produsul a fost șters cu succes");
      exit();
    }else{
      header("Location: ../admin.php?error=Produsul nu a putut fi șters");
      exit();
    }
  }
}

if(isset($_POST['edit_produs'])){//fara imagine
  if(isset($_POST['edit_name']) && isset($_POST['edit_price']) && isset($_POST['edit_description']) && isset($_POST['edit_category'])){
    //validate
    function validate($data){
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    $id = validate($_POST['edit_id']);
    $name = validate($_POST['edit_name']);
    $price = validate($_POST['edit_price']);
    $description = validate($_POST['edit_description']);
    $category = validate($_POST['edit_category']);
    echo $id.$name.$price.$description.$category;
    if(empty($name)){
      header("Location: ../admin.php?error=Numele produsului este obligatoriu");
      exit();
    }else if(empty($price)){
      header("Location: ../admin.php?error=Prețul produsului este obligatoriu");
      exit();
    }else if(empty($description)){
      header("Location: ../admin.php?error=Descrierea produsului este obligatorie");
      exit();
    }else if(empty($category)){
      header("Location: ../admin.php?error=Categoria produsului este obligatorie");
      exit();
    }else{
      $sql = "UPDATE product SET name='$name', description='$description', price='$price', category_name='$category' WHERE id='$id'";
      $result = mysqli_query($conn, $sql);
      if($result){
        header("Location: ../admin.php?success=Produsul a fost editat cu succes");
        exit();
      }else{
        header("Location: ../admin.php?error=Produsul nu a putut fi editat");
        exit();
      }
    }
  }
}





if(isset($_POST['add_produs'])){
  if(isset($_POST['name']) && isset($_POST['price']) && isset($_POST['description']) && isset($_POST['category']) && isset($_FILES['image']['name'])){
    //validate
    function validate($data){
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    $name = validate($_POST['name']);
    $price = validate($_POST['price']);
    $description = validate($_POST['description']);
    $category = validate($_POST['category']);
    $image = $_FILES['image']['name'];
    $target = "images/item/".basename($image);
    echo basename($image);
    if(empty($name)){
      header("Location: ../admin.php?error=Numele produsului este obligatoriu");
      exit();
    }else if(empty($price)){
      header("Location: ../admin.php?error=Prețul produsului este obligatoriu");
      exit();
    }else if(empty($description)){
      header("Location: ../admin.php?error=Descrierea produsului este obligatorie");
      exit();
    }else if(empty($category)){
      header("Location: ../admin.php?error=Categoria produsului este obligatorie");
      exit();
    }else{
      $sql = "INSERT INTO product(name, description, price, image, category_name ) VALUES('$name', '$description', '$price', '$image', '$category')";
      $result = mysqli_query($conn, $sql);
      if($result){
        if (is_uploaded_file($_FILES['image']['tmp_name'])) {
          $uploads_dir = '../images/item/';
          $tmp_name = $_FILES['image']['tmp_name'];
          $pic_name = $_FILES['image']['name'];
          move_uploaded_file($tmp_name, $uploads_dir.$pic_name);
          header("Location: ../admin.php?success=Produsul a fost adăugat cu succes");
          exit();
      }
      else{
          header("Location: ../admin.php?error=Produsul nu a putut fi adăugat");
          exit();
      }
      }else{
        header("Location: ../admin.php?error=Produsul nu a putut fi adăugat");
        exit();
      }
    }
  }
}

if ( isset( $_POST[ 'login' ] ) ) {
  if ( isset( $_POST[ 'username' ] ) && isset( $_POST[ 'password' ] ) ) {

    function validate( $data ) {
      $data = trim( $data );
      $data = stripslashes( $data );
      $data = htmlspecialchars( $data );
      return $data;
    }

    $username = validate( $_POST[ 'username' ] );
    $password = validate( $_POST[ 'password' ] );

    if ( empty( $username ) ) {
      header( "Location: ../login.php?error=Nume de utilizator obligatoriu" );
      exit();
    } else if ( empty( $password ) ) {
      header( "Location: ../login.php?error=Parola obligatorie" );
      exit();
    } else {
      $password = md5( $password );
      $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
      $result = mysqli_query( $conn, $sql );
      $count = mysqli_num_rows( $result );
	  $row = mysqli_fetch_assoc($result);
      if ( $count == 1 ) {
        session_start();
          $_SESSION[ 'username' ] = $row['username'];
		  $_SESSION['id'] = $row['id'];
		  $_SESSION[ 'name' ] = $row['name'];
		  $_SESSION[ 'surname' ] = $row['surname'];
		  $_SESSION[ 'email' ] = $row['email'];
      $_SESSION[ 'user_type' ] = $row['user_type'];
        header( "Location: ../index.php" );
      } else {
        header( "Location: ../login.php?error=Numele de utilizator sau parola incorectă" );
        exit();
      }
    }

  } else {
    header( "Location: ../login.php" );
    exit();
  }
}
if ( isset( $_POST[ 'register' ] ) ) {

  if ( isset( $_POST[ 'name' ] ) && isset( $_POST[ 'surname' ] ) &&
    isset( $_POST[ 'username' ] ) && isset( $_POST[ 'email' ] ) &&
    isset( $_POST[ 'password1' ] ) && isset( $_POST[ 'password2' ] ) ) {

    function validate( $data ) {
      $data = trim( $data );
      $data = stripslashes( $data );
      $data = htmlspecialchars( $data );
      return $data;
    }
    $name = validate( $_POST[ 'name' ] );
    $surname = validate( $_POST[ 'surname' ] );
    $username = validate( $_POST[ 'username' ] );
    $email = validate( $_POST[ 'email' ] );
    $password1 = validate( $_POST[ 'password1' ] );
    $password2 = validate( $_POST[ 'password2' ] );

    $user_data = 'name=' . $name . '&surname=' . $surname . '&username=' . $username . '&email=' . $email;


    if ( empty( $username ) ) {
      header( "Location: ../register.php?error=Nume de utilizator obligatoriu&$user_data" );
      exit();
    } else if ( empty( $password1 ) ) {
      header( "Location: ../register.php?error=Parola obligatorie&$user_data" );
      exit();
    } else if ( empty( $password2 ) ) {
      header( "Location: ../register.php?error=Este necesară confirmarea parolei&$user_data" );
      exit();
    } else if ( empty( $name ) ) {
      header( "Location: ../register.php?error=Prenume obligatoriu&$user_data" );
      exit();
    } else if ( empty( $surname ) ) {
      header( "Location: ../register.php?error=Nume obligatoriu&$user_data" );
      exit();
    } else if ( $password1 !== $password2 ) {
      header( "Location: ../register.php?error=Parolele trebuie să corespundă&$user_data" );
      exit();
    } else {

      $password1 = md5( $password1 );

      $sql = "SELECT * FROM users WHERE username='$username' ";
      $result = mysqli_query( $conn, $sql );

      if ( mysqli_num_rows( $result ) > 0 ) {
        header( "Location: ../register.php?error=Nume de utilizator ocupat&$user_data" );
        exit();
      } else {
        $sql2 = "INSERT INTO users(name, surname, username, email, password) VALUES('$name','$surname','$username','$email','$password1')";
        $result2 = mysqli_query( $conn, $sql2 );
        if ( $result2 ) {
          header( "Location: ../login.php?success=Contul dvs. a fost creat cu succes" );

          exit();
        } else {
          header( "Location: ../register.php?error=Eroare necunoscută&$user_data" );
          exit();
        }
      }
    }

  } else {
    header( "Location: ../register.php" );
    exit();
  }


}
