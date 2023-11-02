<?php
    //Errore 404
    http_response_code(404);
?>

<section class="d-flex flex-column align-items-center justify-content-center emotion-design-404">
    <h1 class="display-3 px-3 mb-4 text-center">Errore 404</h1>
    <div class="d-flex align-items-center justify-content-center">
        <button onclick="window.location.href='<?php echo URL_ROOT; ?>'" class="btn btn-primary btn-sm mr-2">Vai alla home</button>
        <button onclick="history.back()" class="btn btn-outline-danger btn-sm">Torna indietro</button>
    </div>
</section>