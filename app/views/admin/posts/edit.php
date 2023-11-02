<?php
    //Variabili globali
    global $viewData;

    //Salvo tutti i post
    $post = (!empty($viewData['single_post']) ? $viewData['single_post'] : array());
?>

<!--Header-->
<?php require_once(APP_ROOT.'/app/views/components/admin/header.php'); ?>

<!--Pagina Admin-->
<div class="admin-content">
    <!--Titolo-->
    <h1>Edita il post con id: <?php echo $post->getId(); ?></h1>
    <!--Form-->
    <form class="mt-5" method="POST" action="<?php echo URL_ROOT.'/admin/update-post?id='.$post->getId(); ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label for="titolo">Titolo</label>
            <input type="text" class="form-control" id="titolo" name="titolo" value="<?php echo $post->getTitle(); ?>" required>
        </div>
        <div class="form-group">
            <label for="descrizione">Descrizione</label>
            <textarea class="form-control" rows="5" id="descrizione" name="descrizione"><?php echo $post->getDescription(); ?></textarea>
        </div>
        <div class="form-group">
            <label for="immagine">Immagine</label>
            <input type="file" class="form-control-file" id="immagine" name="immagine">
            <?php if(!empty($post->getImage())): ?>
                <img class="mt-3 w-25" src="<?php echo URL_ROOT.'/public/images/uploads/'.$post->getImage(); ?>" alt="Immagine" />
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary mt-4" name="salva-post">Salva il post</button>
    </form>
</div>