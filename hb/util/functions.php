<?php

  function boilerDirect($duration, $user_id, $keycode, $conn) {
    $stards = time(); 
    $ends = time(); 
    $ends += $duration;
    
    $sql = "CALL createSchedule(?, ?, ?, ?);";
    $sth = $conn -> prepare($sql);
    $sth -> bindParam(1, $user_id, PDO::PARAM_INT);
    $sth -> bindParam(2, $keycode, PDO::PARAM_STR);
    $sth -> bindParam(3, $stards, PDO::PARAM_INT);
    $sth -> bindParam(4, $ends, PDO::PARAM_INT);
    $sth -> execute();
  }

  function createUserStatus($string) {
    
  }

  function checkError($int) {

    if ($int == 1) {
      $err[0] = "danger";
      $err[1] = "Email already registered!";
    } elseif ($int == 2) {
      $err[0] = "success";
      $err[1] = "Successful registration!";
    } elseif ($int == 3) {
      $err[0] = "danger";
      $err[1] = "Invalid Email!";
    } else {
      $err[0] = "warning";
      $err[1] = "Error 500";
    }
    
    return $err;

  }

  function emailUser($email, $pass) {
    /*

        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        $from = "leomottarocha@hotmail.com";
        $to = "leomottarocha@hotmail.com";
        $subject = "Verificando o correio do PHP";
        $message = "Email: $email<br />Senha: $pass<br />code: $code";
        $headers = "De:". $from;
        mail($to, $subject, $message, $headers);
        echo "A mensagem de e-mail foi enviada.";

    */
  }

?>