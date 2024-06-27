<!DOCTYPE html>
<html lang="en">
<head>
    <script>
        const BASE_URL = "<?php echo e(url('/')); ?>/"
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <title> Registrazione </title>
    <link rel="stylesheet" href="<?php echo e(url('registrazione_login.css')); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="icon" href="<?php echo e(url('favicon_fanta.png')); ?>">
    <script src="<?php echo e(url('registration_control.js')); ?>" defer></script>
</head>
<body>
    <div>
        <form action="<?php echo e(url('do_register')); ?>" id="registrazione" method="post">
        <?php echo csrf_field(); ?>
            <h1> Inserisci i tuoi dati per accedere alla Home </h1>
            <?php if($errors->any()): ?>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="ErrorContainer">
                <p class="Errore">
                    <?php echo e($e); ?>

                </p>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <p><label for="nome">
                Nome
                <input type="text" id="nome" name="nome" value='<?php echo e(old("nome")); ?>'></label></p>
            <p><label for="cognome">
                Cognome 
                <input type="text" id="cognome" name="cognome" value = '<?php echo e(old("cognome")); ?>'></label></p>
            <p><label for="email">
                E-mail 
                <input type="email" id="email" name="email" value = '<?php echo e(old("email")); ?>'></label></p>
            <p><label for="username">
                Username 
                <input type="text" id="username" name="username" value='<?php echo e(old("username")); ?>'></label></p>
            <p><label for="password">
                Password 
                <input type="password" id="password" name="password"></label></p>
            <p><label for="conferma_password">
                Conferma Password 
            <input type="password" id="conferma_password" name="conferma_password"></label></p>
            <input type="submit" id="Tasto_submit" value="Registrati"> 
            <button id="utente_già_loggato"><a href="<?php echo e(url('login')); ?>" id="link_registrazione">Sei già registrato?</a></button>
        </form>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\hw2\resources\views/register.blade.php ENDPATH**/ ?>