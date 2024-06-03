// reg_process.php
<?php
include 'db_connect.php'; // Verbindung mit der Datenbank

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Daten aus dem Formular erhalten
    $vorname = $_POST['vorname'];
    $nachname = $_POST['nachname'];
    $email = $_POST['email'];
    $geburtsdatum = $_POST['geburtsdatum'];
    $strasse = $_POST['strasse'];
    $hausnummer = $_POST['hausnummer'];
    $plz = $_POST['plz'];
    $stadt = $_POST['stadt'];
    $sicherheitsfrage = $_POST['sicherheitsfrage'];
    $sicherheitsantwort = $_POST['sicherheitsantwort'];
    $password = $_POST['password'];

    // Passwort hashen
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // UUID generieren
    $uuid = bin2hex(random_bytes(16));

    // Eintrag in die Datenbank
    $stmt = $conn->prepare("INSERT INTO users (vorname, nachname, email, geburtsdatum, strasse, hausnummer, plz, stadt, sicherheitsfrage, sicherheitsantwort, password_hash, uuid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssss", $vorname, $nachname, $email, $geburtsdatum, $strasse, $hausnummer, $plz, $stadt, $sicherheitsfrage, $sicherheitsantwort, $password_hash, $uuid);
    
    if ($stmt->execute()) {
        // Bestätigungsmail senden
        $to = $email;
        $subject = "Bitte bestätigen Sie Ihre E-Mail-Adresse";
        $message = "Klicken Sie auf den folgenden Link, um Ihr Konto zu bestätigen: https://deine-domain.de/verify_email.php?uuid=" . $uuid;
        $headers = "From: no-reply@deine-domain.de";

        mail($to, $subject, $message, $headers);

        echo "Registrierung erfolgreich. Bitte überprüfen Sie Ihre E-Mails, um Ihr Konto zu bestätigen.";
    } else {
        echo "Fehler: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
