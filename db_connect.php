// db_connect.php
<?php
$servername = "isport20-tp2.cxq2snm9gltt.eu-central-1.rds.amazonaws.com"; // AWS RDS Endpoint
$username = "amaadachotemeiz"; // Ihr Hauptbenutzername
$password = "100200300A"; // Ihr Hauptpasswort (ersetzten Sie dies mit Ihrem tatsächlichen Passwort)
$dbname = "isport20_TP2"; // Name Ihrer Datenbank

// Verbindung herstellen
$conn = new mysqli($servername, $username, $password, $dbname);

// Verbindung überprüfen
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}
?>