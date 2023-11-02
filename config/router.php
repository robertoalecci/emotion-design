<?php
    //Classi da usare
    use App\Controllers\PageController;
    use App\Controllers\PostController;
    use App\Controllers\ContactController;
    use App\Helpers\Session;

    //Funzione per pulire dei parametri
    function cleanParameters($data, String $type){
        //Oggetto 'mysqli' per utilizzare la funzione 'mysqli_real_escape_string'
        $mysqli = new mysqli('','','','');

        //In base alla tipologia di dato passato, sanifico il dato
        switch($type){
            case 's': $cleaned_data = mysqli_real_escape_string($mysqli, $data);
            break;
            case 'i': $cleaned_data = intval($data);
            break;
            case 'f': $cleaned_data = floatval($data);
            break;
        }
        
        //Restituisco il dato sanificato
        return $cleaned_data;
    }

    //Funzione che restituisce oggetto con parametri della richiesta
    function initRoute(){
        //URL della richiesta
        $request_uri = $_SERVER['REQUEST_URI'];
        
        //Escape di eventuali caratteri speciali nell'url root
        $path_to_remove = preg_quote(URL_ROOT, '/');

        //Creo un'espressione regolare per rimuovere la prima occorrenza della costante
        $pattern = '/^' .$path_to_remove.'/';

        //Rimuovo la prima occorrenza dell'url root dalla stringa (per ottenere il percorso richiesto)
        $request_uri_without_url_root = preg_replace($pattern, '', $request_uri, 1);

        //Divido l'url (per separare il path da eventuali parametri)
        $request_uri = parse_url($request_uri_without_url_root);

        //Compongo oggetto con tutti i dati della richiesta
        $routeData = new stdClass;
        $routeData->requestUri = $request_uri['path'];
        $routeData->requestUriWithPaths = explode('/', trim($request_uri['path'], '/'));
        $routeData->getParameters = $_GET;
        $routeData->postParameters = $_POST;
        $routeData->fileParameters = $_FILES;

        //Restituisco oggetto con tutti i dati della richiesta
        return $routeData;
    }

    //Variabili globali
    global $routeData, $viewData;
    $routeData = initRoute();

    //Inizializzo oggetti dei controller
    $PageController = new PageController();
    $PostController = new PostController();
    $ContactController = new ContactController();

    /**
     * Client - gestione delle richieste da utente finale
    */

    //Home
    if($routeData->requestUri == '/') $viewData = $PageController->homePage();

    //Salvataggio del contatto nel DB
    if($routeData->requestUri == '/store-contact') $viewData = $ContactController->store($routeData->postParameters);

    /**
     * Admin - gestione delle richieste da amministratore del sito
    */

    //Login
    if($routeData->requestUri == '/admin') (!Session::check_session() ? $viewData = $PageController->login() : Session::redirect(URL_ROOT.'/admin/dashboard'));

    //Loggin-in (fase di login)
    if($routeData->requestUri == '/admin/logging-in') (!Session::check_session() ? $viewData = $PageController->logging_in($routeData->postParameters) : Session::redirect(URL_ROOT.'/admin/dashboard'));

    //Dashboard
    if($routeData->requestUri == '/admin/dashboard' && Session::check_session()) $viewData = $PageController->dashboard();
    
    /*-- Posts --*/

    //Tutti i post
    if($routeData->requestUri == '/admin/posts' && Session::check_session()) $viewData = $PostController->index();

    //Inserisci singolo post
    if($routeData->requestUri == '/admin/new-post' && Session::check_session()) $viewData = $PostController->create();

    //Edita singolo post
    if($routeData->requestUri == '/admin/edit-post' && !empty($routeData->getParameters['id']) && Session::check_session()) $viewData = $PostController->edit($routeData->getParameters['id']);

    //Salvataggio di un nuovo post nel DB (Array $_POST come paramentro)
    if($routeData->requestUri == '/admin/store-post' && Session::check_session()) $viewData = $PostController->store($routeData->postParameters, $routeData->fileParameters);

    //Aggiornamento di un post nel DB (ID del post come parametro)
    if($routeData->requestUri == '/admin/update-post' && Session::check_session()) $viewData = $PostController->update($routeData->getParameters['id'], $routeData->postParameters, $routeData->fileParameters);

    //Rimozione di un post dal DB (ID del post come parametro)
    if($routeData->requestUri == '/admin/delete-post' && Session::check_session()) $viewData = $PostController->destroy($routeData->postParameters);
    
    /*-- Contacts --*/

    //Tutti i contatti
    if($routeData->requestUri == '/admin/contacts' && Session::check_session()) $viewData = $ContactController->index();
    
    //Rimozione di un contatto dal DB (ID del contatto come parametro)
    if($routeData->requestUri == '/admin/delete-contact' && Session::check_session()) $viewData = $ContactController->destroy($routeData->postParameters);


    /**
     * 404 
    */

    //Se non è presente nessuna view
    if(empty($viewData)) $viewData = $PageController->error404();