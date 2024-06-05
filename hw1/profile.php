<?php 
    require_once 'auth.php';
    if (!$username = checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>

<html>
    <?php
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        $username = mysqli_real_escape_string($conn, $username);
        $query = "SELECT * FROM users WHERE username = '$username'";
        $res = mysqli_query($conn, $query);
        $userinfo = mysqli_fetch_assoc($res);   
    ?>

    <head>
        <title>Profilo | Disney Italia</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        
        <link rel="stylesheet" href="\hw1\profile.css">
        <link rel="shortcut icon" href="https://static-mh.content.disney.io/matterhorn/assets/favicon-94e3862e7fb9.ico">
    </head>

    <body>
        <nav>
            <div id="nav">
                <a href="home.php"><button type="button" class="button"><img src="\hw1\img\home.png" alt="home" id="home"></button></a>
            </div>
        </nav>
        <header>
            <div id="header">
                <img src="\hw1\svg\disney.svg" alt="disney" id="img_logo">
            </div>
        </header>
        <main>
            <div id="div_main">
                <div class="div_main_item">
                    <h1>L'accesso a Disney è gestito da MyDisney</h1>
                    <p class="raccomandazioni">Usa la stessa email e password per accedere alle esperienze e ai servizi offerti da tutte le aziende del Gruppo The Walt Disney Company.</p>
                </div>
                <div class="div_main_item">
                    <h2>Informazioni sull'account</h2>
                    <span>Email</span>
                    <?php echo "<p class='div_main_echo'>" . $userinfo["email"] . "</p>"; ?>
                    <div class="linea"></div>
                </div>
                <div class="div_main_item">
                    <span>Password</span>
                    <p class="div_main_echo">**********</p>
                    <div class="linea"></div>
                </div>
                <div class="div_main_item">
                    <h2>Informazioni personali</h2>
                    <div class="info_item">
                        <span>Nome</span>
                        <?php echo "<p>" . $userinfo["name"] . "</p>"; ?>
                    </div>
                    <div class="info_item">
                        <span>Cognome</span>
                        <?php echo "<p>" . $userinfo["surname"] . "</p>"; ?>
                    </div>
                    <div class="info_item">
                        <span>Data di nascita</span>
                        <?php echo "<p>" . $userinfo["birthday"] . "</p>"; ?>
                    </div>
                </div>
                <div class="div_main_item" id="elimina_account">
                    <h2>Elimina account</h2>
                    <p class="raccomandazioni">Eliminando il tuo account, potresti non essere in grado di accedere ad alcuni servizi Disney.</p>
                    <a href="delete.php">Elimina account</a>
                </div>
            </div>
        </main>
    </body>
</html>