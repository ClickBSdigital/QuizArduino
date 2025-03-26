<!-- <nav>
    <img src="assets/img/logo.png" alt="Logo">
    <ul>
        <li><a href="index.php">Início</a></li>
        <?php if (isset($_SESSION["usuario_tipo"]) && $_SESSION["usuario_tipo"] == "professor") { ?>
            <li><a href="pages/painel_admin.php">Painel do Professor</a></li>
        <?php } ?>
        <li><a href="logout.php">Sair</a></li>
    </ul>
</nav> -->

<!-- ;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;; -->
 
<nav class="navbar">
    <div class="navbar-logo">
        <img src="assets/img/logo.png" alt="Logo">
    </div>
    <ul class="navbar-links">
        <li><a href="index.php" class="navbar-item">Início</a></li>
        <?php if (isset($_SESSION["usuario_tipo"]) && $_SESSION["usuario_tipo"] == "professor") { ?>
            <li><a href="pages/painel_admin.php" class="navbar-item">Painel do Professor</a></li>
        <?php } ?>
        <li><a href="logout.php" class="navbar-item">Sair</a></li>
    </ul>
</nav>
