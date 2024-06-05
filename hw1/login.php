<?php
    include 'auth.php';
    if (checkAuth()) {
        header('Location: home.php');
        exit;
    }

if (isset($_POST["username"]) && isset($_POST["password"])) {
    // Connetti al database
    $conn = mysqli_connect("localhost", "root", "", "hw1") or die(mysqli_error($conn));

    // Escape dell'input
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    
    // Cerca utenti con quel username
    $query = "SELECT * FROM users WHERE username = '$username'";
    
    // Esegui la query
    $result = mysqli_query($conn, $query);

    // Verifica se la query ha avuto successo
    if ($result) {
        // Verifica se è stato trovato un utente con l'username specificato
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // Verifica la correttezza della password
            if (password_verify($_POST["password"], $row['password'])) {
                // Imposta la variabile di sessione
                $_SESSION["username"] = $username;

                // Reindirizza alla home
                header("Location: home.php");
                exit;
            }
        }
        $error = "Accesso non riuscito. Controlla l'username o la password e riprova";
    }
    // Chiudi la connessione al database
    mysqli_close($conn);
}
?>



<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        
        <title>Login | Disney Italia</title>

        <script src='\hw1\login.js' defer></script>
        <link rel='stylesheet' href='login.css'>
        <link rel="shortcut icon" href="https://static-mh.content.disney.io/matterhorn/assets/favicon-94e3862e7fb9.ico">
    </head>
    <body>
        <nav>
            <div id="nav">
                <a href="index.php"><button type="button" class="button"><img src="\hw1\img\home.png" alt="home" id="home"></button></a>
            </div>
        </nav>
        <header>
            <div id="header">
                <img src="\hw1\svg\disney.svg" alt="disney" id="img_logo">
            </div>
        </header>
        <main>
            <div id="div_form">
                <?php
                    if (isset($error)) {
                        echo "<p class='error'>$error</p>";
                    }
                ?>
                <form name="login" method="post">
                    <div class="h">    
                        <h2>Per continuare, accedi a Disney.</h3>
                    </div>
                    <div class="form-group username">
                        <label for='username'>Username</label>
                        <input type='text' name='username' placeholder="Username" <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>>
                    </div>
                    <div class="form-group password">
                        <label for="password">Password</label>
                        <input type="password" name="password" placeholder="Password" <?php if(isset($_POST["password"])){echo 'value="'.htmlspecialchars($_POST["password"]).'"';} ?> >
                    </div>
                    <div class="submit">
                        <input type="submit" value="Continua" id="submit">
                    </div>
                    <div class="signup">
                        <p>Non hai un account? <a href="signup.php">Iscriviti</a></p>
                    </div>
                </form>
            </div>
        </main>
    </body>
</html>