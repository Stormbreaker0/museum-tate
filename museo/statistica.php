<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2.1.1/out/water.css">
        <title>TATE - Visualizza Statistiche</title>
        <style> 
            body { max-width: 1200px; }
            /* style of navigation bar*/
            .navbar {
                background-color: #333;
                padding: 20px 0;
                text-align: center;
            }

            .navbar-list {
                list-style-type: none;
                margin: 0;
                padding: 0;
            }

            .navbar-item {
                display: inline;
                margin-right: 20px;
            }

            .navbar-link {
                color: #fff;
                text-decoration: none;
                font-size: 18px;
                position: relative;
            }

            .navbar-link:before {
                content: '';
                position: absolute;
                width: 100%;
                height: 2px;
                bottom: 0;
                left: 0;
                background-color: rgb(160, 6, 127); /* Fluorescent color */
                visibility: hidden;
                transform: scaleX(0);
                transition: all 0.3s ease-in-out;
            }

            .navbar-link:hover:before {
                visibility: visible;
                transform: scaleX(1);
            }
        </style>
    </head>
    <body>
        <header>
            <h1>TATE - Risultati Statistiche</h1>
            <nav class="navbar">
                <ul class="navbar-list">
                    <li class="navbar-item"><a class="navbar-link" href="index.html"> Home </a></li>
                    <li class="navbar-item"><a class="navbar-link" href="artista.html">Artisti </a></li>
                    <li class="navbar-item"><a class="navbar-link" href="opera.html"> Opere </a></li>
                    <li class="navbar-item"><a class="navbar-link" href="statistica.html"> Statistiche </a></li>
                    <li class="navbar-item"><a class="navbar-link" href="visita.html">Visita</a></li>
                </ul>
            </nav>
        </header>

       
        <h2>Risultati del Calcolo</h2>
        <?php
            include 'config.php';

            $anno_inizio = (int)$_GET['anno_inizio'];
            $anno_fine = (int)$_GET['anno_fine'];

            $sql = "SELECT COUNT(*) AS total_artworks, AVG(YEAR) AS avg_year 
                    FROM artworks 
                    WHERE year BETWEEN $anno_inizio AND $anno_fine";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<p>Numero totale di opere: " . $row['total_artworks'] . "</p>";
                echo "<p>Anno medio di creazione delle opere: " . round($row['avg_year'], 2) . "</p>";
            } else {
                echo "<p>Nessuna statistica disponibile per il periodo selezionato.</p>";
            }

            $conn->close();
        ?>


        <footer>
            <address>
                123 Main Street, Art-City, England<br>
                Phone: 123-456-7890<br>
            </address>
            <p>"L'arte non riproduce ciò che è visibile, ma rende visibile ciò che non sempre lo è." - Paul Klee</p>
            <p>&copy; 2024 Museo Tate. Tutti i diritti riservati.</p>
        </footer>
    </body>
</html>
