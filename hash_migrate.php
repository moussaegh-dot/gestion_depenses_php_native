<?php
require 'vendor/autoload.php';
require_once 'src/Core/Database.php'; // connexion PDO

$users = $instance->query("SELECT id, password FROM users")->fetchAll();

foreach ($users as $u) {

    // Skip si déjà hashé (bcrypt commence toujours par "$2y$")
    if (strpos($u['password'], '$2y$') === 0) {
        continue;
    }

    $newPass = password_hash($u['password'], PASSWORD_DEFAULT);

    $stmt = $instance->prepare("UPDATE users SET password = ? WHERE id = ?");
    $stmt->execute([$newPass, $u['id']]);
}

echo "✔️ Tous les mots de passe ont été hashés.\n";
