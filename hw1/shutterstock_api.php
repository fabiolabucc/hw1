<?php
    header('Content-Type: application/json');

    if (!isset($_GET['image'])) {
        echo json_encode(['error' => 'Missing parameter: image']);
        exit;
    }

    $SHUTTERSTOCK_API_TOKEN = "v2/cFZMOE1MU2lBZHpmRklqSGlVSkRBc01SSWw3YWZRdTYvNDMwMDU1OTY1L2N1c3RvbWVyLzQvZ3pNS3laMVFUZEs0WXdLd0NDU2I5QlVHM2wxc25pUVQwY1dOYWJzRTZrUkY3dWhLNmgzUEZZRnRUMmZaTGthMUtFX2w2YW5GeDc1bmh1UVhOTWNzLVZmT0RRZU1IZVlMWUNUZzljQVpkX0VBdW1uUWg2OFJoT3FBdGVkMTRJRnh1d3RBRWJpSkh4R21EVEU1UUhyVUQwT19wSUU4eml6Nk1OV0liRlZqdnhSQXAzT0Z3YWhTY2lscjJyRXFybUxfMmdTVkZjUW1MVXU5WDNnYzhUNFF2US9OZjlOYUQzYVZldUoyT1c4UEhOM3pB";

    $query = $_GET['image'];

    $queryFields = [
        "query" => $query,
        "sort" => "popular",
        "orientation" => "horizontal"
    ];

    $options = [
        CURLOPT_URL => "https://api.shutterstock.com/v2/images/search?" . http_build_query($queryFields),
        CURLOPT_USERAGENT => "php/curl",
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer $SHUTTERSTOCK_API_TOKEN"
        ],
        CURLOPT_RETURNTRANSFER => 1
    ];

    $handle = curl_init();
    curl_setopt_array($handle, $options);
    $response = curl_exec($handle);
    curl_close($handle);

    $decodedResponse = json_decode($response);
    echo json_encode($decodedResponse);
?>
