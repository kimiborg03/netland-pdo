<?php

session_start();

include('dbconn.php');
if (!isset($_SESSION['loggedInUser'])) {
    header("Location: login.php");
    exit();
}

include('dbconn.php');

$stmtSeries = $pdo->query("SELECT * FROM media WHERE type = 'series'");
$stmtMovies = $pdo->query("SELECT * FROM media WHERE type = 'movie'");
$direction = "ASC";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <title>netland</title>
</head>

<body>
    <button>
        <a href="insert.php">film of serie Toevoegen</a>
    </button>
    <button>
        <a href="login.php">Inloggen</a>
    </button>
    <button>
        <a href="logout.php">Uitloggen</a>
    </button>

    <h1>Welkom op het netland beheerders paneel</h1>

    <h2>Series</h2>
    <table>
        <tr>
            <th>
                <a href="index.php?cat=series&orderby=title&direction=<?php echo $direction; ?>">Title</a>
            </th>
            <th>
                <a href="index.php?cat=series&orderby=rating&direction=<?php echo $direction; ?>">Rating</a>
            </th>
            <th>Details</th>
        </tr>
        <?php
        foreach ($stmtSeries as $row) {
            $str = http_build_query($row);
            echo "<tr data-ref='" . $row['id'] . "'>";
            echo "<td> {$row['title']} </td>";
            echo "<td> {$row['rating']} </td>";
            echo "<td> <a href='detail.php?$str'>Bekijk Details</a> </td>";
            echo "</tr>";
        }
        ?>
    </table>
    <h2>Films</h2>
    <table>
        <tr>
            <th>
                <a href="index.php?cat=movies&orderby=title&direction=<?php echo $direction ?>">Title</a>
            </th>
            <th>
                <a href="index.php?cat=movies&orderby=length_in_minutes&direction=<?php echo $direction ?>">Duur</a>
            </th>
            <th>Details</th>
        </tr>
        <?php
        foreach ($stmtMovies as $row) {
            $str = http_build_query($row);
            echo "<tr>";
            echo "<td> {$row['title']} </td>";
            echo "<td> {$row['length_in_minutes']} </td>";
            echo "<td> <a href='detail.php?$str'>Bekijk Details</a> </td>";
            echo "</tr>";
        }
        ?>
    </table>

</body>

</html>