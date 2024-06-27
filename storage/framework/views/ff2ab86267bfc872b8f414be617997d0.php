<!DOCTYPE html>
<html lang="en">
<head>
    <script>
        const BASE_URL = "<?php echo e(url('/')); ?>/";
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title> Log-in </title>
    <link rel="stylesheet" href="<?php echo e(url('registrazione_login.css')); ?>">
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
    <script src="<?php echo e(url('control_login.js')); ?>" defer="true"></script>
</head>
<body>
    <div>
    <form action = "<?php echo e(url('do_login')); ?>" id="login" method = "post" name="login">
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
        <p><label> Username <input type="text" name="username" id="username" value = '<?php echo e(old("username")); ?>'></label></p>
        <p><label> Password <input type="password" name="password" id="password"></label></p>
        <input type="submit" id="Tasto_submit" value="Accedi"> 
        <button id="utente_già_loggato"><a href="<?php echo e(url('register')); ?>" id="link_registrazione"> Non sei registrato? </a></button>
    </form>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\hw2\resources\views/login.blade.php ENDPATH**/ ?>