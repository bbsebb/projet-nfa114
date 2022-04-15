<aside id="nav-bar">
<nav>
    <ul>
        <!-- Prendre un rdv (Tous les utilisateurs) -->
        <li>        
            <a href="<?= $router->generate('office') ?>">Cabinet médical</a>
        </li>
        <?php if (!isset($auth)): ?>
        <li>
            <a href="<?= $router->generate('signin') ?>">Connexion</a>
        </li>   
        <li>
            <a href="<?= $router->generate('signup') ?>">inscription</a>
        </li>
        <?php endif; ?>
        <?php if (isset($auth)): ?>
        <!-- TODO : Remplacer par nom  (Tous les roles) -->
        <li>
            <a href="<?= $router->generate('profile') ?>">Perso</a>
        </li>
        <!-- Prendre un rdv (client) -->
        <li>
            <a href="<?= $router->generate('agenda') ?>">Prendre rdv</a>
        </li>
        <!-- Rdv du patient (client) -->
        <li>
            <a href="<?= $router->generate('myappointment') ?>">Mes rdv</a>
        </li>
        <?php if ($auth->hasRoles(["DOCTOR"])): ?>
        <!-- Rdv du medecin (medecin) -->
        <li>
            <a href="<?= $router->generate('docagenda') ?>">Mes rdv</a>
        </li>
        <?php endif; ?>
        <?php if ($auth->hasRoles(["ADMIN"])): ?>
        <!-- Page d'administration (Admin) -->
        <li>
            <a href="<?= $router->generate('admin') ?>">Adminitration</a>
        </li>
        <?php endif; ?> 
        <li>
            <a href="<?= $router->generate('signout') ?>">Déconnexion</a>
        </li>
        <?php endif; ?>
    </ul>
</nav>
</aside>