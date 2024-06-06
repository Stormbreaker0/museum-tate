<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2.1.1/out/water.css">
        <title>TATE - Risultati Ricerca Opere</title>
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
            <h1>TATE - Risultati Ricerca Opere</h1>
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

        <h2>Risultati della Ricerca</h2>
        <?php
            include 'config.php';

            $titolo_opera = $conn->real_escape_string($_GET['titolo_opera']);
            $sql = "SELECT artworks.title, artworks.year, artworks.medium, artworks.dimensions, artists.name AS artist_name 
                    FROM artworks 
                    JOIN artists ON artworks.artist_id = artists.id 
                    WHERE artworks.title LIKE '%$titolo_opera%'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<ul>";
                while($row = $result->fetch_assoc()) {
                    echo "<li><strong>" . $row['title'] . "</strong> di " . $row['artist_name'] . " (" . $row['year'] . ") - " . $row['medium'] . ", " . $row['dimensions'] . "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>Nessuna opera trovata.</p>";
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
