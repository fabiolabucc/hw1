<?php
/*
    require_once 'auth.php';
    if (!$username = checkAuth()) {
        header("Location: login.php");
        exit;
    }

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

    $userId = $_SESSION["id"];
    $filmId = $_GET["id"]; 

    $query = "INSERT INTO favorites (user, film) VALUES ('$userId', '$filmId')";
    $res = mysqli_query($conn, $query);

    if($res){
        echo json_encode(['success' => 'Film saved successfully']);
    }
    else{
        echo json_encode(['error' => 'Error saving film']);
    }
*/

/*
require_once 'auth.php';
if (!$userId = checkAuth()) {
    header("Location: login.php");
    exit;
}

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

$userId = mysqli_real_escape_string($conn, $userId);
$filmId = $_GET["id"];

// Controlla se il film è già nei preferiti
$query = "
    SELECT f.*
    FROM favorites f
    JOIN users u ON f.user = u.id
    JOIN film fi ON f.film = fi.id
    WHERE f.user='$userId' AND f.film='$filmId'";
$res = mysqli_query($conn, $query);

if (mysqli_num_rows($res) > 0) {
    // Rimuove il film dai preferiti
    $query = "
        DELETE f 
        FROM favorites f
        JOIN users u ON f.user = u.id
        JOIN film fi ON f.film = fi.id
        WHERE f.user='$userId' AND f.film='$filmId'";
    $res = mysqli_query($conn, $query);

    if ($res) {
        echo json_encode(['success' => true, 'message' => 'Film removed from favorites']);
    } else {
        echo json_encode(['success' => false, 'error' => 'Error removing film from favorites']);
    }
} else {
    // Aggiunge il film ai preferiti
$query = "
INSERT INTO favorites (user, film)
SELECT u.id, fi.id
FROM users u, film fi
WHERE u.id='$userId' AND fi.id='$filmId'";
$res = mysqli_query($conn, $query);

if ($res && mysqli_affected_rows($conn) > 0) {
echo json_encode(['success' => true, 'message' => 'Film saved to favorites']);
} else {
echo json_encode(['success' => false, 'error' => 'Error saving film to favorites']);
}

}

mysqli_close($conn);
*/
require_once 'auth.php';
if (!$username = checkAuth()) {
    header("Location: login.php");
    exit;
}

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));


if(isset($_SESSION["id"]) && isset($_SESSION["email"])){
    $userId = $_SESSION["id"];
    $query = "SELECT * FROM film f JOIN favorites fav ON f.id = fav.film WHERE fav.user = $userId";
    $result = mysqli_query($conn, $query);

    if($result) {
        if(mysqli_num_rows($result) > 0) {
            $films = array();

            while($row = mysqli_fetch_assoc($result)) {
                // Estrai l'immagine come BLOB e convertila in una stringa base64
                $img = base64_encode($row['img']);

                // Rimuovi l'immagine BLOB dal risultato per evitare la duplicazione dei dati
                unset($row['img']);

                // Aggiungi l'immagine come stringa base64 ai dati del film
                $row['img'] = $img;

                // Aggiungi il film al vettore dei film
                $films[] = $row;
            }

            // Imposta l'intestazione della risposta come JSON
            header('Content-Type: application/json');
            // Restituisci i dati dei film come JSON
            echo json_encode($films);
        } else {
            echo json_encode(['error' => 'Nessun film trovato nei preferiti']);
        }
    } else {
        // Gestione degli errori della query
        echo json_encode(['error' => 'Errore nella query: ' . mysqli_error($conn)]);
    }
} else {
    // Utente non autenticato
    echo json_encode(['error' => 'Errore: utente non autenticato']);
}

?>