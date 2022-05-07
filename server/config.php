
      
<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
  // permettre de se connecter a la base de données
  define('SERVER_NAME_01', 'localhost');
  define('USERNAME_02' ,'kaisens');
  define('PASSWORD_03','data2022');
  define('DB_NAME_04' , 'stock');
  //On établit la connexion
  $con = new mysqli(SERVER_NAME_01, USERNAME_02, PASSWORD_03,DB_NAME_04);
  //On vérifie la connexion
  if($con->connect_error){
      die('Erreur : ' .$con->connect_error); 
  }

?>