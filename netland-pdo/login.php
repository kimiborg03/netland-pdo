<?php

include('dbconn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT id FROM gebruikers WHERE username = ? AND password = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$username, $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        session_start();
        $_SESSION['loggedInUser'] = $user['id'];
        header("Location: index.php");
        exit();
    } else {
        $error = "Ongeldige gebruikersnaam of wachtwoord";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
</head>

<body>
    <button>
        <a href="index.php">Home</a>
    </button>
    <h1>Netland Admin Panel</h1>
    <form method="POST" action="">
        <label for="username">Gebruikersnaam:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Wachtwoord:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Inloggen</button>
    </form>

    <?php if (isset($error)) : ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>

</body>

</html>