<?php
session_start();

$connection = new mysqli("localhost", "root", "", "db_concessionaria");

if ($connection -> connect_error) {
    die("Connection failed: " . $connection -> connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    die("ID non fornito.");
}

$sql = "DELETE FROM account WHERE id=$id";

if ($connection->query($sql) === TRUE) {
    echo "Record eliminato con successo.";
} else {
    echo "Errore nell'eliminazione del record: " . $connection->error;
}

header("Location: main_page.php");
$connection->close();