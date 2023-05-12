<?php

declare(strict_types=1);

use Database\MyPdo;
use Entity\Artist;
use Entity\Exception\EntityNotFoundException;
use Html\WebPage;

try {
    if (isset($_GET['artistId']) && ctype_digit($_GET['artistId'])) {
        $artistId = intval(preg_replace('@<(.+)[^>]*>.*?@is', '', $_GET['artistId']));

        $webpage = new WebPage();

        $artiste = Artist::findById($artistId);

        /*
        // Si la première ligne n'est pas présente : ERREUR 404
        if (!isset($ligne['name'])) {
            http_response_code(404);
            header('Location: http://localhost:8000/index.php', true, 302);
            exit;
        }
        */

        // On affecte le nom de l'artiste à une variable
        $nomArtiste = $artiste->getName();
        $listeAlbums = $artiste->getAlbums();

        // Titre
        $webpage->setTitle($webpage->escapeString("Albums de $nomArtiste"));

        // H1
        $webpage->appendContent("<h1>{$webpage->escapeString("Albums de $nomArtiste")}</h1>");


        // Ecriture des albums dans la page
        foreach ($listeAlbums as $album) {
            $webpage->appendContent("<p>{$webpage->escapeString("{$album->getYear()} {$album->getName()}")}\n");
        }

        echo $webpage->toHTML();
    } else {
        header('Location: http://localhost:8000/index.php', true, 302);
        exit;
    }
} catch (EntityNotFoundException) {
    header('Location: http://localhost:8000/index.php', true, 302);
    exit;
}
