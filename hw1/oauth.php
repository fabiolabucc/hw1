<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>

<html>
  <head>
    <meta charset="utf-8">
    <title>Image</title>
    <link rel="shortcut icon" href="https://static-mh.content.disney.io/matterhorn/assets/favicon-94e3862e7fb9.ico">
    <link rel="stylesheet" href="oauth.css">
    <script src="oauth.js" defer></script>
  </head>
  <body>
    <nav>
      <a href="home.php"><img src="img/disney.png" alt="Disney" class="img_disney a_nav"></a>
      <p>Cerca immagini a tema Disney!</p>
      <form>
        <input type="text" id="image" name="image" placeholder="Search...">
        <button type="submit" id="submit" value="Cerca"><img src="svg/lente.svg" id="lente"></button>
      </form>
    </nav>
    <section id="library-view"></section>
    <div class="error-hidden">
      <img src="img/ralph.png">
      <p>Nessun risultato trovato :(</p>
    </div>
  </body>
</html>
