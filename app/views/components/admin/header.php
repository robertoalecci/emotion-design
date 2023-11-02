<?php
    //Acquisisco eventuali messaggi GET
    $msg_type = !empty($_GET['msg_type']) ? htmlspecialchars($_GET['msg_type'], ENT_QUOTES) : '';
    $message = !empty($_GET['message']) ? htmlspecialchars($_GET['message'], ENT_QUOTES) : '';
?>

<!--Navbar-->
<nav class="nav flex-column admin-navbar">
    <img class="nav-brand w-100" src="<?php echo URL_ROOT.'/public/images/logo-white.png'; ?>" alt="logo"/>
    <a class="nav-link" href="<?php echo URL_ROOT.'/admin/dashboard'; ?>">Dashboard</a>
    <a class="nav-link" href="<?php echo URL_ROOT.'/admin/posts/'; ?>">Posts</a>
    <a class="nav-link" href="<?php echo URL_ROOT.'/admin/contacts/'; ?>">Contatti</a>
    <a class="nav-link" href="<?php echo URL_ROOT; ?>">< Torna al sito</a>
</nav>

<?php if(!empty($msg_type) && !empty($message) && in_array($msg_type, ['success'])): ?>
    <!--Messaggio-->
    <div class="admin-feedback-message <?php echo $msg_type; ?>">
        <p class="mb-0"><?php echo $message ?></p>
    </div>
<?php endif; ?>