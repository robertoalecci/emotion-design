<?php
    //Variabili globali
    global $viewData;

    //Salvo tutti i contatti
    $contacts = (!empty($viewData['all_contacts']) ? $viewData['all_contacts'] : array());
?>

<!--Header-->
<?php require_once(APP_ROOT.'/app/views/components/admin/header.php'); ?>

<!--Pagina Admin-->
<div class="admin-content">
    <!--Titolo-->
    <h1>Tutti i contatti</h1>
    <!--Tabella con tutti i contatti-->
    <?php if(!empty($contacts)) { ?>
        <table class="table bg-white mt-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Cognome</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Elimina</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($contacts as $contact) { ?>
                    <tr>
                        <td><?php echo $contact['id']; ?></td>
                        <td><?php echo $contact['name']; ?></td>
                        <td><?php echo $contact['surname']; ?></td>
                        <td><?php echo $contact['email']; ?></td>
                        <td><?php echo $contact['phone']; ?></td>
                        <td><form method="POST" action="<?php echo URL_ROOT.'/admin/delete-contact'; ?>"><button type="submit" name="id" value="<?php echo $contact['id']; ?>" class="btn btn-sm btn-outline-danger">Elimina</button></form></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <div class="alert alert-warning mt-4" role="alert">
            Nessun contatto trovato!
        </div>
    <?php } ?>
</div>