<?php

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

if( $_POST['token'] != "" && $_POST['token'] != null && $_POST['id'] != "" && $_POST['id'] != null){

    $token = $_POST['token'];
    
    $identifiant = $_POST['id'];
    
    $query = $con->prepare("SELECT token FROM FastAndVTT WHERE numEtu = :numEtu");
    
    $query->bindParam(':numEtu', $identifiant);
    
    $query->execute();
    
    $data = $query->fetch();
    
    if ( $data['token'] == $token ) {
    	die('success');
    } else {
      die('error');
  }
}

    //Close connection
$query = null;
$con = null;

?>