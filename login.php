<?php
  require "db.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page de connexion</title>
</head>
<body>
  <main>
    <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $sql = Mysql::getInstance()->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $result = $sql->execute([$username, sha1($password)]);;
        if ($result) {
          $user = $sql->fetch(PDO::FETCH_ASSOC);
          if ($user) {
            echo "Connexion réussie !";
          } else {
            echo "Veuillez vérifier vos identifiants !";
          }
        } else {
          echo "Erreur lors de l'exécution de la requête !";
        }
      }
    ?>
    <form method="POST">
      <input type="text" name="username" placeholder="Nom d'utilisateur">
      <input type="password" name="password" placeholder="Mot de passe">
      <button type="submit">Connexion</button>
    </form>
</body>
</html>