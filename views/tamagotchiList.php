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

$pageTitle = "Mes Tamagotchis";
include __DIR__ . '/../views/layouts/header.php';
?>

<div class="home-link-section"><a class="home-link" href="./tamagotchi.php?username=<?= urlencode($username) ?>">Home</a></div>
<div class="tamago-container">
    <?php if (!empty($tamagos)): ?>
        <?php foreach ($tamagos as $tamago): ?>
            <?php if ($tamago->etat === "vivant"): ?>
                <?php
                    $isDead = false;
                    include __DIR__ . '/../views/components/tamagoCard.php';
                ?>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="text-align:center">Aucun Tamagotchi vivant actuellement.</p>
    <?php endif; ?>
</div>
<div class="graveyard-link-section">
    <a class="graveyard-link" href="tamagotchiGraveyard.php?username=<?= urlencode($username) ?>">Visiter le cimetière</a>
</div>

<?php include __DIR__ . '/../views/layouts/footer.php'; ?>
