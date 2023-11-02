<!--Header-->
<?php require_once(APP_ROOT.'/app/views/components/admin/header.php'); ?>

<!--Pagina Admin-->
<div class="admin-content">
    <!--Titolo-->
    <h1>Nuovo post</h1>
    <!--Form-->
    <form class="mt-5" method="POST" action="<?php echo URL_ROOT.'/admin/store-post'; ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label for="titolo">Titolo</label>
            <input type="text" class="form-control" id="titolo" name="titolo" required>
        </div>
        <div class="form-group">
            <label for="descrizione">Descrizione</label>
            <textarea class="form-control" rows="5" id="descrizione" name="descrizione"></textarea>
        </div>
        <div class="form-group">
            <label for="immagine">Immagine</label>
            <input type="file" class="form-control-file" id="immagine" name="immagine">
        </div>
        <button type="submit" class="btn btn-primary mt-4" name="inserisci-post">Inserisci il post</button>
    </form>
</div>