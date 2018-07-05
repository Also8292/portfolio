<?php
  // connexion a la base de données
  try {
    $connexion = new PDO('mysql:host=localhost;dbname=site1;charset=utf8','root','');
  }
  catch (Exception $e) {
    die('Erreur : '.$e->getMessage());
  }

  $user_insert = 'INSERT INTO utilisateurs(mail, nom) VALUES (?, ?)';
  $message_insert = 'INSERT INTO messages(contenu, mail, date_message) VALUES (?, ?, NOW())';

  // recuperation des valeurs entrées dans le formulaire
  $input_name = htmlspecialchars($_POST['name']);
  $input_mail = htmlspecialchars($_POST['mail']);
  $message = htmlspecialchars($_POST['message']);

  $request_user_insert = $connexion->prepare($user_insert);
  $request_message_insert = $connexion->prepare($message_insert);

  // execution des requetes d'insertion
  $request_user_insert->execute(array($input_mail, $input_name));
  $request_message_insert->execute(array($message, $input_mail));

  // redirection a la page principale
  header('Location: index.php');
 ?>
