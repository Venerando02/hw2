<!DOCTYPE html>
<html lang="en">
<head>
    <script>
        const BASE_URL = "<?php echo e(url('/')); ?>/";
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name = "csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <title> Fanpage Fantacalcio </title>
    <link rel="stylesheet" href="<?php echo e(url('stile.css')); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="icon" href="<?php echo e(url('favicon_fanta.png')); ?>">
    <script src="<?php echo e(url('search_player.js')); ?>" defer="true"></script>
    <script src="<?php echo e(url('insert_album_like.js')); ?>" defer="true"></script>
</head>
<body>
<?php echo csrf_field(); ?>    
<div id="navbar"><h1> FANTACALCIO </h1></div>
<div id="search">
    <header>
        <div id="overlay"></div>
        <nav>
            <div id="logo">
                <img src="<?php echo e(url('immagini/logo-fantacalcio.svg')); ?>"> 
            </div>
            <div id="Menu">
                <a href="<?php echo e(url('home')); ?>"> HOME </a>
                <a href="<?php echo e(url('logout')); ?>"> LOGOUT </a>
                <a href="<?php echo e(url('profile')); ?>"> PROFILO </a>
            </div>
        </nav>
        <h3>
            OFFICIAL FANPAGE FANTACALCIO
        </h3>
        <p>
            Trova e conosci le info dei tuoi giocatori preferiti!
        </p>
    </header>
    <section>
        <form id="Search-Player">
            <div class="ricerca">
                <label id="ricerca-giocatore">
                    Cerca
                </label>
                <input type="text" placeholder="Cerca il calciatore..." id="calciatore">
                <input type="submit" value="Cerca" id="submit">
            </div>
        </form>
    </section>
    <div id="sezione-calciatore">
    </div>
    <section id="Spotify-API">
        <h1> ASCOLTA GLI ALBUM DEDICATI AL FANTACALCIO! </h1>
    </section>
    <div id="sezione-album"></div>
    <footer>
        <div id="flex-container-footer">
            <div id="blocco-immagine">
                <img src="<?php echo e(url('immagini/logo_footer.png')); ?>" />
            </div>
            <div class="desc">
                <h2><strong>
                        STRUMENTI
                </h2></strong>
                <a href="#">
                    <li> Consigli sulle formazioni</li>
                </a>
                <a href="#">
                    <li> Probabili formazioni </li>
                </a>
                <a href="#">
                    <li> Voti Fantacalcio Serie A</li>
                </a>
                <a href="#">
                    <li> Rigoristi Serie A</li>
                </a>
                <a href="#">
                    <li> Euroleghe Fantacalcio</li>
                </a>
                <a href="#">
                    <li> FantaAsta Desktop</li>
                </a>
                <a href="#">
                    <li> FantaAsta Live</li>
                </a>
            </div>
            <div class="desc">
                <h2>LE APP DI FANTACALCIO</h2>
                <li>
                    <strong>
                        Leghe Fantacalcio
                    </strong>
                </li>
                <li>
                    <strong>
                        Euroleghe Fantacalcio
                    </strong>
                </li>
                <li>
                    <strong>
                        Fantacalcio
                    </strong>
                </li>
                <li>
                    <strong>
                        Guida per L'asta perfetta
                    </strong>
                </li>
            </div>
            <div class="desc">
                <h2> <strong> PUBBLICITA' SU FANTACALCIO </strong></h2>
                <div id="immagine-finale">
                    <a href="#"><img src="<?php echo e(url('immagini/sky.png')); ?>"></a>
                </div>
            </div>
        </div>
        <div id="subfooter">
            <span>
                Musumeci Venerando Pio M-Z matricola: 1000015141
            </span>
            <span></span>
            <span>
                Privacy | Cookie | Termini e Condizioni
            </span>
        </div>
    </footer>
</div>
</body>
</html><?php /**PATH C:\xampp\htdocs\hw2\resources\views/fanpage.blade.php ENDPATH**/ ?>