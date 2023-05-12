<?php

declare(strict_types=1);

use Html\AppWebPage;
use Entity\Collection\ArtistCollection;
use Entity\Artist;

$webpage = new AppWebPage("Playlist");

$collection = new ArtistCollection();
$listeArtiste = $collection->findAll();

foreach ($listeArtiste as $artiste) {
    $webpage->appendContent("<p><a href='artist.php?artistId={$artiste->getId()}'>{$webpage->escapeString($artiste->getName())}</a>\n");
}

echo $webpage->toHTML();
