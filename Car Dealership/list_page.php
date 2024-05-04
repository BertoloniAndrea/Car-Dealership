<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizza Auto</title>
    <link rel="stylesheet" href="list_page_style.css">
</head>

<body>
    <nav>
        <h1>Car Dealership</h1>
        <a href="main_page.php">Home</a>
        <a href="insert_page.php">Nuova autovettura</a>
    </nav>
    <div class="title-div">
        <h2>Listino</h2>
    </div>
    
    <div class="auto-container">
        <?php
        
        $connection = new mysqli("localhost", "root", "", "db_concessionaria");

       
        if ($connection->connect_error) {
            die("Connessione fallita: " . $connection->connect_error);
        }

        $query = "SELECT * FROM auto";
        $result = $connection->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='auto'>";
                echo "<p>Marca: " . $row["marca"] . "</p>";
                echo "<p>Modello: " . $row["modello"] . "</p>";
                echo "<p>Targa: " . $row["targa"] . "</p>";
                echo "<p>Immatricolazione: " . $row["immatricolazione"] . "</p>";
                echo "<p>Cilindrata: " . $row["cilindrata"] . "</p>";
                echo "<p>Anno: " . $row["anno"] . "</p>";
                echo "<p>KM: " . $row["km"] . "</p>";
                echo "<p>Prezzo: " . $row["prezzo"] . "</p>";
                echo "<td><a href='modifica.php?id=" . $row['id'] . "'>Modifica</a> | <a href='elimina.php?id=" . $row['id'] . "'>Elimina</a></td>";
                echo "</div>";
            }
        } else {
            echo "<p>Nessun risultato trovato</p>";
        }

        $connection->close();
        ?>
    </div>

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
