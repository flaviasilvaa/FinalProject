<?php 
	include("../util/protection.php");
  include("../util/init.php");
  include("../util/connection.php");

  $msg = "";
  $email = $_POST['user_email'];
  $pass = mb_substr(password_hash($email,PASSWORD_DEFAULT), 0, 6);
  $keycode = $_SESSION["keycode"];

  $sql = "SELECT COUNT(*) as number FROM users WHERE user_email = :email;";
  $stmt = $conn -> prepare($sql);
  $stmt -> bindValue(':email', $email, PDO::PARAM_STR);
  $stmt -> execute();
  $row = $stmt->fetch();

  if ($email == "") {

    header("Location: add.php?r=3");
  }elseif ($row['number'] > 0) {

    header("Location: add.php?r=1");
  } else {
    
    $hashedPass = password_hash($pass,PASSWORD_DEFAULT);

    $sql = "CALL createUser(?,?,?);";
    $sth = $conn -> prepare($sql);
    $sth -> bindParam(1, $email, PDO::PARAM_STR);
    $sth -> bindParam(2, $hashedPass, PDO::PARAM_STR);
    $sth -> bindParam(3, $keycode, PDO::PARAM_STR);

    $sth->execute();
    //emailUser($email, $pass);

    header("Location: add.php?r=2");
  }


?>