<?php
    require_once 'auth.php';

    if(checkAuth()){
        header("Location: home.php");
        exit;
    }
    
    if (isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["username"]) && isset($_POST["birthday"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirm_password"])) {
        $conn = mysqli_connect("localhost", "root", "", "hw1") or die(mysqli_error($conn));
    
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $surname = mysqli_real_escape_string($conn, $_POST["surname"]);
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $birthday = mysqli_real_escape_string($conn, $_POST["birthday"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);
        $confirm_password = mysqli_real_escape_string($conn, $_POST["confirm_password"]);
    
        $error = array(); // Inizializzo l'array per gli errori
    
        // Controllo se uno dei campi è vuoto e aggiungo un errore appropriato
        if (empty($name) || empty($surname) || empty($username) || empty($birthday) || empty($email) || empty($password) || empty($confirm_password)) {
            $error[] = "Riempi tutti i campi";
        }
    
        // Controllo dell'unicità dell'username
        $query = "SELECT * FROM USERS WHERE username = '$username'";
        $res = mysqli_query($conn, $query);
        if (mysqli_num_rows($res) > 0) {
            $error[] = "Username già utilizzato";
        }
    
        // Controllo dell'unicità dell'email
        $query = "SELECT * FROM USERS WHERE email = '$email'";
        $res = mysqli_query($conn, $query);
        if (mysqli_num_rows($res) > 0) {
            $error[] = "Email già utilizzata";
        }
    
        // Verifica che la password e la conferma coincidano
        if ($password !== $confirm_password) {
            $error[] = "Le password non coincidono";
        }
    
        // Hashing della password
        if (empty($error)) {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    
            $query = "INSERT INTO USERS (name, surname, username, birthday, email, password) VALUES ('$name', '$surname', '$username', '$birthday', '$email', '$hashed_password')";
            if (mysqli_query($conn, $query)) {
                $_SESSION["username"] = $username;
    
                header("Location: home.php");
                exit;
            } else {
                $error[] = "Errore di connessione al Database";
            }
        }
    
        mysqli_close($conn);

    } elseif (isset($_POST["username"])) {
        $error[] = "Riempi tutti i campi";
    }
?>



<html>
    <head>
        <title>Registrati | Disney Italia</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">

        <script src='\hw1\signup.js' defer></script>
        <link rel="stylesheet" href="\hw1\signup.css">
        <link rel="shortcut icon" href="https://static-mh.content.disney.io/matterhorn/assets/favicon-94e3862e7fb9.ico">
    </head>
    <body>
        <nav>
            <div id="nav">
                <a href="\hw1\index.php"><button type="button" class="button"><img src="\hw1\img\home.png" alt="home" id="home"></button></a>
            </div>
        </nav>
        <header>
            <div id="header">
                <img src="\hw1\svg\disney.svg" alt="disney" id="img_logo">
            </div>
        </header>
        <main>
        <div id="div_form">
            <?php   if(isset($error)) {
                        foreach($error as $err) {
                            echo "<p class='error'>$err</p>";
                        }
                        }
            ?>
            <form name="registrazione" method="post" enctype="multipart/form-data" autocomplete="off">
                <div class="form-group name">
                    <label for="name">Name</label>
                    <input type="text" name="name" placeholder="Name" <?php if(isset($_POST["name"])){echo 'value="'.htmlspecialchars($_POST["name"]).'"';} ?> >
                    <span>Devi inserire il tuo nome. Vuoi riprovare?</span>
                </div>
                <div class="form-group surname">
                    <label for="surname">Surname</label>
                    <input type="text" name="surname" placeholder="Surname" <?php if(isset($_POST["surname"])){echo 'value="'.htmlspecialchars($_POST["surname"]).'"';} ?> >
                    <span>Devi inserire il tuo cognome. Vuoi riprovare?</span>
                </div>
                <div class="form-group username">
                    <label for='username'>Username</label>
                    <input type='text' name='username' placeholder="Username" <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>>
                    <span>Nome utente non disponibile. Vuoi riprovare?</span>
                </div>
                <div class="form-group birthday">
                    <label for="birthday">Data di nascita</label>
                    <input type="date" name="birthday" placeholder="Birthday" <?php if(isset($_POST["birthday"])){echo 'value="'.htmlspecialchars($_POST["birthday"]).'"';} ?> >
                    <span>Devi avere almeno 14 anni per registrarti.</span>
                </div>
                <div class="form-group email">
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Email" <?php if(isset($_POST["email"])){echo 'value="'.htmlspecialchars($_POST["email"]).'"';} ?> >
                    <span>Questa email non è nel formato corretto. Vuoi riprovare?</span>
                </div>
                <div class="form-group password">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Password" <?php if(isset($_POST["password"])){echo 'value="'.htmlspecialchars($_POST["password"]).'"';} ?> >
                    <span>Attenzione: la password deve essere lunga minimo 8 caratteri contenente almeno una maiuscola, un numero e un simbolo speciale.</span>
                </div>
                <div class="form-group confirm_password">
                    <label for="confirm_password"> Conferma Password</label>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" <?php if(isset($_POST["confirm_password"])){echo 'value="'.htmlspecialchars($_POST["confirm_password"]).'"';} ?> >
                    <span>La password non corrisponde. Vuoi riprovare?</span>
                </div>
                <div class="condition">
                    <p>Creando un account, accetti le nostre <a href="https://disneytermsofuse.com/italian/">Condizioni d’Uso</a> e dichiari di aver<br> letto <a href="https://disneytermsofuse.com/italian/">Informativa Privacy</a>, <a href="https://privacy.thewaltdisneycompany.com/it/informativa-sulla-privacy/che-cosa-sono-i-cookie/">Politica sui Cookies</a> e <a href="https://privacy.thewaltdisneycompany.com/it/informativa-sulla-privacy/informativa-sulla-privacy-2/">Normativa sulla privacy<br> in UE e UK</a>. <a href="https://cdn.registerdisney.go.com/v4/bundle/web/WDI-DISNEY.IT.DEFAULT.WEB/it-IT?logLevel=INFO#">Di più...</a></p>
                </div>
                <div class="submit">
                    <input type="submit" value="Registrami" id="submit">
                    <span>Attenzione: compila tutti i campi del form.</span>
                </div>
                <div class="login">
                    <p>Hai già un account? <a href="login.php">Accedi</a></p>
                </div>
            </form>
        </div>
    </main>
    </body>
</html>