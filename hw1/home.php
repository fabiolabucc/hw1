<?php 
    require_once 'auth.php';
    if (!$username = checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>

<html>

  <?php

    // Carico le informazioni dell'utente loggato per visualizzarle nella sidebar (mobile)
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    $username = mysqli_real_escape_string($conn, $username);
    $query = "SELECT * FROM users WHERE username = '$username'";
    $res = mysqli_query($conn, $query);
    $userinfo = mysqli_fetch_assoc($res);   
  ?>

<head>
        <meta charset="utf-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Disney.it</title>
        <link rel="stylesheet" href="\hw1\home.css">
        <script src="\hw1\home.js" defer></script>

        <link rel="shortcut icon" href="https://static-mh.content.disney.io/matterhorn/assets/favicon-94e3862e7fb9.ico">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
    </head>
    <body>
        <nav>
            <div id="link_nav1">
            <a href="\hw1\home.php"><img src="\hw1\img\disney.png" alt="Disney" class="img_disney a_nav"></a>
                <div class="nav-items">
                    <a href="https://disneyplus.com/?cid=DTCI-Synergy-DDN-Site-Acquisition-ITSustain-IT-DisneyPlus-DisneyPlus-IT-NavLink-Disney.it_Sustain_navbar-NA" class="a_nav">disney+</a>
                    <div class="nav-comparsa" id="menu1">
                        <a href="https://www.disney.it/disney-plus">Scopri di più</a>
                        <a href="https://www.disney.it/tutto-quello-che-devi-sapere-su-disney-plus">Tutto quello che devi sapere su Disney+</a>
                        <a href="https://www.disney.it/novita-su-disney-plus">Cosa guardare su Disney+</a>
                        <a href="https://www.disney.it/disneyplus-card">Disney+ Gift Cards</a>
                        <a href="https://www.disney.it/marvel-su-disney-plus">Marvel su Disney+</a>
                        <a href="\hw1\subscriber.php">Abbonati ora</a>
                    </div>
                    <a href="https://www.disneystore.it/?cid=chn%3Anav%3Ashopnonpromo%3Apcode%3A%3Ahome_+_page%3A%3A%3A%3Adest&cmp=OTL-DOLIT" class="a_nav">shop</a>
                    <a href="https://www.disney.it/film" class="a_nav">film</a>
                    <div class="nav-comparsa" id="menu2">
                        <a href="https://www.disney.it/film">Novità</a>
                        <a href="https://www.disney.it/film/inside-out-2">Inside Out 2</a>
                        <a href="https://www.disney.it/film/lucasfilm">Film Lucasfilm</a>
                        <a href="https://www.disney.it/film/marvel">Film Marvel</a>
                        <a href="https://www.disney.it/film/pixar">Film Pixar</a>
                    </div>
                    <a href="https://www.disneyholidays.com/walt-disney-world/tickets/?CMP=ILC-WDW_FY24Q1_EMEA_Ticket_Tra_TWDCEMEA_home_grido_WDW-Generic-Ticket_Image&utm_medium=referral&utm_source=TWDCEMEA&utm_campaign=WDW_EMEA_Ticket&utm_content=Tra_home_grido_WDW%20Generic%20Ticket&utm_term=Image" class="a_nav">parchi</a>
                    <div class="nav-comparsa" id="menu3">
                        <a href="https://www.disneylandparis.com/it-it/?ecid=PART_NO_A_8f18f8c9-1e71-49a5-80fb-1b6c36b80444">Disneyland® Paris</a>
                        <a href="http://www.disneyholidays.com/walt-disney-world/?CMP=ILC-WDW_FY18Q1_EMEA_Generic__TWDCEMEA_parks_sub-nav_sub-nav_Text">Walt Disney World</a>
                        <a href="https://disneycruise.disney.go.com/featured/important-information-it/?CMP=ILC-DCL_FY22Q3_EMEA_Generic_All_TWDCEMEA_home_sub-nav__Text">Disney Cruise Line</a>
                    </div>
                    <a class="a_nav">Cerca</a>
                    <div class="nav-comparsa" id="menu4">
                        <a href="\hw1\search.php">Personaggi</a>
                        <a href="\hw1\oauth.php">Immagini</a>
                    </div>
                </div>
            </div>
            <div id="link_nav2"> 
                <?php echo "<p> Benvenuto " . $_SESSION["username"] . "</p>"; ?>
                <img src="\hw1\img\user.png" id="user">
                <div class="nav-comparsa" id="menu5">
                    <a href="profile.php">gestisci l'account mydisney</a>
                    <a href="favorites.php">preferiti</a>
                    <a href="logout.php">esci</a>
                </div>
            </div>
        </nav>
        <header>
            <img src="\hw1\img\taylor.jpeg" alt="Taylor Swift" id="img_taylor">  
            <div id="black_taylor">
                <img src="\hw1\img\the_eras_tour.png" alt="TOUR" id="img_tour">
                <p id="p_taylor">Include "cardigan" e quattro extra brani acustici.
                    <br>
                    In streaming ora su Disney+.
                </p>
                <a href="https://www.disneyplus.com/it-it/movies/taylor-swift-the-eras-tour-taylors-version/OHLx94HKtS6X?cid=DTCI-Synergy-DDN-Site-Acquisition-ITSustain-IT-Star-TaylorSwiftTheErasTour-IT-Homepage-disney.it_sustain_taylor-swift-the-eras-tour-NA" class="button" id="button1">
                    abbonati ora*
                </a>
            </div>
        </header>

        <section id="Section1">
            <div class="riquadri">
                <a href="https://www.disney.it/film/red">
                    <img src="\hw1\img\red.jpeg" alt="Red" class="img_riquadri" id="img_riquadro1" data-nuovo-src="\hw1\img\red2.jpg" data-src="\hw1\img\red.jpeg">
                </a>
                <div class="flex_container_riquadri">
                    <div class="flex-item_riquadri">
                        <h2>Red</h2>
                        <p class="p_descrizione">Nei cinema.</p>
                    </div>
                    <div class="flex-item_riquadri">
                        <p id="p_classificazione1" class="p_classificazione">film</p>
                    </div>
                </div>
            </div>
            
            <div class="riquadri">
                <a href="https://www.disneystore.it/giochi-e-costumi/giochi?cid=chn%3Acrd-grd%3Ashopnonpromo%3Apcode%3A%3Ahome_+_page%3A%3A%3A%3Adest&cmp=OTL-DOLIT"> 
                    <div id="container_riquadro2">
                        <img src="\hw1\img\toy.jpeg" alt="Toy Story" id="img_riquadro2" class="img_riquadri">
                    </div>
                </a>
                <div class="flex_container_riquadri">
                    <div class="flex-item_riquadri">
                        <h2>Giochi spettacolari</h2>
                        <p class="p_descrizione">La destinazione imperdibile per ambitissimi giochi, peluche e tanto altro.</p>
                    </div>
                    <div class="flex-item_riquadri">
                        <p id="p_classificazione2" class="p_classificazione">shop</p>
                    </div>
                </div>
            </div>

            <div class="riquadri">
                <a href="https://www.disneylandparis.com/it-it/hotel/disneyland-hotel/?ecid=PART_NO_A_8f18f8c9-1e71-49a5-80fb-1b6c36b80444">
                    <div id="img_riquadro3">
                        <img src="\hw1\img\disneyland.jpeg" alt="Disneyland Paris" class="img_riquadri">
                    </div>
                </a>
                <a href="https://www.disneylandparis.com/it-it/hotel/disneyland-hotel/?ecid=PART_NO_A_8f18f8c9-1e71-49a5-80fb-1b6c36b80444">
                    <div id="newimg_riquadro3" class="hidden">
                        <img src="\hw1\img\disneyland2.jpg" alt="Disneyland Paris" class="img_riquadri newimg_riquadri">
                    </div>
                </a>
                <div class="flex_container_riquadri">
                    <div class="flex-item_riquadri">
                        <h2>Il Disneyland Hotel riapre</h2>
                        <p class="p_descrizione">Prenota il tuo soggiorno regale a 5 stelle al Disneyland Hotel, appena rinnovato.</p>
                    </div>
                    <div class="flex-item_riquadri">
                        <p id="p_classificazione3" class="p_classificazione">disneyland® paris</p>
                    </div>
                </div>
            </div>

            <div class="riquadri">
                <a href="https://www.disney.it/registrati">
                    <div id="img_riquadro4">
                        <img src="\hw1\img\novita.jpeg" alt="Novità" class="img_riquadri">
                    </div>
                    <div id="newimg_riquadro4" class="hidden">
                        <img src="\hw1\img\novita2.jpg" alt="Novità" class="img_riquadri newimg_riquadri">
                    </div>
                </a>
                <div class="flex_container_riquadri">
                    <div class="flex-item_riquadri">
                        <h2>Iscriviti per ricevere le novità Disney</h2>
                        <p class="p_descrizione">Rimani aggiornato su novità, offerte e molto altro da Disney!</p>
                    </div>
                    <div class="flex-item_riquadri">
                        <p id="p_classificazione4" class="p_classificazione">novità e offerte disney</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="Section2">
            <div id="Section2_titolo"> 
                <h2>Novità su Disney+</h2>
            </div>
            <div class="Section2_container">
                <div class="Section2_item-container">
                    <a href="https://www.disneyplus.com/it-it/movies/the-marvels/3sAcYG9CeWFw?cid=DTCI-Synergy-DDN-Site-Acquisition-ITSustain-IT-Marvel-TheMarvels-IT-Homepage-disney.it_sustain_the-marvels-NA">
                        <img src="\hw1\img\the_marvels.jpeg" alt="The Marvels" class="section2_img">
                    </a>
                </div>
                <div class="Section2_item-container">
                    <a href="https://www.disneyplus.com/it-it/series/percy-jackson-and-the-olympians/ql33aq42HBdr?cid=DTCI-Synergy-DDN-Site-Acquisition-ITSustain-IT-Disney-PercyJacksonandtheOlympians-IT-Homepage-disney.it_sustain_percy-jackson-and-the-olympians-NA">
                        <img src="\hw1\img\percy_jackson.jpeg" alt="Percy Jackson e gli dei dell'Olimpo" class="section2_img">
                    </a>
                </div>
                <div class="Section2_item-container">
                    <a href="https://www.disneyplus.com/it-it/series/a-real-bugs-life/4U6OnTyIVOtC?cid=DTCI-Synergy-DDN-Site-Acquisition-ITSustain-IT-NatGeo-ARealBugsLife-IT-Homepage-disney.it_sustain_a-real-bugs-life-NA">
                        <img src="\hw1\img\real_bug.jpeg" alt="A Real Bug's Life - Megaminimondo" class="section2_img">
                    </a>
                </div>
            </div>
            <div class="Section2_container">
                <div class="Section2_item-container">
                    <a href="https://www.disneyplus.com/it-it/movies/the-marvels/3sAcYG9CeWFw?cid=DTCI-Synergy-DDN-Site-Acquisition-ITSustain-IT-Marvel-TheMarvels-IT-Homepage-disney.it_sustain_the-marvels-NA">The Marvels</a>
                </div>
                <div class="Section2_item-container">
                    <a href="https://www.disneyplus.com/it-it/series/a-real-bugs-life/4U6OnTyIVOtC?cid=DTCI-Synergy-DDN-Site-Acquisition-ITSustain-IT-NatGeo-ARealBugsLife-IT-Homepage-disney.it_sustain_a-real-bugs-life-NA">Percy Jackson e gli dei dell'Olimpo</a>
                </div>
                <div class="Section2_item-container">
                    <a href="https://www.disneyplus.com/it-it/series/a-real-bugs-life/4U6OnTyIVOtC?cid=DTCI-Synergy-DDN-Site-Acquisition-ITSustain-IT-NatGeo-ARealBugsLife-IT-Homepage-disney.it_sustain_a-real-bugs-life-NA">A Real Bug's Life - Megaminimondo</a>
                </div>
            </div>
            <div id="section2_abbonamento">
                <img src="\hw1\img\abbonamento.png" alt="Abbonamento" id="section2_abbonamento_img">
            </div>
            <div id="section2_abbonati">
                <a class="button" id="button2"> abbonati ora*</a>
            </div>
            <div id="section2_condizioni">
                <p id="condizioni">* Si applicano termini e condizioni | Piani a partire da soli 5,99 € al mese</p>
            </div>
        </section>

        <section id="Section3">
            <h2 id="Section3_titolo">Shop</h2>
            <div id="section3_container">
                <div class="section3_item">
                    <img src="\hw1\img\linkStore.png" alt="Logo link store" id="section3_img_logo_link">
                    <p>Acquista le storie che ami per te e la tua famiglia</p>
                    <a href="https://www.disneystore.it/?cid=chn%3Abnn%3Aplushbanner%3Apcode%3A%3Ahome_+_page%3A%3A%3A%3Adest&cmp=OTL-DOLIT">acquista ora</a>
                </div>
            </div>
        </section>

        <section id="Section4">
            <h2 id="Section4_titolo">Parchi</h2>
            
            <div id="riquadri">
                <div class="riquadro">
                    <a href="https://www.disneyholidays.com/walt-disney-world/tickets/?CMP=ILC-WDW_FY24Q1_EMEA_Ticket_Tra_TWDCEMEA_home_grido_WDW-Generic-Ticket_Image&utm_medium=referral&utm_source=TWDCEMEA&utm_campaign=WDW_EMEA_Ticket&utm_content=Tra_home_grido_WDW%20Generic%20Ticket&utm_term=Image">
                        <img src="\hw1\img\paperino.jpeg" alt="Biglietti Parchi Disney" class="Section4_riquadro_img">
                    </a>
                    <div class="Section4_riquadri_container" data-tipo="Biglietti">
                        <div class="Section4_riquadri_item">
                            <h2 class="Section4_riquadro_intestazione">Biglietti Parchi Disney</h2>
                            <p class="Section4_riquadro_descrizione">Scopri 4 Parchi a tema spettacolari a Walt Disney World. Prenota ora! (Sito web in inglese.)</p>
                        </div>
                        <div class="Section4_riquadri_item">   
                            <p class="Section4_riquadro_classificazione Section4_riquadro_classificazione1">walt disney world</p>
                        </div>
                    </div>
                </div>
                <div class="riquadro">
                    <a href="https://disneycruise.disney.go.com/featured/important-information-it/?CMP=ILC-DCL_FY23Q2_EMEA_Summer-Itineraries_Tra_TWDCEMEA_home_grido_DCL_Image">
                        <img src="\hw1\img\spiagge.jpeg" alt="Disney Cruise Line partenze estate 2024" class="Section4_riquadro_img">
                    </a>
                    <div class="Section4_riquadri_container" data-tipo="Cruise">
                        <div class="Section4_riquadri_item">
                           <h2 class="Section4_riquadro_intestazione">Disney Cruise Line partenze estate 2024</h2>
                           <p class="Section4_riquadro_descrizione">Scopri i nostri nuovi emozionanti itinerari dell'estate 2024 e preparati a salpare in Europa, Alaska o nei Caraibi. Sito web in inglese.</p>
                        </div>
                        <div class="Section4_riquadri_item">
                            <p class="Section4_riquadro_classificazione Section4_riquadro_classificazione2">disney cruise line</p>
                        </div>
                    </div>
                </div>
        </section>
        
        <section id="Section5">
            <h2 id="Section5_titolo">Film</h2>

            <div class="Section5_container">
                <div class="Section5_item-container" data-film-id="1">
                    <div class="Section5_item-container_img">
                        <a href="https://www.disney.it/film/inside-out-2">
                            <img src="\hw1\img\inside_out.jpeg" alt="Inside Out 2" class="section5_img">
                        </a>
                    </div>
                </div>
                <div class="Section5_item-container"  data-film-id="2">
                    <div class="Section5_item-container_img">
                        <a href="https://www.disney.it/film/red">
                            <img src="\hw1\img\red2.jpeg" alt="Red" class="section5_img">
                        </a>
                    </div>
                </div>
                <div class="Section5_item-container" data-film-id="3">
                    <div class="Section5_item-container_img">
                        <a href="https://www.disney.it/film/mufasa">
                            <img src="\hw1\img\mufasa.jpeg" alt="Mufasa" class="section5_img">
                        </a>
                    </div>
                </div>
                <div class="Section5_item-container" data-film-id="4">
                    <div class="Section5_item-container_img">
                        <a href="https://www.disney.it/film/elio">
                            <img src="\hw1\img\elio.jpeg" alt="Elio" class="section5_img">
                        </a>
                    </div>
                </div>
                <div class="Section5_item-container" data-film-id="5">
                    <div class="Section5_item-container_img">
                        <a href="https://www.disney.it/film/elemental">
                            <img src="\hw1\img\elemental.jpeg" alt="Elemental" class="section5_img">
                        </a>
                    </div>
                </div>
            </div>

            <div class="Section5_container">
                <div class="Section5_item-container" data-film-id="1">
                    <a href="https://www.disney.it/film/inside-out-2" class="Section5_item_a">Inside Out 2</a>
                    <img src="\hw1\img\stella_vuota.png" alt="preferiti" class="stella_vuota" data-nuovo-src="\hw1\img\stella_piena.png" data-src="\hw1\img\stella_vuota.png">
                </div>
                <div class="Section5_item-container" data-film-id="2">
                    <a href="https://www.disney.it/film/red" class="Section5_item_a">Red</a>
                    <img src="\hw1\img\stella_vuota.png" alt="preferiti" class="stella_vuota" data-nuovo-src="\hw1\img\stella_piena.png" data-src ="\hw1\img\stella_vuota.png">
                </div>
                <div class="Section5_item-container" data-film-id="3">
                    <a href="https://www.disney.it/film/mufasa" class="Section5_item_a">Mufasa</a>
                    <img src="\hw1\img\stella_vuota.png" alt="preferiti" class="stella_vuota" data-nuovo-src="\hw1\img\stella_piena.png" data-src="\hw1\img\stella_vuota.png">
                </div>
                <div class="Section5_item-container" data-film-id="4">
                    <a href="https://www.disney.it/film/elio" class="section5_item_a">Elio</a>
                    <img src="\hw1\img\stella_vuota.png" alt="preferiti" class="stella_vuota" data-nuovo-src="\hw1\img\stella_piena.png" data-src="\hw1\img\stella_vuota.png">
                </div>
                <div class="Section5_item-container" data-film-id="5">
                    <a href="https://www.disney.it/film/elemental" class="section5_item_a">Elemental</a>
                    <img src="\hw1\img\stella_vuota.png" alt="preferiti" class="stella_vuota" data-nuovo-src="\hw1\img\stella_piena.png" data-src="\hw1\img\stella_vuota.png">
                </div>
            </div>

        </section>

        <footer>
            <p id="footer_inizio">Segui Disney su:</p>
            <div id="footer_social">
                <a href="https://www.facebook.com/DisneyIT"> <img src="\hw1\svg\facebook.svg" alt="facebook" class="social_img"> </a>
                <a href="https://www.instagram.com/disneyit"> <img src="\hw1\svg\instagram.svg" alt="instagram" class="social_img"> </a>
                <a href="https://twitter.com/DisneyIT"><img src="\hw1\svg\meta.svg" alt="meta" class="social_img"> </a>
                <a href="https://www.youtube.com/user/WaltDisneyStudiosIT"><img src="\hw1\svg\youtube.svg" alt="youtube" class="social_img"> </a>
            </div>
            <img src="\hw1\img\disney.png" alt="disney" id="footer_disney">
            <div id="footer_container_link">
                <a href="https://support.disney.com/hc/it">Aiuto</a>
                <a href="https://www.disney.it/registrati">Iscriviti</a>
                <a href="https://www.disney.it/mappa-del-sito">Mappa del sito</a>
                <a href="https://disneytermsofuse.com/italian-italy/">Condizioni d'uso</a>
                <a href="https://privacy.thewaltdisneycompany.com/it/informativa-sulla-privacy/informativa-sulla-privacy-2/">Normativa Europea sul Trattamento dei Dati Personali</a>
                <a href="https://privacy.thewaltdisneycompany.com/it/informativa-sulla-privacy/">Informativa sulla privacy</a>
                <a href="https://privacy.thewaltdisneycompany.com/it/informativa-sulla-privacy/che-cosa-sono-i-cookie/">Politica Sui Cookie</a>
                <a href="https://www.disney.it/#">Gestisci le impostazioni dei Cookies</a>
                <a href="http://preferences-mgr.truste.com/?pid=disney01&aid=disneyemea01&type=Disneyemea">Pubblicità</a>
                <a href="https://www.disney.it/chi-siamo">Chi Siamo</a>
                <a href="https://thewaltdisneycompany.eu/">The Walt Disney Company</a>
            </div>
            <p id="footer_fine">© Disney © Disney•Pixar © & ™ Lucasfilm LTD © Marvel. Tutti I Diritti Riservati</p>
        </footer>

    </body>
</html>