<!--Pagina Admin-->
<div class="admin-login">
    <form method="POST" action="<?php echo URL_ROOT.'/admin/logging-in'; ?>">
        <div class="form-group">
            <label for="password">Password di accesso</label>
            <input class="form-control" type="password" id="password" name="password" />
        </div>
        <button type="submit" class="btn btn-primary" id="login" name="login">Entra</button>
    </form>
</div>