<?php

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


$identifiant = htmlspecialchars($_POST["identifiant"]);
$mdp = htmlspecialchars($_POST['mdp']);

$query = $con->prepare("SELECT nom, prenom, mdp FROM FastAndVTT WHERE numEtu = :numEtu");
$query->bindParam(':numEtu', $identifiant);
$query->execute();
$data=$query->fetch();

  //ERROR PASSWORD
if (!password_verify($_POST['mdp'], $data['mdp']) || $query->rowCount() != 1 )
{
	
  $to_return = [

      'status' => 'Error',
      'informations' => [ "message" => "identifiant ou mot de passe erroné"]
 ];


  $json = json_encode($to_return);

  die($json);
    
} else {
  
  $token = tokenize(40);
  
  $update = $con->prepare('UPDATE FastAndVTT SET token = :token WHERE NumEtu = :numEtu');
  
  $update->bindParam(':token', $token);
  
  $update->bindParam(':numEtu', $identifiant);
  $update->execute();
  
  $to_return = [
    
    'status' => 'Success',
    'informations' => [
      
      'lastname' => $data['nom'],
      'firstname' => $data['prenom'],
      'id' => $identifiant,
      'token' => $token
      
    ]
    
  ];
  
  $json = json_encode($to_return);
  
  die($json);
   
}

function tokenize($max) {
  $characters = str_split('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890', 1);
  
  $to_return = "";
  
  for ($i = 0; $i < $max; $i++){
    $random = rand(0, count($characters) - 1);
    $to_return = $to_return . $characters[$random];
  }
  
  return $to_return;
}


?>