<?php
    //Namespace
    namespace App\Models;

    //Classi da usare
    use App\Helpers\Database;
    
    //Classe per gestire un contatto
    class Contact {

        //Attributi della classe
        protected $id;
        protected $name;
        protected $surname;
        protected $email;
        protected $phone;

        /**
         * Construttore della classe che inizializza gli attributi con i dati di un contatto 
         * @param int $id - Id del contatto da inizializzare
        */
        public function __construct(int $id = 0) {
            //Se è presente un id
            if(!empty($id)){
                //Apro connesione al DB
                $db = new Database();
                //Effettuo la query
                $contact = $db->select("contacts", "id = $id") or die('Errore durante l\'estrazione dei dati.');
                //Se la query ha prodotto dei risultati
                if($contact && $contact->num_rows>0){
                    //Estraggo il singolo post
                    $contact = mysqli_fetch_array($contact, MYSQLI_ASSOC);
                    //Setto i dati nell'oggetto
                    $this->id = $contact['id'];
                    $this->name = $contact['name'];
                    $this->surname = $contact['surname'];
                    $this->email = $contact['email'];
                    $this->phone = $contact['phone'];
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

        public function getName(){
            return $this->name;
        }

        public function getSurname(){
            return $this->surname;
        }

        public function getPhone(){
            return $this->phone;
        }

        public function getEmail(){
            return $this->email;
        }

        /**
        * Metodi SET
        */
        public function setName(string $name){
            $this->name = $name;
        }

        public function setSurname(string $surname){
            $this->surname = $surname;
        }

        public function setEmail(string $email){
            $this->email = $email;
        }

        public function setPhone(string $phone){
            $this->phone = $phone;
        }

        /**
        * Operazioni Crud: Create
        * Funzione per inserire un nuovo contatto nel database
        * @param Contact $contact - Oggetto di tipo contact, passato dal controller, con i dati da inserire
        */
        public function create(Contact $contact){
            //Chiavi e valori per il nuovo inserimento
            $keys = "name, surname, email, phone";
            $values = (!empty($contact->getName()) ? "'".$contact->getName()."'" : 'NULL').", ".(!empty($contact->getSurname()) ? "'".$contact->getSurname()."'" : 'NULL').", ".(!empty($contact->getEmail()) ? "'".$contact->getEmail()."'" : 'NULL').", ".(!empty($contact->getPhone()) ? "'".$contact->getPhone()."'" : 'NULL');
            //Apro connesione al DB
            $db = new Database();
            //Effettuo la query
            $post = $db->insert("contacts", $keys, $values) or die('Errore durante l\'inserimento dei dati.');
            //Chiudo la connessione al DB
            $db->close_connection();
            //Restituisco una variabile booleana
            return ($post ? true : false);
        }

        /**
        * Operazioni Crud: Read
        * Funzione per estrarre un contatto dal database
        * @param int $id - ID del contatto, passato dal controller, per l'estrazione dei dati
        */
        public function read(int $id){
            //Apro connesione al DB
            $db = new Database();
            //Compongo la stringa da aggiornare
            $where = "id='".$id."'";
            //Effettuo la query
            $read = $db->select('contacts', $where) or die('Errore durante l\'estrazione dei dati.');
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
        * Funzione per aggiornare record dei contatti nel database
        * @param Contact $contact - Oggetto di tipo contact, passato dal controller, con i dati da aggiornare
        */
        public function update(Contact $contact){
            //Apro connesione al DB
            $db = new Database();
            //Compongo la stringa da aggiornare
            $values = "name=".(!empty($contact->getName()) ? "'".$contact->getName()."'": 'NULL').", surname=".(!empty($contact->getSurname()) ? "'".$contact->getSurname()."'": 'NULL').", email=".(!empty($contact->getEmail()) ? "'".$contact->getEmail()."'": 'NULL').", phone=".(!empty($contact->getPhone()) ? "'".$contact->getPhone()."'": 'NULL');
            $where = "id='".$contact->getId()."'";
            //Effettuo la query
            $update = $db->update('contacts', $values, $where) or die('Errore durante l\'aggiornamento dei dati.');
            //Chiudo la connessione al DB
            $db->close_connection();
            //Restituisco una variabile booleana
            return ($update ? true : false);
        }

        /**
        * Operazioni Crud: Delete
        * Funzione per eliminare record dei contatti nel database
        * @param int $id - ID del contatto, passato dal controller, per l'eliminazione dei dati
        */
        public function delete(int $id){
            //Apro connesione al DB
            $db = new Database();
            //Compongo la stringa da aggiornare
            $where = "id='".$id."'";
            //Effettuo la query
            $delete = $db->delete('contacts', $where) or die('Errore durante l\'eliminazione dei dati.');
            //Chiudo la connessione al DB
            $db->close_connection();
            //Restituisco una variabile booleana
            return ($delete ? true : false);
        }

        /**
         * Funzione statica per restituire tutti i contatti
        */
        public static function getAll(){ 
            //Apro connesione al DB
            $db = new Database();
            //Effettuo la query
            $contacts = $db->select("contacts") or die('Errore durante l\'estrazione dei dati.');
            //Array da restituire
            $results = array(); 
            //Se la query ha prodotto dei risultati
            if($contacts && $contacts->num_rows>0){
                //Salvo dati estratti in array
                while ($row = mysqli_fetch_array($contacts, MYSQLI_ASSOC)) {
                    $results[] = $row;
                }
            }
            //Chiudo la connessione al DB
            $db->close_connection();
            //Restituisco array
            return $results;
        }

    }