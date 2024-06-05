<?php
    include 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }

    header('Content-Type: application/json');

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $userid = mysqli_real_escape_string($conn, $userid);

    $character = $conn->real_escape_string($_GET['character']);

    $query = "SELECT * FROM character_search WHERE user = $userid AND name LIKE '%character%' ORDER BY id";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $characterArray = array();
    while ($entry = mysqli_fetch_assoc($res)) {
        $characterArray[] = array(
            'userid' => $entry['user_id'],
            'characterid' => $entry['id'],
            'content' => json_decode($entry['content'])
        );
    }

    echo json_encode($characterArray);

    mysqli_close($conn);
?>
