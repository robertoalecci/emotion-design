<?php
    //Namespace
    namespace App\Helpers;

    //Classe per gestire le immagini
    class Image {

        /**
         * Funzione per gestire l'upload di un'immagine
         * @param array $file_data - File caricato tramite un campo di input
         * @param String $field_name - Nome del campo di input
        */
        public static function upload_image(array $file_data, String $field_name){
            //Directory di destinazione
            $uploadDir = APP_ROOT.'/public/images/uploads/';
            //Tipi di file consentiti
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            //Se è settata un'immagine...
            if(isset($file_data[$field_name]) && in_array($file_data[$field_name]['type'], $allowedTypes)) {
                //Creo un nome di file univoco
                $unique_name = uniqid().'_'.$file_data[$field_name]['name'];
                $uploadFile = $uploadDir.$unique_name;
                //Se il salvataggio dell'immagine va a buon fine, salvo il nome, altrimenti setto stringa vuota
                if (move_uploaded_file($file_data[$field_name]['tmp_name'], $uploadFile)) $image_name = $unique_name;
                else $image_name = '';
            //Se non è settata un'immagine...
            } else {
                //Setto stringa vuota
                $image_name = '';
            }
            //Restituisco il nome dell'immagine
            return $image_name;
        }

    }