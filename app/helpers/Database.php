<?php
    //Namespace
    namespace App\Helpers;

    //Classi da usare
    use Exception;

    //Classe per gestire la connessione al Database
    class Database {

        //Attributi della classe
        private $conn;

        //Costruttore per aprire la connessione al db
        public function __construct() {
            //Provo ad effettuare la connessione al DB, catturando eventuali errori
            try {
                $this->conn = $this->connect();
            } catch (Exception $e) {
                echo 'Exception: ',  $e->getMessage(), "\n";
            }
        }

        //Funzione per effettuare il collegamento al db
        public function connect(){
            //Parametri per la connessione al DB
            $host = DB_HOST;
            $user = DB_USER;
            $pass = DB_PASS;
            $db = DB_NAME;
            //Connessone tramite 'mysqli_connect'
            $connection = mysqli_connect($host,$user,$pass,$db);
            //Check sulla connessione
            if (!$connection) {
                throw new Exception("Connessione al database: " . mysqli_connect_error());
            }
            //Restituzione della connessione
            return $connection;
        }

        //Funzione per chiudere la connessione al db
        public function close_connection(){
            $this->conn->close();
        }

        /**
            * Funzione per eseguire una query di select
            * @param String $table - Tabella/e in qui effettuare la query
            * @param String $where - Parametri per filtrare la query
            * @param String $other - Opzioni per ottimizzare la query (ordinamento, ...)
        */
        public function select( String $table , String $where='' , String $other='' ){
            //Compongo il WHERE della query
            if($where != '') $where = 'WHERE '.$where;
            //Compongo la query
            $sql = "SELECT * FROM  ".$table." " .$where. " " .$other;
            //Eseguo la query nel DB
            $results = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
            //Restituisco il risultato della query
            return $results;
        }

        /**
            * Funzione per eseguire una query di inserimento
            * @param String $table - Tabella/e in qui effettuare la query
            * @param String $keys - Campi della tabella da aggiornare (nome_colonna='valore', ...)
            * @param String $values - Campi della tabella da aggiornare (nome_colonna='valore', ...)
        */
        public function insert(String $table, String $keys, String $values){
            //Compongo la query
            $sql = "INSERT INTO ".$table." ($keys) values ($values)";
            //Eseguo la query nel DB
            $results = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
            //Restituisco il risultato della query
            return $results;
        }

        /**
            * Funzione per eseguire una query di update
            * @param String $table - Tabella/e in qui effettuare la query
            * @param String $values - Campi della tabella da aggiornare (nome_colonna='valore', ...)
            * @param String $where - Parametri per indicare quali record vanno aggiornati
        */
        public function update(String $table, String $values, String $where=''){
            //Compongo il WHERE della query
            if($where != '') $where = 'WHERE '.$where;
            //Compongo la query
            $sql = "UPDATE ".$table." SET $values $where";
            //Eseguo la query nel DB
            $results = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
            //Restituisco il risultato della query
            return $results;
        }

        /**
            * Funzione per eseguire una query di cancellazione
            * @param String $table - Tabella/e in qui effettuare la query
            * @param String $where - Parametri per indicare quali record vanno eliminati
        */
        public function delete(String $table, String $where=''){
            //Compongo il WHERE della query
            if($where != '') $where = 'WHERE '.$where;            
            //Compongo la query
            $sql = "DELETE FROM ".$table." $where";
            //Eseguo la query nel DB
            $results = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
            //Restituisco il risultato della query
            return $results;
        }

    }