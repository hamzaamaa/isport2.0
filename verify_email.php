// verify_email.php
<?php
include 'db_connect.php';

if (isset($_GET['uuid'])) {
    $uuid = $_GET['uuid'];

    $stmt = $conn->prepare("UPDATE users SET email_verified = 1 WHERE uuid = ?");
    $stmt->bind_param("s", $uuid);

    if ($stmt->execute()) {
        echo "E-Mail-Adresse erfolgreich bestätigt. Sie können sich jetzt einloggen.";
    } else {
        echo "Fehler bei der Bestätigung der E-Mail-Adresse.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Ungültiger Bestätigungslink.";
}
?>
