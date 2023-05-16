<?php

declare(strict_types=1);

use Html\AppWebPage;
use Entity\Collection\ArtistCollection;
use Entity\Artist;

$webpage = new AppWebPage("Artistes");

$collection = new ArtistCollection();
$listeArtiste = $collection->findAll();

$webpage->appendContent("<ul class='list'>\n");
foreach ($listeArtiste as $artiste) {
    $webpage->appendContent("<li><a href='artist.php?artistId={$artiste->getId()}'>{$webpage->escapeString($artiste->getName())}</a>\n");
}
$webpage->appendContent("</ul>\n");

echo $webpage->toHTML();
