<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use PDO;
use Entity\Artist;

class ArtistCollection
{
    /**
     * Retourne un tableau contenant tous les artistes triés par ordre alphabétique
     *
     * @return Artist[]
     */
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
        $tableauArtiste = [];
        foreach ($stmt->fetchAll(PDO::FETCH_CLASS) as $ligne) {
            $tableauArtiste[] = $ligne->name;
        }
        return $tableauArtiste;
    }
}
