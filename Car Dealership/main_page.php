<?php
    session_start();

    $connection = new mysqli("localhost", "root", "", "db_concessionaria");

    if ($connection -> connect_error) {
        die("Connection failed: " . $connection -> connect_error);
    }

    if (isset($_SESSION['$nome_account'])) {
        $nome_account = $_SESSION['nome_account'];
        $query = "SELECT nome_account, admin_check FROM account WHERE nome_account = '$nome_account'";
        $result = $connection -> query($query);

        if ($result -> num_rows > 0) {
            $row = $result -> fetch_assoc();
            $nome_account = $row["nome_account"];
            $admin_check = $row["admin_check"];
        }else{
            header("Location: register_page.php");
            exit();
        }

    }
?> 

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="icon" href="resources\images\Icon.png" type="image/x-icon">
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

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .about-us {
            text-align: center;
            margin-bottom: 40px;
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
    </style>
</head>

<body>

    <nav>
        <h1>Car Dealership</h1>
        <?php

            if (isset($_SESSION['nome_account'])) {
                if ($_SESSION['admin_check'] === 1) {
                    echo '<a href="insert_page.php">Nuova autovettura</a>';
                }
            }
        ?>
        <a href="list_page.php">Listino</a>
        <a href="logout.php">Logout</a>
    </nav>
    <div class="background-image">
    <div class="container">
    
        <div class="about-us">
            <h2>Chi siamo</h2>
            <p>Benvenuti in Car Dealership, il tuo partner di fiducia nel mondo dell'automobile!

In Car Dealership, siamo più di una semplice concessionaria di automobili; siamo un team appassionato di professionisti dedicati a fornire un servizio eccezionale e un'esperienza senza pari ai nostri clienti. Fondata sull'integrità, sulla trasparenza e sull'impegno verso l'eccellenza, la nostra missione è quella di superare costantemente le aspettative dei nostri clienti e di stabilire relazioni a lungo termine basate sulla fiducia e sulla soddisfazione.

Ci impegniamo a offrire:

    Qualità senza compromessi: Ogni veicolo nel nostro showroom è stato attentamente selezionato e sottoposto a rigorosi controlli di qualità per garantire la massima sicurezza e affidabilità. Ci sforziamo di offrire solo le migliori vetture, soddisfacendo le esigenze e i desideri di ogni cliente.

    Servizio personalizzato: Presso Car Dealership, riteniamo che ogni cliente sia unico e meriti un trattamento personalizzato. Il nostro team esperto è qui per ascoltare le tue esigenze, consigliarti e guidarti attraverso ogni fase del processo di acquisto, garantendo un'esperienza senza stress e totalmente soddisfacente.

    Trasparenza totale: Crediamo nella trasparenza assoluta e nell'onesta comunicazione. Non ci sono sorprese nascoste o costi aggiuntivi. Ogni dettaglio relativo alla tua transazione sarà chiaro e trasparente, garantendo la tua piena fiducia e tranquillità.

    Assistenza post-vendita: Il nostro impegno verso i clienti non finisce con la vendita. Siamo qui per fornirti assistenza continua e supporto post-vendita. Che tu abbia bisogno di manutenzione, riparazioni o semplici consigli, il nostro team sarà sempre disponibile a soddisfare le tue esigenze.

Scegliere Car Dealership significa scegliere un'esperienza di acquisto di prima classe, un servizio eccezionale e un'impeccabile assistenza post-vendita. Siamo qui per rendere il tuo viaggio automobilistico un'esperienza indimenticabile e gratificante. Grazie per aver scelto di far parte della nostra famiglia!</p>
        </div>
    </div>
    
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
