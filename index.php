<?php
// index.php
session_start();
require_once 'helper.php';

// ---------------------------------------------------------
// 1. Connexion à la Base de données (via PDO)
// ---------------------------------------------------------
$host = 'localhost';
$dbname = 'btsclic';
$user = 'root'; // À adapter selon ton environnement (XAMPP/WAMP/Laragon)
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

$message = '';

// ---------------------------------------------------------
// 2. Traitement des formulaires (sur la même page)
// ---------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Traitement : CRÉATION DE COMPTE
    if (isset($_POST['register'])) {
        $username = trim($_POST['username']);
        $password = $_POST['password'];

        // BONUS : Protéger les mots de passe en les hashant
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $stmt->execute([
                'username' => $username,
                'password' => $hashedPassword
            ]);
            $message = "Compte créé avec succès ! Vous pouvez maintenant vous connecter.";
        } catch (PDOException $e) {
            $message = "Erreur : Ce nom d'utilisateur est peut-être déjà pris.";
        }
    }

    // Traitement : CONNEXION
    if (isset($_POST['login'])) {
        $username = trim($_POST['username']);
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $userDb = $stmt->fetch(PDO::FETCH_ASSOC);

        // BONUS : Vérification du mot de passe avec password_verify
        if ($userDb && password_verify($password, $userDb['password'])) {
            // Création de la session
            $_SESSION['user_id'] = $userDb['id'];
            $_SESSION['username'] = $userDb['username'];
            $message = "Connexion réussie.";
        } else {
            $message = "Identifiants incorrects.";
        }
    }

    // Déconnexion (pratique pour tester)
    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>BTSClic - Connexion et Utilisateurs</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .flex-container { display: flex; gap: 50px; }
        .form-box { border: 1px solid #ccc; padding: 20px; border-radius: 5px; }
        .msg { color: #d9534f; font-weight: bold; }
        .msg-success { color: #5cb85c; font-weight: bold; }
    </style>
</head>
<body>

    <h1>Bienvenue sur BTSClic</h1>

    <?php if (!empty($message)): ?>
        <p class="msg"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <?php if (check_auth()): ?>
        
        <p class="msg-success">Vous êtes connecté en tant que <?= htmlspecialchars($_SESSION['username']) ?>.</p>
        
        <form method="POST">
            <button type="submit" name="logout">Se déconnecter</button>
        </form>

        <hr>
        
        <h2>Liste des utilisateurs inscrits sur la plateforme :</h2>
        <ul>
            <?php
            $stmt = $pdo->query("SELECT username FROM users ORDER BY username ASC");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<li>" . htmlspecialchars($row['username']) . "</li>";
            }
            ?>
        </ul>

    <?php else: ?>
        
        <p>Veuillez vous identifier ou créer un compte pour parier contre les autres joueurs.</p>
        
        <div class="flex-container">
            <div class="form-box">
                <h2>Connexion</h2>
                <form method="POST">
                    <p>
                        <label for="login_user">Nom d'utilisateur :</label><br>
                        <input type="text" id="login_user" name="username" required>
                    </p>
                    <p>
                        <label for="login_pass">Mot de passe :</label><br>
                        <input type="password" id="login_pass" name="password" required>
                    </p>
                    <button type="submit" name="login">Se connecter</button>
                </form>
            </div>

            <div class="form-box">
                <h2>Création de compte</h2>
                <form method="POST">
                    <p>
                        <label for="reg_user">Nom d'utilisateur :</label><br>
                        <input type="text" id="reg_user" name="username" required>
                    </p>
                    <p>
                        <label for="reg_pass">Mot de passe :</label><br>
                        <input type="password" id="reg_pass" name="password" required>
                    </p>
                    <button type="submit" name="register">Créer mon compte</button>
                </form>
            </div>
        </div>

    <?php endif; ?>

</body>
</html>