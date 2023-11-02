<?php
    //Controllers
    require_once('./app/controllers/PageController.php');
    require_once('./app/controllers/PostController.php');
    require_once('./app/controllers/ContactController.php');
    //Models
    require_once('./app/models/Post.php');
    require_once('./app/models/Contact.php');
    //Helpers
    require_once('./app/helpers/Database.php');
    require_once('./app/helpers/Image.php');
    require_once('./app/helpers/Session.php');

    //Abilito la stampa degli errori a schermo
    ini_set ('display_errors', 1);
    ini_set ('display_startup_errors', 1);
    error_reporting (E_ALL);

    //Nome del sito
    define('SITE_NAME', 'Emotion Design');

    //Dati Root
    define('APP_ROOT', dirname(dirname(__FILE__)));
    define('URL_ROOT', '/emotion-design');

    //Parametri del DB
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'emotion_design');