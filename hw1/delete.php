<?php
// Includi il file di configurazione del database
require_once 'dbconfig.php';

// Avvia la sessione
session_start();

require_once 'auth.php';
if (!$username = checkAuth()) {
    header("Location: login.php");
    exit;
}

// Connessione al database
$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
if (!$conn) {
    die("Connessione al database fallita: " . mysqli_connect_error());
}

// Ottieni l'ID dell'utente loggato
$username = $_SESSION['username'];

// Query per eliminare l'account
$query = "DELETE FROM users WHERE username = '$username'";

// Esegui la query
if (mysqli_query($conn, $query)) {
    // Account eliminato con successo, reindirizza all'homepage o ad una pagina di conferma
    session_destroy(); // Cancella tutte le variabili di sessione
    header("Location: index.php?deleted=true"); // Puoi aggiungere un parametro per indicare il successo
    exit;
} else {
    // Errore durante l'eliminazione dell'account
    echo "Errore durante l'eliminazione dell'account: " . mysqli_error($conn);
}

// Chiudi la connessione al database
mysqli_close($conn);
?>
