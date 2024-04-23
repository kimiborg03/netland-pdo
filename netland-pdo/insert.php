<?php

session_start();
include('dbconn.php');
if (!isset($_SESSION['loggedInUser'])) {
    header("Location: login.php");
    
    exit();
}

include("dbconn.php");
$updated = false;
if (isset($_POST) && !empty($_POST['submit'])) {
    $title = $_POST['title'];
    $type = $_POST['type'];
    $rating = $_POST['rating'];
    $length_in_minutes = $_POST['length_in_minutes'];
    $released_at = $_POST['released_at'];
    $summary = $_POST['summary'];
    $youtube_trailer_id = $_POST['youtube_trailer_id'];
    $has_won_awards = $_POST['has_won_awards'];
    $seasons = $_POST['seasons'];
    $country = $_POST['country'];
    $spoken_in_language = $_POST['spoken_in_language'];
    try {
        $query = $pdo->query(
            'INSERT INTO media (title, type, rating, length_in_minutes, released_at, summary, youtube_trailer_id, has_won_awards, seasons, country, spoken_in_language)
        VALUES ("' . $title . '", "' . $type . '", "' . $rating . '", "' . $length_in_minutes . '", "' . $released_at . '",
         "' . $summary . '", "' . $youtube_trailer_id . '", "' . $has_won_awards . '", "' . $seasons . '", "' . $country . '", "' . $spoken_in_language . '")'
        );
        $row = $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit();
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <title>Nieuwe Film of serie</title>
</head>

<body>
    <button>
        <a href="index.php">Home</a>
    </button>
    <h2>
        Nieuwe film of serie
    </h2>
    <form method="POST">
        <table>
            <tr>
                <td>Title</td>
                <td><input name="title" type="text"></td>
            </tr>
            <tr>
                <td>Datum van uitkomst</td>
                <td><input type="date" name="released_at"></td>
            </tr>
            <tr>
                <td>Duur in minuten</td>
                <td>
                    <input name="length_in_minutes" type="number">
                </td>
            </tr>
            <tr>
                <td>Youtube trailer id</td>
                <td>
                    <input name="youtube_trailer_id" type="text">
                </td>
            </tr>
            <tr>
                <td>rating</td>
                <td>
                    <input name="rating" type="text">
                </td>
            </tr>
            <tr>
                <td>awards</td>
                <td>
                    <input name="has_won_awards" type="text">
                </td>
            </tr>
            <tr>
                <td>seasons</td>
                <td>
                    <input name="seasons" type="text">
                </td>
            </tr>
            <tr>
                <td>Land</td>
                <td>
                    <input name="country" type="text">
                </td>
            </tr>
            <tr>
                <td>Gesproken taal</td>
                <td>
                    <input name="spoken_in_language" type="text">
                </td>
            </tr>
            <tr>
                <td>Beschrijving</td>
                <td><input type="text" name="summary"></td>
            </tr>
            <tr>
                <td>Type series of movie</td>
                <td><input type="text" name="type"></td>
            </tr>
        </table>
        <input name="submit" value="Toevoegen" type="submit">
    </form>

</body>

</html>