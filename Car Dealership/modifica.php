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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $marca = $_POST['marca'];
    $modello = $_POST['modello'];
    $targa = $_POST['targa'];
    $immatricolazione = $_POST['immatricolazione'];
    $cilindrata = $_POST['cilindrata'];
    $anno = $_POST['anno'];
    $km = $_POST['km'];

    $sql = "UPDATE auto SET marca='$marca', modello='$modello', targa='$targa', immatricolazione='$immatricolazione', cilindrata='$cilindrata', anno='$anno', km='$km' WHERE id=$id";

    if ($connection->query($sql) === TRUE) {
        header("Location: main_page.php");
    } else {
        echo "Errore nell'aggiornamento del record: " . $connection->error;
    }
}

$sql = "SELECT * FROM auto WHERE id=$id";
$result = $connection->query($sql);
$row = $result->fetch_assoc();

$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Record</title>
    <link rel="stylesheet" href="modifica_style.css">
</head>
<body>
    <nav>
        <h1>Car Dealership</h1>
        <a href="main_page.php">Home</a>
        <a href="insert_page.php">Nuova autovettura</a>
        <a href="list_page.php">Listino</a>
        <a href="logout.php">Logout</a>
    </nav>
    <center>
    <h2>Modifica dati sul veicolo</h2>
    <div class="modifica-div">
        <form method="post">
        <label>Marca:</label><br>
            <input type="text" name="marca" value="<?php echo $row['marca']; ?>"><br>
            <label>Modello:</label><br>
            <input type="text" name="modello" value="<?php echo $row['modello']; ?>"><br>
            <label>Targa:</label><br>
            <input type="text" name="targa" value="<?php echo $row['targa']; ?>"><br>
            <label>Immatricolazione:</label><br>
            <input type="text" name="immatricolazione" value="<?php echo $row['immatricolazione']; ?>"><br>
            <label>Cilindrata:</label><br>
            <input type="text" name="cilindrata" value="<?php echo $row['cilindrata']; ?>"><br>
            <label>Anno:</label><br>
            <input type="text" name="anno" value="<?php echo $row['anno']; ?>"><br>
            <label>Km:</label><br>
            <input type="text" name="km" value="<?php echo $row['km']; ?>"><br><br>
            <input type="submit" value="Modifica">
        </form>
    </div>
    </center>
    <div class="footer">
        <div class="info-div">
            <h2>Informazioni e contatti</h2>
            <h3>Contatti:</h3>
            <li>Numero di telefono: +39 3345274875</li>
            <li>Indirizzo: Via Bassanesa 8 Travagliato (BS) 25039</li>
            <li><a href="https://maps.app.goo.gl/pSHDL4X1WoNekwVY9">Google Maps</a></li>
            <li>Indirizzo mail: supporto@cardealership.it</li>
            <li>2015 © Car Dealership S.r.l.</li>
            <p>&copy; 2024 Car Dealership. Tutti i diritti riservati.</p>
        </div>
        
        <div class="icon-div">
            <img src="resources/images/Icon.png" alt="Logo" id="icon">
        </div>
    </div>
</body>
</html>
