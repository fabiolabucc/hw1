<?php
require_once 'auth.php';
if (!$userid = checkAuth()) {
    header("Location: login.php");
    exit;
}

/*$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

$characters = $_POST['characters'];

foreach ($characters as $character) {
    $name = $conn->real_escape_string($character['name']);
    $imageUrl = $conn->real_escape_string($character['imageUrl']);
    $films = $conn->real_escape_string($character['films']);
    $tvShows = $conn->real_escape_string($character['tvShows']);
    $videoGames = $conn->real_escape_string($character['videoGames']);
    $parkAttractions = $conn->real_escape_string($character['parkAttractions']);

    echo "Name: $name\n";
    echo "ImageUrl: $imageUrl\n";
    echo "Films: $films\n";
    echo "TvShows: $tvShows\n";
    echo "VideoGames: $videoGames\n";
    echo "ParkAttractions: $parkAttractions\n";

    $checkQuery = "SELECT * FROM character_search WHERE name = '$name' AND user = '$userid'";
    $checkResult = mysqli_query($conn, $checkQuery) or die(mysqli_error($conn));

    if (mysqli_num_rows($checkResult) > 0) {
        echo json_encode(['error' => 'Character already exists']);
    } else {
        $sql = "INSERT INTO character_search (user, name, imageUrl, films, tvShows, videoGames, parkAttractions) VALUES ('$userid', '$name', '$imageUrl', '$films', '$tvShows', '$videoGames', '$parkAttractions')";
        echo "SQL: $sql\n";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo json_encode(['success' => 'Character saved successfully']);
        } else {
            echo json_encode(['error' => 'Error saving character']);
        }
    }
}

$conn->close();*/

saveCharacters();

function saveCharacters() {
    global $dbconfig, $userid;

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

    $characters = $_POST['characters'];

    foreach ($characters as $character) {
        $name = mysqli_real_escape_string($conn, $character['name']);
        $imageUrl = mysqli_real_escape_string($conn, $character['imageUrl']);
        $films = mysqli_real_escape_string($conn, $character['films']);
        $tvShows = mysqli_real_escape_string($conn, $character['tvShows']);
        $videoGames = mysqli_real_escape_string($conn, $character['videoGames']);
        $parkAttractions = mysqli_real_escape_string($conn, $character['parkAttractions']);

        # check if character is already present for user
        $query = "SELECT * FROM character_search WHERE user = '$userid' AND name = '$name'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        # if character is already present, do nothing
        if(mysqli_num_rows($res) > 0) {
            echo json_encode(array('ok' => true));
            continue;
        }

        echo 

        $query = "INSERT INTO character_search (user, name, imageUrl, films, tvShows, videoGames, parkAttractions) VALUES ('$userid', '$name', '$imageUrl', '$films', '$tvShows', '$videoGames', '$parkAttractions')";
        error_log($query);
        if(mysqli_query($conn, $query) or die(mysqli_error($conn))) {
            echo json_encode(array('ok' => true));
            continue;
        }

    }

    mysqli_close($conn);
    echo json_encode(array('ok' => false));
}

?>

