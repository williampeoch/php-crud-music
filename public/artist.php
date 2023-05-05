<?php

declare(strict_types=1);

use Database\MyPdo;
use Html\WebPage;

if (isset($_GET['artistId']) && ctype_digit($_GET['artistId'])) {
    $artistId = intval(preg_replace('@<(.+)[^>]*>.*?@is', '', $_GET['artistId']));

    $webpage = new WebPage();

    $pdoArtist = MyPdo::getInstance()->prepare(
        <<<SQL
        SELECT *
        FROM artist
        WHERE id = ?
    SQL
    );

    $pdoArtist->execute([$artistId]);

    $pdoAlbum = MyPdo::getInstance()->prepare(
        <<<SQL
        SELECT *
        FROM album
        WHERE artistId IN (SELECT id
                           FROM artist
                           WHERE id = ?)
        ORDER BY year DESC, name
    SQL
    );

    $pdoAlbum->execute([$artistId]);

    $ligne = $pdoArtist->fetch();
    if (!isset($ligne['name'])) {
        http_response_code(404);
        exit;
    }
    $nomArtiste = $ligne['name'];

    $webpage->setTitle($webpage->escapeString("Albums de $nomArtiste"));
    $webpage->appendContent("<h1>{$webpage->escapeString("Albums de $nomArtiste")}</h1>");

    while (($ligne = $pdoAlbum->fetch()) !== false) {
        $webpage->appendContent("<p>{$webpage->escapeString("{$ligne['year']} {$ligne['name']}")}\n");
    }

    echo $webpage->toHTML();

} else {
    header('Location: http://localhost:8000/index.php', true, 302);
    exit;
}
