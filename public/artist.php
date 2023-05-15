<?php

declare(strict_types=1);

use Database\MyPdo;
use Entity\Artist;
use Entity\Exception\EntityNotFoundException;
use Html\AppWebPage;

try {
    if (isset($_GET['artistId']) && ctype_digit($_GET['artistId'])) {
        $artistId = intval(preg_replace('@<(.+)[^>]*>.*?@is', '', $_GET['artistId']));

        $webpage = new AppWebPage();

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

        $webpage->appendContent("<ul class='list'>\n");
        // Ecriture des albums dans la page
        foreach ($listeAlbums as $album) {
            $webpage->appendContent("<li class='album'><div class='album__year'>{$webpage->escapeString("{$album->getYear()}")}</div><div class='album__name'>{$webpage->escapeString("{$album->getName()}")}</div></li>\n");
        }
        $webpage->appendContent("</ul>\n");

        echo $webpage->toHTML();
    } else {
        header('Location: http://localhost:8000/index.php', true, 302);
        exit;
    }
} catch (EntityNotFoundException) {
    header('Location: http://localhost:8000/index.php', true, 302);
    exit;
}
