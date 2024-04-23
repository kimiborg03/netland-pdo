<?php

session_start();
include('dbconn.php');
if (!isset($_SESSION['loggedInUser'])) {
    header("Location: login.php");
    exit();
}

include('dbconn.php');
?>
<?php
if (isset($_POST['update_btn'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $type = $_POST['type'];
    $rating = $_POST['rating'];
    $length_in_minutes = $_POST['length_in_minutes'];
    $released_at = $_POST['released_at'];
    $youtube_trailer_id = $_POST['youtube_trailer_id'];
    $awards = $_POST['awards'];
    $seasons = $_POST['seasons'];
    $country = $_POST['country'];
    $spoken_in_language = $_POST['spoken_in_language'];
    $summary = $_POST['summary'];
    try {
        $query =
            "UPDATE media SET title=:title, type=:type, title=:title, rating=:rating, length_in_minutes=:length_in_minutes,
         released_at=:released_at, youtube_trailer_id=:youtube_trailer_id, has_won_awards=:has_won_awards,
        seasons=:seasons, country=:country, summary=:summary
        WHERE id=:id LIMIT 1";
        $statement = $pdo->prepare($query);
        $data = [
            ":id" => $id,
            ":type" => $type,
            ":title" => $title,
            ":rating" => $rating,
            ":length_in_minutes" => $length_in_minutes,
            ":released_at" => $released_at,
            ":summary" => $summary,
            ":youtube_trailer_id" => $youtube_trailer_id,
            ":has_won_awards" => $awards,
            ":seasons" => $seasons,
            ":country" => $country,
            ":spoken_in_language" => $spoken_in_language
        ];
        $query_execute = $statement->execute($data);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <title>Detail pagina</title>
</head>

<body>
    <button>
        <a href="index.php">Home</a>
    </button>
    <h1>Detail pagina</h1>

    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM media WHERE id=:id LIMIT 1";
        $statement = $pdo->prepare($query);
        $data = [':id' => $id];
        $statement->execute($data);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
    }
    ?>
    <h1><?= $result['title']; ?> </h1>
    <table>
        <tr>
            <th>Information</th>
            <th>Information</th>
        </tr>
        <tr>
            <td>Rating</td>
            <td><?= $result['rating']; ?></td>
        </tr>
        <tr>
            <td>Awards</td>
            <td><?= $result['has_won_awards']; ?></td>
        </tr>
        <tr>
            <td>Seizoenen</td>
            <td><?= $result['seasons']; ?></td>
        </tr>
        <tr>
            <td>Land</td>
            <td><?= $result['country']; ?></td>
        </tr>
        <tr>
            <td>Gesproken taal</td>
            <td><?= $result['spoken_in_language']; ?></td>
        </tr>
        <tr>
            <td>Lengte in minuten</td>
            <td><?= $result['length_in_minutes']; ?></td>
        </tr>
        <tr>
            <td>Releasedatum</td>
            <td><?php echo $result['released_at']; ?></td>
        </tr>
        <tr>
            <td>Type media</td>
            <td><?php echo $result['type']; ?></td>
        </tr>
    </table>
    <h2>Summary</h2>
    <p>
        <?=
        $result['summary'];
        ?>
    </p>
    <?php
    $ytid = $result['youtube_trailer_id'];
    ?>
    <iframe src="http://www.youtube.com/embed/<?php echo $ytid ?>" frameborder="0" width="400" height="300"></iframe>
    <button>
        <a href="edit.php?id=<?= $_GET['id'] ?>">Edit pagina</a>
    </button>
</body>

</html>