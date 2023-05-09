<?php

declare(strict_types=1);

use Entity\Collection\AlbumCollection;
use Entity\Album;

$collection = new AlbumCollection();
$listeAlbum = $collection->findByArtistId(12);
var_dump($listeAlbum);
