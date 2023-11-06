<?php 

$dbHost = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "parcinformatiquepcgsa";

try {
  $dsn = "mysql:host=" . $dbHost . ";dbname=" . $dbName;
  $pdo = new PDO($dsn, $dbUser, $dbPassword);
} catch(PDOException $e) {
  echo "Erreur de la Connection à la base de donnée: " . $e->getMessage();
}


$status = "";
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $Nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $serviceoufonction = $_POST['serviceoufonction'];

  if(empty($Nom) || empty($prenom) || empty($serviceoufonction)) {
    $status = "All fields are compulsory.";
  } else {
    if(strlen($Nom) >= 255 || !preg_match("/^[a-zA-Z-'\s]+$/", $Nom)) {
      $status = "Please enter a valid name";
    } else {

      $sql = "INSERT INTO utilisateurs (nom, prenom, serviceoufonction) VALUES (:nom, :prenom, :serviceoufonction)";
      
      $stmt = $pdo->prepare($sql);
      
      $stmt->execute(['nom' => $Nom, 'prenom' => $prenom, 'serviceoufonction' => $serviceoufonction]);

      $status = "Enregistrement effectuer avec succès";
      $Nom = "";
      $prenom = "";
      $service = "";
    }
  }

}


?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parc informatique PCGSA</title>
    <!-- L'icon du titre -->
    <link rel="shortcut icon" href="../images/logoPCGSA.png">

    <!-- Le lien bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/styles.css">

</head>
<body>
    <nav class="cc-navbar navbar position-fixed navbar-expand-lg navbar-dark w-100 ">
        <div class="container-fluid">
          <a class="navbar-brand text-uppercase fw-bold mx-4 py-3" href="#">espace utilisateur</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
          data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
          aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item pe-4">
                <a class="nav-link" target="_blank" href="departement.php">Departements</a>
              </li>
              <li class="nav-item pe-4">
                <a class="nav-link active"  aria-current="page" href="utilisateur.php">Utilisateurs</a>
              </li>
              <li class="nav-item pe-4">
                <a class="nav-link" target="_blank" href="machine.php">Machine</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <section class="banner pt-5">
      <div class="container">
          <div class="card m-lg-5 p-lg-5">
            <form action="" method="post">
              <h2 class="text-center">Nouveau utilisateur</h2>
              <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom">
              </div>
              <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom">
              </div>
              <div class="mb-3">
                <label for="serviceoufonction" class="form-label">Service ou fonction</label>
                <input type="text"  class="form-control" id="serviceoufonction" name="serviceoufonction">
              </div>
              <button type="submit" class="btn btn-primary">Valider</button>
            </form>
          </div>
         </div>
      </div>
    </section>

    <!-- Formulaire d'inscription -->

   
 

    <!-- Le lien vers Javascript -->
<script>
    src="assets/js/bootstrap.bundle.min.js"
</script>
</body>
</html>