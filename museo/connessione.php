<?php

    $SERVER = "localhost";          // oppure "127.0.0.1"
    $USER = "virgil";
    $PASSWORD = "studente";
    $DB_NAME = "Museo";
	$link = mysqli_connect($SERVER, $USER, $PASSWORD, $DB_NAME);

	// Controllo se è avvenuta la connessione al database:
	if (!$link) {
	    echo "Si è verificato un errore: Connessione al database fallita" . PHP_EOL;
	    echo "Codice errore: " . mysqli_connect_errno() . PHP_EOL;
	    echo "Messaggio errore: " . mysqli_connect_error() . PHP_EOL;
	    exit;
	}

?>