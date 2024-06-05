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
    <title>History</title>
    <link rel="stylesheet" href="\hw1\history.css">
    <script src="\hw1\history.js" defer></script>
  </head>
  <body>
    <nav>
      <a href="\hw1\home.php"><img src="img/disney.png" alt="Disney" class="img_disney a_nav"></a>
      <p>Cerca i personaggi della Disney tra la tua cronologia!</p>
    </nav>
    <form>
      <input type='text' name='character' id='character' placeholder="Search...">
      <button type='submit'>Search</button>
    </form>
    <section id="library-view">
    </section>
    <div class="error-hidden" style="display: none;">
      <img src="img/ralph.png">
      <p>No results found :(</p>
    </div>
  </body>
</html>
