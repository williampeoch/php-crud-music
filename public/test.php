<?php

declare(strict_types=1);

use Entity\Collection\ArtistCollection;

$collection = new ArtistCollection();

echo var_dump($collection->findAll());
