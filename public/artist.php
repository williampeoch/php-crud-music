<?php

declare(strict_types=1);

use Database\MyPdo;
use Entity\Artist;
use Entity\Exception\EntityNotFoundException;
use Html\AppWebPage;

if (isset($_GET['artistId']) && ctype_digit($_GET['artistId'])) {
    try {
        $artistId = intval(preg_replace('@<(.+)[^>]*>.*?@is', '', $_GET['artistId']));

        $webpage = new AppWebPage();

        $artiste = Artist::findById($artistId);

        // On affecte le nom de l'artiste à une variable
        $nomArtiste = $artiste->getName();
        $listeAlbums = $artiste->getAlbums();

        // Titre
        $webpage->setTitle($webpage->escapeString("Albums de $nomArtiste"));

        $webpage->appendContent("<ul class='list'>\n");
        // Ecriture des albums dans la page
        foreach ($listeAlbums as $album) {
            $coverId = $album->getCoverId();
            $webpage->appendContent("<li> <img class='album__cover' src='cover.php?coverId=$coverId'/> <div class='description'><div class='album__year'>{$webpage->escapeString("{$album->getYear()}")}</div><div class='album__name'>{$webpage->escapeString("{$album->getName()}")}</div></div></li>\n");
        }
        $webpage->appendContent("</ul>\n");

        echo $webpage->toHTML();
    } catch (EntityNotFoundException) {
        http_response_code(404);
        exit;
    }
} else {
    header('Location: index.php', true, 302);
    exit;
}
