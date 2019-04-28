<?php
session_start();
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
   
  // $user_check = $_SESSION['identifiant'];
   

   $query=$con->prepare("SELECT NumEtu FROM FastAndVTT WHERE NumEtu = :NumEtu");
   $query->bindParam(':NumEtu', $user_check);
   $query->execute();
   
   $data = $query->fetch();
   
   $login_session = $data['NumEtu'];
   
 /*  if(!isset($user_check){
     // header("location:login.php");
      die();
   }*/

   echo $login_session;
?>