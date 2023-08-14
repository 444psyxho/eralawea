<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Welcome to you WebApp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($user)): ?>
      <br> Bienvenid@ <?= $user['email']; ?>
      <br>Se ha logeado exitosamente
      <a href="logout.php">
        Cerrar Session
      </a>, 
      <a href="pagina.php">
        Ingresar a la pagina
      </a>
    <?php else: ?>
      <h1>Iniciar Session o Registrarse</h1>

      <a href="login.php">Iniciar Session</a> or
      <a href="signup.php">Registrarse</a>
    <?php endif; ?>
  </body>
</html>