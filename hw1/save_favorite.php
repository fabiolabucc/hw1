<?php
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));


    // Verifica la connessione
    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    // Ottieni i dati inviati tramite POST
    $userid = mysqli_real_escape_string($conn, $userid);
    $imgUrl = mysqli_real_escape_string($conn, $_POST['imgUrl']);
    $link = mysqli_real_escape_string($conn, $_POST['link']);
    $link_text = mysqli_real_escape_string($conn, $_POST['linkText']);
    $action = $_POST['action']; // "add" o "remove"

    if ($action == 'add') {
        $query = "INSERT INTO favorites (user, imgUrl, link, linkText) VALUES ('$userid', '$imgUrl', '$link', '$linkText')";
    } elseif ($action == 'remove') {
        $query = "DELETE FROM favorites WHERE imgUrl = '$imgUrl'";
    }

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo json_encode(['success' => 'Film saved successfully']);
    } else {
        echo json_encode(['error' => 'Error saving film']);
    }

    $conn->close();

    header('Content-Type: application/json');
?>
