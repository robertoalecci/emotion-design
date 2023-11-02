<?php
    //Namespace
    namespace App\Controllers;

    //Classi da utilizzare
    use App\Models\Post;
    use App\Models\Contact;
    use App\Helpers\Session;

    //Classe per la gestione 
    class PageController{

        //Attributi della classe
        public $viewData = array();

        //Restituisco la view home (app/views/home.php)
        public function homePage(){
            $this->viewData['all_posts'] = Post::getAll();
            $this->viewData['view_path'] = 'home';
            return $this->viewData;
        }

        //Restituisco la view home (app/views/home.php)
        public function login(){
            $this->viewData['view_path'] = 'admin/login';
            return $this->viewData;    
        }

        //Restituisco la view home (app/views/home.php)
        public function logging_in(array $post_data){
            if(isset($post_data['login'])){
                //Salvo i dati
                $password = $post_data['password'];
                //Hash della password che setta il cookie
                $hash = '$2y$10$SqG3sLgS6DvFj2IOSsorjuiScAvWsWDolcXjOsRQ0G0LBdkbsTz7q';
                //Verifico la password
                if (password_verify($password, $hash)) {
                    //Setto la sessione
                    Session::set_session();
                    //Setto una variabile di sessione
                    $_SESSION['em-token'] = 'token-emotion-design';
                    //Reindirizzo alla dashboard
                    Session::redirect(URL_ROOT.'/admin/dashboard');
                } else {
                    //Reindirizzo alla pagina di login
                    Session::redirect(URL_ROOT.'/admin');
                }
            }
        }

        //Restituisco la view home (app/views/home.php)
        public function dashboard(){
            $this->viewData['all_posts'] = Post::getAll();
            $this->viewData['all_contacts'] = Contact::getAll();
            $this->viewData['view_path'] = 'admin/dashboard';
            return $this->viewData;
        }

        //Restituisco la view 404 (app/views/404.php)
        public function error404(){
            $this->viewData['view_path'] = '404';
            return $this->viewData;
        }
 
    }