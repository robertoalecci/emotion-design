<?php
    //Namespace
    namespace App\Controllers;

    //Classi da usare
    use App\Models\Contact;
    use App\Helpers\Session;

    //Classe per la gestione 
    class ContactController{

        //Attributi della classe
        public $viewData = array();

        //Mostro tutti i post (app/views/admin/posts/all.php)
        public function index(){
            $this->viewData['all_contacts'] = Contact::getAll();
            $this->viewData['view_path'] = 'admin/contacts/all';
            return $this->viewData;
        }

        //Mostro il form per creare un post (app/views/admin/posts/create.php)
        /*public function create(){
            $this->viewData['view_path'] = 'admin/posts/create';
            return $this->viewData;
        }*/

        //Mostro un singolo post (app/views/admin/posts/edit.php)
        /*public function edit(int $id){
            //Acquisisco il post
            $post = new Post($id);
            //Salvo i dati nella view
            $this->viewData['single_post'] = $post;
            $this->viewData['view_path'] = 'admin/posts/edit';
            return $this->viewData;
        }*/

        //Gestisco il salvataggio del contatto nel DB
        public function store(array $post_data){
            //Se è stato cliccato il pulsante
            if(isset($post_data['inserisci-contatto'])){                
                //Salvo i dati
                $nome = cleanParameters($post_data['nome'], 's');
                $cognome = cleanParameters($post_data['cognome'], 's');
                $email = cleanParameters($post_data['email'], 's');
                $telefono = cleanParameters($post_data['telefono'], 's');
                //Creo un nuovo contatto
                $contact = new Contact();
                $contact->setName($nome);
                $contact->setSurname($cognome);
                $contact->setEmail($email);
                $contact->setPhone($telefono);
                //Inserisco il contatto
                if($contact->create($contact)) {
                    Session::redirect(URL_ROOT.'/?msg_type=success&message='.urlencode('In contatto è stato inviato correttamente').'#contact-section');
                }
            }
        }

        //Gestisco l'aggiornamento del post nel DB
        /*public function update(int $id, array $post_data, array $file_data){
            //Se è stato cliccato il pulsante
            if(isset($post_data['salva-post'])){
                //Salvo i dati
                $titolo = cleanParameters($post_data['titolo'], 's');
                $descrizione = cleanParameters($post_data['descrizione'], 's');
                $immagine = Image::upload_image($file_data, 'immagine');
                $immagine = (!empty($immagine) ? cleanParameters($immagine, 's') : '');
                //Acquisisco il post
                $post = new Post($id);
                $post->setTitle($titolo);
                $post->setDescription($descrizione);
                if(!empty($immagine)) $post->setImage($immagine);
                //Aggiorno il post
                if($post->update($post)) {
                    Session::redirect(URL_ROOT.'/admin/posts?msg_type=success&message='.urlencode('Post aggiornato correttamente'));
                }
            }
        }*/
        
        //Gestisco l'eliminazione del post nel DB
        public function destroy(array $post_data){
            //Salvo i dati
            $id = cleanParameters($post_data['id'], 'i');
            //Acquisisco il post
            $contact = new Contact($id);
            //Cancello il post
            if($contact->delete($id)) {
                Session::redirect(URL_ROOT.'/admin/contacts?msg_type=success&message='.urlencode('Contatto eliminato correttamente'));
            }
        }
        
    }