<?php
    //Namespace
    namespace App\Helpers;

    //Classe per gestire le immagini
    class Session {

        //Funzione per inizializzare la sessione, se non è già presente
        public static function set_session() {
            //Inizia o ripristina la sessione
            if (session_status() == PHP_SESSION_NONE) session_start();
        }

        //Funzione per verificare se c'è una sessione attiva
        public static function check_session() {
            //Ripristino la sessione
            self::set_session();
            //Verifico se la sessione è presente
            if(isset($_SESSION['em-token'])) return true;
            else return false;
        }

        //Funzione per reindirizzare le pagine
        public static function redirect(String $path){
            header("Location: $path");
            die();
        }

    }