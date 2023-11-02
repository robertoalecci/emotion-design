<?php
    //Variabili globali
    global $viewData;
    
    //Salvo tutti i post
    $posts = (!empty($viewData['all_posts']) ? $viewData['all_posts'] : array());
    
    //Acquisisco eventuali messaggi GET
    $msg_type = !empty($_GET['msg_type']) ? htmlspecialchars($_GET['msg_type'], ENT_QUOTES) : '';
    $message = !empty($_GET['message']) ? htmlspecialchars($_GET['message'], ENT_QUOTES) : '';
?>

<?php require_once(APP_ROOT.'/app/views/components/client/header.php'); ?>

<!--Hero-->
<section class="container-fluid p-0 emotion-design-hero">
    <div class="title-and-caption">
        <div class="container">
            <h1>Web & Comunicazione</h1>
            <p>Soluzioni di qualità dall’approcio creativo concreto.<br>Nello scenario attuale diventa sempre più indispensabile avere una versione del proprio sito web compatibile con tutti i device oggi più diffusi.</p>
        </div>
    </div>
    <div id="carouselSlide" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?php echo URL_ROOT.'/public/images/slide-1.jpg'; ?>" class="d-block w-100" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="<?php echo URL_ROOT.'/public/images/slide-2.jpg'; ?>" class="d-block w-100" alt="Slide 2">
            </div>
        </div>
    </div>
</section>

<!--Gallery-->
<section class="container emotion-design-gallery">
    <div class="gallery-title-description">
        <h2 class="section-title">Fotogallery</h2>
        <p class="section-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>
    <img class="gallery-image w-100" src="<?php echo URL_ROOT.'/public/images/gallery-1.jpg'; ?>" alt="Foto">
</section>

<!--Posts-->
<section class="container emotion-design-posts">
    <?php
        //Numero massimo di post da stampare (Desktop)
        $maxToPrint = 4;
        $countToPrint = 1;
    ?>

    <!--Desktop-->
    <?php foreach($posts as $post) { ?>
        <?php if($countToPrint <= $maxToPrint) { ?>
            <!--Singolo post-->
            <div class="emotion-design-single-post d-none d-lg-block">
                <img class="w-100" src="<?php echo (!empty($post['image']) ? URL_ROOT.'/public/images/uploads/'.$post['image'] : URL_ROOT.'/public/images/gallery-1.jpg'); ?>" alt="Post">
                <h3><?php echo $post['title']; ?></h3>
                <p><?php echo $post['description']; ?></p>
            </div>
        <?php } ?>
        <?php $countToPrint++; ?>
    <?php } ?>

    <?php
        //Numero massimo di post da stampare (Mobile)
        $maxToPrint = 4;
        $countToPrint = 1;
    ?>

    <!--Mobile-->
    <div id="carouselPostsControls" class="carousel slide d-block d-lg-none" data-ride="carousel">
        <div class="carousel-inner">
            <?php foreach($posts as $post) { ?>
                <?php if($countToPrint <= $maxToPrint) { ?>
                    <!--Singolo post-->
                    <div class="carousel-item <?php echo ($countToPrint == 1 ? 'active' : ''); ?>">
                        <img class="w-100" src="<?php echo (!empty($post['image']) ? URL_ROOT.'/public/images/uploads/'.$post['image'] : URL_ROOT.'/public/images/gallery-1.jpg'); ?>" alt="Post">
                        <h3><?php echo $post['title']; ?></h3>
                        <p><?php echo $post['description']; ?></p>
                    </div>
                <?php } ?>
                <?php $countToPrint++; ?>
            <?php } ?>
        </div>
        <a class="carousel-control-prev" href="#carouselPostsControls" role="button" data-slide="prev">
            <img src="<?php echo URL_ROOT.'/public/images/icon-angle-left.svg'; ?>" alt="Left" />
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselPostsControls" role="button" data-slide="next">
            <img src="<?php echo URL_ROOT.'/public/images/icon-angle-right.svg'; ?>" alt="Right" />
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>

<!--Contatti-->
<section class="container-fluid emotion-design-contacts" id="contact-section">
    <div class="container p-0">
        <h2 class="section-title">Richiedi informazioni</h2>
        <p class="section-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
        <form method="POST" action="<?php echo URL_ROOT.'/store-contact'; ?>">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="cognome">Cognome</label>
                    <input type="text" class="form-control" id="cognome" name="cognome" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="telefono">Telefono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-4" name="inserisci-contatto">Invia richiesta</button>
        </form>
        <?php if(!empty($msg_type) && !empty($message) && in_array($msg_type, ['success'])): ?>
            <!--Messaggio-->
            <div class="contact-feedback-message <?php echo $msg_type; ?>">
                <p class="mb-0"><?php echo $message ?></p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php require_once(APP_ROOT.'/app/views/components/client/footer.php'); ?>