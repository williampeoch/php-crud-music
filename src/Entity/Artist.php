<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Collection\AlbumCollection;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Artist
{
    private int $id;
    private string $name;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public static function findById(int $id): Artist
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id, name
            FROM artist
            WHERE id = ?
            ORDER BY name
        SQL
        );

        $stmt->execute([$id]);
        $ligne = $stmt->fetchObject(Artist::class);
        if (!$ligne) {
            throw new EntityNotFoundException('Artiste introuvable');
        }
        return $ligne;
    }

    /**
     * @return Album[]
     */
    public function getAlbums(): array
    {
        $albumsArtiste = new AlbumCollection();
        return $albumsArtiste->findByArtistId($this->id);
    }
}
