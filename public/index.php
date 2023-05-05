<?php

declare(strict_types=1);

use Database\MyPdo;
use Html\WebPage;

$webpage = new WebPage("Playlist");



$stmt = MyPDO::getInstance()->prepare(
    <<<'SQL'
    SELECT id, name
    FROM artist
    ORDER BY name
SQL
);

$stmt->execute();

while (($ligne = $stmt->fetch()) !== false) {
    $webpage->appendContent("<p><a href='artist.php?artistId={$ligne['id']}'>{$webpage->escapeString($ligne['name'])}</a>\n");
}

echo $webpage->toHTML();
