<?php
    //Variabili globali
    global $viewData;

    //Salvo tutti i post
    $posts = (!empty($viewData['all_posts']) ? $viewData['all_posts'] : array());
?>

<!--Header-->
<?php require_once(APP_ROOT.'/app/views/components/admin/header.php'); ?>

<!--Pagina Admin-->
<div class="admin-content">
    <!--Titolo-->
    <h1>Tutti i post</h1>
    <a href="<?php echo URL_ROOT.'/admin/new-post'; ?>" title="Nuovo post"><button class="btn btn-primary btn-sm mt-3">Nuovo post</button></a>
    <!--Tabella con tutti i post-->
    <?php if(!empty($posts)) { ?>
        <table class="table bg-white mt-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrizione</th>
                    <th>Immagine</th>
                    <th>Modifica</th>
                    <th>Elimina</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($posts as $post) { ?>
                    <tr>
                        <td><?php echo $post['id']; ?></td>
                        <td><?php echo $post['title']; ?></td>
                        <td><?php echo (!empty($post['description']) ? substr($post['description'], 0, 80).'...': ''); ?></td>
                        <td><?php echo !empty($post['image']) ? '<img class="table-preview" src="'.URL_ROOT.'/public/images/uploads/'.$post['image'].'" alt="Immagine"/>' : ''; ?></td>
                        <td><a href="<?php echo URL_ROOT.'/admin/edit-post?id='.$post['id']; ?>" title="Edita">Edita</a></td>
                        <td><form method="POST" action="<?php echo URL_ROOT.'/admin/delete-post'; ?>"><button type="submit" name="id" value="<?php echo $post['id']; ?>" class="btn btn-sm btn-outline-danger">Elimina</button></form></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <div class="alert alert-warning mt-4" role="alert">
            Nessun post trovato!
        </div>
    <?php } ?>
</div>