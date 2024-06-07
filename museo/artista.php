

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2.1.1/out/water.css">
        <title>TATE - Risultati Ricerca Artista</title>
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

            <h1>TATE - Risultati Ricerca Artista</h1>

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

        <div>
            <h2>Risultati della Ricerca</h2>

            <?php
                //connessione la database
                include_once('connessione.php');

        
                /* La clausola 1=1 è una convenzione comune quando si costruiscono
                query dinamiche con condizioni multiple. Questa condizione è sempre vera,
                quindi non influisce sul risultato finale della query.
                */

                // Costruzione della query SQL in base ai filtri inseriti dall'utente
            
                $query = "SELECT * FROM ARTISTA WHERE 1=1";

                // Raccogliere i dati inseriti dall'utente
                if(isset($_POST['nome_artista']) && !empty($_POST['nome_artista'])){
                    $nome_artista = $_POST['nome_artista'];
                    $query .= " AND NOME LIKE '%$nome_artista%'";
                }
                if(isset($_POST['genere']) && !empty($_POST['genere'])){
                    $genere = $_POST['genere'];
                    if($genere =='Male' || $genere == 'Maschio'){
                        $genere = 'M';
                    }
                    if($genere =='Female' || $genere == 'Femminile'){
                        $genere = 'F';
                    }
                    $query .= " AND GENERE LIKE '%$genere%'";
                }
                if(isset($_POST['anno_n']) && !empty($_POST['anno_n'])){
                    $anno_n = $_POST['anno_n'];
                    $query .= " AND ANNO_N LIKE '%$anno_n%'";
                }
                if(isset($_POST['anno_m']) && !empty($_POST['anno_m'])){
                    $anno_m = $_POST['anno_m'];
                    $query .= " AND ANNO_M LIKE '%$anno_m%'";
                }
                if(isset($_POST['luogo_n']) && !empty($_POST['luogo_n'])){
                    $luogo_n = $_POST['luogo_n'];
                    $query .= " AND LUOGO_N LIKE '%$luogo_n%'";
                }
                if(isset($_POST['luogo_m']) && !empty($_POST['luogo_m'])){
                    $luogo_m = $_POST['luogo_m'];
                    $query .= " AND LUOGO_N LIKE '%$luogo_m%'";
                }

                // Eseguire la query 
                $result = mysqli_query($link, $query);
                if($result){
                    // contare i risultati e dare alla pagina
                    $count = mysqli_num_rows($result);
                    if($count<1){
                        echo "<p><strong>Nesssun artista trovato </strong></p>"; 
                    }
                    elseif($count==1){
                        echo "<p><strong>".$count." Artista trovato</strong></p>";    
                    }
                    elseif($count>=2){
                        echo "<p><strong>".$count." Artisti trovati</strong></p>";
                    }
                    // creare la tabella di renderizzazione
                    
                    // agguingere le celle della tabella
                    while($rows = mysqli_fetch_array($result)){
                        echo "<li>";
                        echo "<div><a href= " .$rows['ARTISTA_URL']. ">" .$rows['NOME']. "</a> </div>";
                        echo "<div>" .$rows['DATES']. "</div>";
                        echo "<div> Genere: " .$rows['GENERE']. "</div>";
                        echo "<div> Luogo di nascita: " .$rows['LUOGO_N']. "</div>";  
                        if ($rows['LUOGO_M'] != 'Unknown'){
                            echo "<div>Luogo di morte: " .$rows['LUOGO_M']. "</div>";
                        }
                        echo "</li>";
                    }
                }
                // Chiudere la connessione al database 
                mysqli_close($link);
            ?>
        </div>
        <p><a href="artista.html"> Nuova Ricerca </a></p>
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
