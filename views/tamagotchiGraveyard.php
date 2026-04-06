<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Models\User;
use Services\TamagoService;

if (!isset($_GET['username'])) {
    die("Utilisateur non spécifié.");
}

$username = $_GET['username'];
$user = User::getByName($username);

if (!$user) {
    header('Location: ../connexion/login.php');
    exit;
}

$tamagos = TamagoService::getByUserId($user->id);

$pageTitle = "Mon Cimetière";
include __DIR__ . '/../views/layouts/header.php';
?>

<div class="tamago-container">
    <?php if (!empty($tamagos)): ?>
        <?php foreach ($tamagos as $tamago): ?>
            <?php if ($tamago->etat === "mort"): ?>
                <?php
                    $isDead = true;
                    include __DIR__ . '/../views/components/tamagoCard.php';
                ?>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="text-align:center">Aucun Tamagotchi mort pour le moment.</p>
    <?php endif; ?>
</div>
<div class="tamagotchiList-link-section">
    <a class="tamagotchiList-link" href="tamagotchiList.php?username=<?= urlencode($username) ?>">Retour aux vivants</a>
</div>

<?php include __DIR__ . '/../views/layouts/footer.php'; ?>
