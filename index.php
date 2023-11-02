<?php 
    //File di configurazione
    require_once('config/config.php');
    require_once('config/router.php');
?>

<!doctype html>
<html lang="it">
    <head>
        <!--Meta tags-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

        <!--Fonts-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,200;0,300;0,400;0,500;0,600;1,200;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
        <!--Custom Style-->
        <link rel="stylesheet" href="<?php echo URL_ROOT.'/public/css/style.css'; ?>">

        <!--Title Tag-->
        <title>Emotion Design</title>
  </head>
  <body>

    <!--Contenuto della pagina-->
    <?php
        //Variabile globale con dati della view
        global $viewData;
        //Stampo la view corretta
        require_once(APP_ROOT.'/app/views/'.$viewData['view_path'].'.php');
    ?>

    <!--jQuery e Bootstrap (con Popper)-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <!--Custom Scripts-->
    <script src="<?php echo URL_ROOT.'/public/js/scripts.js'; ?>"></script>
  </body>
</html>