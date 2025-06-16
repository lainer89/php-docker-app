<?php
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$password = getenv('DB_PASS');
$db = getenv('DB_NAME');

if (!$host || !$user || !$password || !$db) {
    die("Database environment variables are not set.");
}

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    // En producción, registra el error en vez de mostrarlo.
    die("Connection failed.");
}

echo "<h1>PHP 8.2 Application (Upgraded!)</h1>";
echo "<p>Successfully connected to MySQL database.</p>";

$stmt = $conn->prepare("SELECT id, name FROM users");
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<h2>Users:</h2><ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>ID: " . htmlspecialchars($row["id"]) . " - Name: " . htmlspecialchars($row["name"]) . "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>No users found.</p>";
}

$conn->close();
