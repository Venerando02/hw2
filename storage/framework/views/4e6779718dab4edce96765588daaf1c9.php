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
    <title> Profilo - <?php echo e($utente->username); ?> </title>
    <link rel="stylesheet" href="<?php echo e(url('stile_profile.css')); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="icon" href="<?php echo e(url('favicon_fanta.png')); ?>">
    <script src="<?php echo e(url('change_password.js')); ?>" defer="true"></script>
    <script src= "<?php echo e(url('insert_object.js')); ?>" defer="true"></script>
</head>
<body>
    <div id="navbar">
        <h1> FANTACALCIO </h1>
    </div>
    <div id="search">
        <header>
            <nav>
                <div id="logo">
                    <img src="<?php echo e(url('immagini/logo-fantacalcio.svg')); ?>">
                </div>
                <div id="Menu">
                    <a href="<?php echo e(url('home')); ?>"> HOME </a>
                    <a href="<?php echo e(url('fanpage')); ?>"> FANPAGE </a>
                    <a href="<?php echo e(url('logout')); ?>"> LOGOUT </a>
                </div>
            </nav>
        </header>
        <section id="info-utente">
            <h1 class="titolo">Dati Account</h1>
            <div class="dati">
                <div class="item">
                    <label for="name">NOME:</label>
                    <input type="text" id="name" value="<?php echo e($utente->nome); ?>" disabled>
                </div>
                <div class="item">
                    <label for="surname">COGNOME:</label>
                    <input type="text" id="surname" value="<?php echo e($utente->cognome); ?>" disabled>
                </div>
                <div class="item">
                    <label for="username">USERNAME:</label>
                    <input type="text" id="username" value="<?php echo e($utente->username); ?>" disabled>
                </div>
                <div class="item">
                    <label for="email">INDIRIZZO EMAIL:</label>
                    <input type="text" id="email" value="<?php echo e($utente->email); ?>" disabled>
                </div>
            </div>
            <h1 class="titolo">Password di Accesso</h1>
            <form action="<?php echo e(url('ChangePassword')); ?>" id="modifica-password" method="POST">
                <?php echo csrf_field(); ?>
                <div class="dati">
                    <div class="options">
                        <label>VECCHIA PASSWORD:</label>
                        <input type="password" name="old-password" id="old-password">
                        <button type="button" class="bottone">MOSTRA</button>
                    </div>
                    <div class="options">
                        <label>NUOVA PASSWORD:</label>
                        <input type="password" name="new-password" id="new-password">
                        <button type="button" class="bottone">MOSTRA</button>
                    </div>
                    <div class="options">
                        <label>RIPETI NUOVA PASSWORD:</label>
                        <input type="password" name="confirm-new-password" id="confirm-new-password">
                        <button type="button" class="bottone">MOSTRA</button>
                    </div>
                    <div class="submit-container">
                        <input type="submit" id="submit-password" value="MODIFICA PASSWORD">
                    </div>
                </div>
            </form>
        </section>
        <div id="sezione-articoli">
            <h1 class="titolo">
                Articoli Letti
            </h1>
            <div id="articoli-letti"></div>
        </div>

    
        <div id="sezione-calciatori">
            <h1 class="titolo">
                Calciatori Preferiti
            </h1>
            <div id="Calciatori-preferiti">
            </div>
        </div>

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
</body>
</html><?php /**PATH C:\xampp\htdocs\hw2\resources\views/profile.blade.php ENDPATH**/ ?>