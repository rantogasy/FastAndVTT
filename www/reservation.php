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

    //Create variables
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$numEtu = $_POST['numEtu'];
$mdp = $_POST['mdp'];
$mdpConfirmation = $_POST['mdpConfirmation'];

$query=$con->prepare("SELECT * FROM FastAndVTT WHERE NumEtu = $numEtu");
$query->execute();

$sql=$con->prepare("INSERT INTO FastAndVTT (Nom, Prenom, NumEtu, mdp) VALUES (:nom, :prenom, :numEtu, :mdp)");
$sql->bindValue(":nom", $nom);
$sql->bindValue(":prenom", $prenom);
$sql->bindValue(":numEtu", $numEtu);
$sql->bindValue(":mdp", $mdp);


    //Make sure name is valid
if(!preg_match("/^[a-zA-Z'-]+$/",$nom)) { 
    die ("Nom invalide");
}

if(!preg_match("/^[a-zA-Z'-]+$/",$prenom)) { 
    die ("Prenom invalide");
}

if (is_nan($numEtu)) {
    die("Numéro étudiant invalide");
} elseif (strlen($numEtu) != 9 ) {
    die("Votre numéro d'étudiant doit comporter 9 chiffres!");
}

if (strlen($mdp) < 6) {
    die("Mot de passe trop court, 6 caractères au minimum");
}

if ($mdp != $mdpConfirmation) {
    die("Mots de passe différents, veuillez entrer le même mot de passe");
}

    //Response
    //Checking to see if name or email already exsist
if($query->rowCount() > 0) {
    echo "Le numéro étudiant " . $_POST['numEtu'] . " existe déjà.";
}
else {
    $sql->execute();
    echo "Merci beaucoup, le numéro " . $_POST['numEtu'] . " correspondant à l'étudiant " .$_POST['prenom'] . " " . $_POST['nom'] . " a bien été ajouté";
}

    //Close connection
$query = null;
$sql = null;
$con = null;



?>