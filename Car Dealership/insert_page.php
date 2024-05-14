<?php

session_start();

$connection = new mysqli("localhost", "root", "", "db_concessionaria");

if ($connection -> connect_error) {
    die("Connection failed: " . $connection -> connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup_submit'])) {
    $marca = $_POST['marca'];
    $modello = $_POST['modello'];
    $targa = $_POST['targa'];
    $immatricolazione = $_POST['immatricolazione'];
    $cilindrata = $_POST['cilindrata'];
    $anno = $_POST['anno'];
    $km = $_POST['km'];
    $prezzo = $_POST['prezzo'];

    $insert_query = "INSERT INTO auto (marca, modello, targa, immatricolazione, cilindrata, anno, km, prezzo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $statement = $connection -> prepare($insert_query);

    if ($statement) {
        $statement -> bind_param("ssssisii", $marca, $modello, $targa, $immatricolazione, $cilindrata, $anno, $km, $prezzo);
        if ($statement->execute()) {
            echo "Dati inseriti con successo.";
        } else {
            echo "Errore nell'esecuzione della query: " . $statement->error;
        }
    }else{
        echo "Errore nella preparazione dello statement: " . $connection->error;
    }
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert</title>
    <link rel="stylesheet" href="insert_page_style.css">
</head>

<body>
    <nav>
        <h1>Car Dealership</h1>
        <a href="main_page.php">Home</a>
        <a href="list_page.php">Listino</a>
    </nav>
    <center>
        <div class="forms">
            <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <fieldset>

                    <div class="input-block">
                        <label for="marca">Marca</label>
                        <input id="marca" name="marca" type="text" required>
                    </div>
                    
                    <div class="input-block">
                        <label for="modello">Modello</label>
                        <input id="modello" name="modello" type="text" required>
                    </div>

                    <div class="input-block">
                        <label for="targa">Targa</label>
                        <input id="targa" name="targa" type="text" required>
                    </div>
                    
                    <div class="input-block">
                        <label for="immatricolazione">Immatricolazione</label>
                        <input id="immatricolazione" name="immatricolazione" type="date" required>
                    </div>

                    <div class="input-block">
                        <label for="cilindrata">Cilindrata</label>
                        <input id="cilindrata" name="cilindrata" type="number" required>
                    </div>
                    
                    <div class="input-block">
                        <label for="anno">Anno</label>
                        <input id="anno" name="anno" type="date" required>
                    </div>

                    <div class="input-block">
                        <label for="km">Km</label>
                        <input id="km" name="km" type="number" required>
                    </div>

                    <div class="input-block">
                        <label for="prezzo">Prezzo</label>
                        <input id="prezzo" name="prezzo" type="number" required>
                    </div>
                </fieldset>
                <br>
                <button type="submit" name="signup_submit" class="btn-signup">Inserisci</button>
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

