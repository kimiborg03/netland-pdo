<?php

session_start();
include('dbconn.php');
if (!isset($_SESSION['loggedInUser'])) {
    header("Location: login.php");
    exit();
}

include('dbconn.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <title>Edit pagina</title>
</head>

<body>
    <button>
        <a href="index.php">Home</a>
    </button>
    <h1>Edit Data</h1>
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = "SELECT * FROM media WHERE id=:id";
        $statement = $pdo->prepare($query);
        $data = [':id' => $id];
        $statement->execute($data);

        $result = $statement->fetch(PDO::FETCH_ASSOC);
    }
    ?>
    <form action="detail.php?id=<?= $_GET['id']; ?>" method="POST">
        <table>
            <tr>
                <th>Information</th>
                <th>Information</th>
            </tr>
            <tr>
                <td> <input type="hidden" name="id" value="<?= $result['id'] ?>"></td>
            </tr>
            <tr>
                <td> <label for="">Title</label></td>
                <td> <input type="text" name="title" value="<?= $result['title']; ?>"></td>
            </tr>
            <tr>
                <td> <label for="">Rating</label></td>
                <td> <input type="text" name="rating" value="<?= $result['rating']; ?>"></td>
            </tr>
            <tr>
                <td> <label for="">Awards</label></td>
                <td> <input type="text" name="awards" value="<?= $result['has_won_awards']; ?>"></td>
            </tr>
            <tr>
                <td><label for="">Releasedatum</label></td>
                <td> <input type="text" name="released_at" value="<?= $result['released_at']; ?>"></td>
            </tr>
            <tr>
                <td><label for="">Lengte in minuten</label></td>
                <td> <input type="text" name="length_in_minutes" value="<?= $result['length_in_minutes']; ?>"></td>

            </tr>
            <tr>
                <td><label for="">Gesproken taal</label></td>
                <td> <input type="text" name="spoken_in_language" value="<?= $result['spoken_in_language']; ?>"></td>

            </tr>
            <tr>
                <td> <label for="">youtube trailer id</label></td>
                <td><input type="text" name="youtube_trailer_id" value="<?= $result['youtube_trailer_id']; ?>"></td>
            </tr>
            <tr>
                <td> <label for="">Seizoenen</label></td>
                <td><input type="text" name="seasons" value="<?= $result['seasons']; ?>"></td>
            </tr>
            <tr>
                <td> <label for="">Land</label></td>
                <td><input type="text" name="country" value="<?= $result['country']; ?>"></td>
            </tr>
            <tr>
                <td> <label for="">omschrijving</label></td>
                <td><input type="text" name="summary" value="<?= $result['summary']; ?>"></td>
            </tr>
            <tr>
                <td> <label for="">Type</label></td>
                <td><input type="text" name="type" value="<?= $result['type']; ?>"></td>

            </tr>
        </table>
        <button class="btn-update" type="submit" name="update_btn">Update</button>
    </form>
</body>

</html>