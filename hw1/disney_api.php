<?php
    // Imposta l'header della risposta
    header('Content-Type: application/json');

    // Verifica che il parametro 'name' sia stato passato
    if (!isset($_GET['name'])) {
        echo json_encode(['error' => 'Missing parameter: name']);
        exit;
    }

    $name = urlencode($_GET['name']);

    // Imposta l'URL dell'API
    $url = 'https://api.disneyapi.dev/character?name=' . $name;

    // Inizializza cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // Esegui la richiesta
    $response = curl_exec($ch);

    // Chiudi cURL
    curl_close($ch);

    // Ritorna la risposta
    echo $response;
?>
