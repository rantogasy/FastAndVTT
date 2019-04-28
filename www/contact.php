<?php

function isEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

    //Connection to MySQL
try
{
    $con = new PDO("mysql:host=" . 'dwarves.iut-fbleau.fr' . ";dbname=" . 'simona'.";charset=utf8",'simona','simona');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
}
catch (Exception $e)
{
    die('Error : ' . $e->getMessage());
}

    //Create variables
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$objet = $_POST['objet'];
$message = $_POST['message'];

  //SQL STATEMENTS
$sql=$con->prepare("INSERT INTO Contact(nom, prenom, email, objet, message) VALUES (:nom, :prenom, :email, :objet, :message)");
$sql->bindValue(":nom", $nom);
$sql->bindValue(":prenom", $prenom);
$sql->bindValue(":email", $email);
$sql->bindValue(":objet", $objet);
$sql->bindValue(":message", $message);


    //Make sure name is valid



    //Response
    //Checking to see if name or email already exsist


if(isset($_POST['email'])) {

    $email_to = "fastandvtt@gmail.com";
    $email_subject = "Mail FastAndVTT";

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if(!preg_match($email_exp,$email)) {
        $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
    }

    $email_message = "Détails de l'expéditeur\n\n";

    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
  }

  $email_message .= "Nom: ".clean_string($nom)."\n";
  $email_message .= "Prénom: ".clean_string($prenom)."\n";
  $email_message .= "Email: ".clean_string($email)."\n";
  $email_message .= "Objet: ".clean_string($objet)."\n";
  $email_message .= "Message: ".clean_string($message)."\n";


  if (isEmail($email)) {
      // create email headers
  $headers = 'From: '.$email."\r\n".
  'Reply-To: '.$email."\r\n" .
  'X-Mailer: PHP/' . phpversion();
  mail($email_to, $email_subject, $email_message, $headers);
  $sql->execute();
  echo "Merci beaucoup, votre message a bien été envoyé! ";
  } else {
    die("Le mail semble être une imposture...");
  }
}




    //Close connection
$con = null;
$sql = null;


?>