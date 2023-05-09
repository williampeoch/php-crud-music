<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Album;
use PDO;

class AlbumCollection
{
    /**
     * @param int $artisteId
     * @return Album[]
     */
    public function findByArtistId(int $artisteId) : array {
        $stmt = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT *
            FROM album
            WHERE artistId IN (SELECT id
                               FROM artist
                               WHERE id = ?)
            ORDER BY year DESC, name
        SQL
        );

        $stmt->execute([$artisteId]);

        return $stmt->fetchAll(PDO::FETCH_CLASS, Album::class);
    }
}