<?php 

$dbHost = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "parcinformatiquepcgsa";

try {
  $dsn = "mysql:host=" . $dbHost . ";dbname=" . $dbName;
  $pdo = new PDO($dsn, $dbUser, $dbPassword);
} catch(PDOException $e) {
  echo "DB Connection Failed: " . $e->getMessage();
}


$status = "";
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $typemachine = $_POST['typemachine'];
  $marque = $_POST['marque'];
  $modele = $_POST['modele'];
  $caracteristique = $_POST['caracteristique'];
   

  if(empty($typemachine) || empty($marque) || empty($modele) || empty($caracteristique)) {
    $status = "All fields are compulsory.";
  } else {
    if(strlen($typemachine) >= 255 || !preg_match("/^[a-zA-Z-'\s]+$/", $typemachine)) {
      $status = "Please enter a valid name";
    } else {

      $sql = "INSERT INTO machine (typemachine, marque, modele, caracteristique) VALUES (:typemachine, :marque, :modele, :caracteristique)";

      $stmt = $pdo->prepare($sql);
      
      $stmt->execute(['typemachine' => $typemachine, 'marque' => $marque, 'modele' => $modele, 'caracteristique' => $caracteristique]);

      $status = "Enregistrement effectuer avec succès";
      $typemachine = "";
      $marque = "";
      $modele = "";
      $caracteristique = "";
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
          <a class="navbar-brand text-uppercase fw-bold mx-4 py-3" href="#">les machines du parc informatique</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
          data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
          aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item pe-4">
                <a class="nav-link" aria-current="page" href="departement.php">Departements</a>
              </li>
              <li class="nav-item pe-4">
                <a class="nav-link" target="_blank" href="utilisateur.php">Utilisateurs</a>
              </li>
              <li class="nav-item pe-4">
                <a class="nav-link active" aria-current="page" href="machine.php">Machine</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <section class="banner pt-5">
        <div class="container">
            <div class="card m-lg-5 p-lg-5">
              <form action="" method="post">  
                <h2 class="text-center">Nouvelle machine</h2>
                <label for="type" class="form-label">Type de la machine</label>             
                <select class="form-select" aria-label="Default select example" name="typemachine">
                  <option selected>Bureautique</option>
                  <option value="Laptop">Laptop</option>
                  <option value="Imprimante">Imprimante</option>
                </select>
                <label for="marque" class="form-label">Marque</label>             
                <select class="form-select" name="marque" aria-label="Default select example">
                  <option value="Dell">Dell</option>
                  <option value="HP">HP</option>
                  <option value="Lenovo">Lenovo</option>
                  <option value="canon imageRunner2206N">canon imageRunner2206N</option>
                  <option value="Canon">Canon</option>
                  <option value="Toshiba">Toshiba</option>
                </select>
                
                <div class="mb-3">
                  <label for="modele" class="form-label">Modele</label>
                  <input type="text" class="form-control" id="modele" name="modele">
                </div>
                <div class="mb-3">
                  <label for="caracteristique" class="form-label">Caractéristique</label>
                  <input type="text" class="form-control" id="caracteristique" name="caracteristique">
                </div>
                <button type="submit" class="btn btn-primary">Valider</button>
              </form>
            </div>
           </div>
        </div>
    </section>

  

    <!-- Le lien vers Javascript -->
<script>
    src="assets/js/bootstrap.bundle.min.js"
</script>
</body>
</html>