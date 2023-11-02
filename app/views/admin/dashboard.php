<?php
    //Variabili globali
    global $viewData;

    //Salvo tutti i post
    $posts = (!empty($viewData['all_posts']) ? $viewData['all_posts'] : array());
    //Salvo tutti i contatti
    $contacts = (!empty($viewData['all_contacts']) ? $viewData['all_contacts'] : array());
?>

<!--Header-->
<?php require_once(APP_ROOT.'/app/views/components/admin/header.php'); ?>

<!--Pagina Admin-->
<div class="admin-content">
    <!--Titolo-->
    <h1>Dashboard</h1>
    <!--Review-->
    <div class="admin-review-container">
        <!--Posts-->
        <div class="admin-review">
            <div class="review-counter">
                <span><?php echo count($posts); ?></span> Posts
            </div>
            <div class="review-cta">
                <a href="<?php echo URL_ROOT.'/admin/new-post'; ?>" title="Nuovo post">Nuovo post ></a>
                <a href="<?php echo URL_ROOT.'/admin/posts'; ?>" title="Tutti i post">Tutti i post ></a>
            </div>
        </div>
        <!--Contacts-->
        <div class="admin-review">
            <div class="review-counter">
                <span><?php echo count($contacts); ?></span> Contatti
            </div>
            <div class="review-cta">
                <a href="<?php echo URL_ROOT.'/admin/contacts'; ?>" title="Tutti i contatti">Tutti i contatti ></a>
            </div>
        </div>
    </div>
</div>