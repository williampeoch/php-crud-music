<?php

declare(strict_types=1);

use Html\WebPage;
use Entity\Collection\ArtistCollection;
use Entity\Artist;

$webpage = new WebPage("Playlist");

$collection = new ArtistCollection();
$listeArtiste = $collection->findAll();

foreach ($listeArtiste as $artiste) {
    $webpage->appendContent("<p><a href='artist.php?artistId={$artiste->getId()}'>{$webpage->escapeString($artiste->getName())}</a>\n");
}

echo $webpage->toHTML();
