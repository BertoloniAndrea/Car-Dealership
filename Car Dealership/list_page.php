<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizza Auto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            padding: 0 20px;
        }

        nav a:hover {
            background-color: #555;
        }

        .auto-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .auto {
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            width: 30%;
            box-sizing: border-box;
        }

        .auto p {
            margin: 0;
            padding: 5px 0;
        }

        .footer {
            background-color: #1d1d1d;
            color: #fff;
            padding: 50px;
            text-align: left;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .footer p {
            margin: 5px 0;
        }

        .footer a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
            transition: color 0.3s;
        }

        .footer a:hover {
            color: #007bff;
        }

        .background-image {
            background-image: url('resources/images/BMW_Competition.jpg');
            background-size: cover;
            background-position: center;
            padding: 100px 0;
            border-radius: 8px;
            margin-top: 0px;
        }
        .icon {
            max-width: 10px;
            max-height: 10px;
        }
        .icon-div {
            flex-direction: center;
        }

        .title-div {
            align-items: center;
            text-align: center;
        }

        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            z-index: 9999;
        }

        .popup h2 {
            margin-top: 0;
        }

        .popup p {
            margin: 5px 0;
        }

        .popup-close {
            position: absolute;
            top: 5px;
            right: 5px;
            cursor: pointer;
        }
    </style>
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

    <button id="contactButton">Contattaci!</button>

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
    <script>
        function openPopup() {
            document.getElementById("contactPopup").style.display = "block";
        }

        function closePopup() {
            document.getElementById("contactPopup").style.display = "none";
        }

        document.getElementById("contactButton").addEventListener("click", openPopup);
    </script>
</body>

</html>
