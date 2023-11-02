<?php
    //Namespace
    namespace App\Models;

    //Classi da usare
    use App\Helpers\Database;
    
    //Classe per gestire un post
    class Post {

        //Attributi della classe
        protected $id;
        protected $title;
        protected $description;
        protected $image;

        /**
         * Construttore della classe che inizializza gli attributi con i dati di un post 
         * @param int $id - Id del post da inizializzare
        */
        public function __construct(int $id = 0) {
            //Se è presente un id
            if(!empty($id)){
                //Apro connesione al DB
                $db = new Database();
                //Effettuo la query
                $post = $db->select("posts", "id = $id") or die('Errore durante l\'estrazione dei dati.');
                //Se la query ha prodotto dei risultati
                if($post && $post->num_rows>0){
                    //Estraggo il singolo post
                    $post = mysqli_fetch_array($post, MYSQLI_ASSOC);
                    //Setto i dati nell'oggetto
                    $this->id = $post['id'];
                    $this->title = $post['title'];
                    $this->description = $post['description'];
                    $this->image = $post['image'];
                }
                //Chiudo la connessione al DB
                $db->close_connection();
            }
        }

        /**
        * Metodi GET
        */
        public function getId(){
            return $this->id;
        }

        public function getTitle(){
            return $this->title;
        }

        public function getDescription(){
            return $this->description;
        }

        public function getImage(){
            return $this->image;
        }


        /**
        * Metodi SET
        */
        public function setTitle(string $title){
            $this->title = $title;
        }

        public function setDescription(string $description){
            $this->description = $description;
        }

        public function setImage(string $image){
            $this->image = $image;
        }

        /**
        * Operazioni Crud: Create
        * Funzione per inserire un nuovo post nel database
        * @param Post $post - Oggetto di tipo post, passato dal controller, con i dati da inserire
        */
        public function create(Post $post){
            //Chiavi e valori per il nuovo inserimento
            $keys = "title, description, image";
            $values = (!empty($post->getTitle()) ? "'".$post->getTitle()."'" : 'NULL').", ".(!empty($post->getDescription()) ? "'".$post->getDescription()."'" : 'NULL').", ".(!empty($post->getImage()) ? "'".$post->getImage()."'" : 'NULL');
            //Apro connesione al DB
            $db = new Database();
            //Effettuo la query
            $post = $db->insert("posts", $keys, $values) or die('Errore durante l\'inserimento dei dati.');
            //Chiudo la connessione al DB
            $db->close_connection();
            //Restituisco una variabile booleana
            return ($post ? true : false);
        }

        /**
        * Operazioni Crud: Read
        * Funzione per estrarre un post dal database
        * @param int $id - ID del post, passato dal controller, per l'estrazione dei dati
        */
        public function read(int $id){
            //Apro connesione al DB
            $db = new Database();
            //Compongo la stringa da aggiornare
            $where = "id='".$id."'";
            //Effettuo la query
            $read = $db->select('posts', $where) or die('Errore durante l\'estrazione dei dati.');
            //Array da restituire
            $results = array(); 
            //Se la query ha prodotto dei risultati
            if($read && $read->num_rows>0){
                //Salvo dati estratti in array
                while ($row = mysqli_fetch_array($read, MYSQLI_ASSOC)) {
                    $results[] = $row;
                }
            }
            //Chiudo la connessione al DB
            $db->close_connection();
            //Restituisco una variabile booleana
            return $results;
        }

        /**
        * Operazioni Crud: Update
        * Funzione per aggiornare record dei post nel database
        * @param Post $post - Oggetto di tipo post, passato dal controller, con i dati da aggiornare
        */
        public function update(Post $post){
            //Apro connesione al DB
            $db = new Database();
            //Compongo la stringa da aggiornare
            $values = "title=".(!empty($post->getTitle()) ? "'".$post->getTitle()."'": 'NULL').", description=".(!empty($post->getDescription()) ? "'".$post->getDescription()."'": 'NULL').", image=".(!empty($post->getImage()) ? "'".$post->getImage()."'": 'NULL');
            $where = "id='".$post->getId()."'";
            //Effettuo la query
            $update = $db->update('posts', $values, $where) or die('Errore durante l\'aggiornamento dei dati.');
            //Chiudo la connessione al DB
            $db->close_connection();
            //Restituisco una variabile booleana
            return ($update ? true : false);
        }

        /**
        * Operazioni Crud: Delete
        * Funzione per aggiornare record dei post nel database
        * @param Post $post - Oggetto di tipo post, passato dal controller, con i dati da aggiornare
        */
        public function delete(int $id){
            //Apro connesione al DB
            $db = new Database();
            //Compongo la stringa da aggiornare
            $where = "id='".$id."'";
            //Effettuo la query
            $delete = $db->delete('posts', $where) or die('Errore durante l\'eliminazione dei dati.');
            //Chiudo la connessione al DB
            $db->close_connection();
            //Restituisco una variabile booleana
            return ($delete ? true : false);
        }

        /**
         * Funzione statica per restituire tutti i post
        */
        public static function getAll(){ 
            //Apro connesione al DB
            $db = new Database();
            //Effettuo la query
            $posts = $db->select("posts", '', 'ORDER BY id DESC') or die('Errore durante l\'estrazione dei dati.');
            //Array da restituire
            $results = array(); 
            //Se la query ha prodotto dei risultati
            if($posts && $posts->num_rows>0){
                //Salvo dati estratti in array
                while ($row = mysqli_fetch_array($posts, MYSQLI_ASSOC)) {
                    $results[] = $row;
                }
            }
            //Chiudo la connessione al DB
            $db->close_connection();
            //Restituisco array
            return $results;
        }

    }