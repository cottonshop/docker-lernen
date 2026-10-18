
<?php

$host = 'db';
$dbname = 'testdb';
$username = 'testuser';
$password = 'testpass';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );

    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

    $stmt = $pdo->query("SELECT * FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<h1>Meine Docker-Anwendung</h1>";

    foreach ($users as $user) {
        echo "<p>" . htmlspecialchars($user['name']) . "</p>";
    }

} catch (PDOException $e) {
    http_response_code(500);
    error_log($e->getMessage());
    echo "Datenbankverbindung fehlgeschlagen.";
}

