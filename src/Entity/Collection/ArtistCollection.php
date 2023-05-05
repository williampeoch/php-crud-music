<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use PDO;

class ArtistCollection
{
    public function findAll(): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id, name
            FROM artist
            ORDER BY name
        SQL
        );

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }
}
