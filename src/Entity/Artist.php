<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Collection\AlbumCollection;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Artist
{
    private ?int $id;
    private string $name;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Artist
     */
    private function setId(?int $id): Artist
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Artist
     */
    public function setName(string $name): Artist
    {
        $this->name = $name;
        return $this;
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

    public function delete() : Artist
    {
        //supprimer la ligne correspondante à l'« id » dans la base de données
        //mettre « null » dans la propriété « id » de l'instance
        $this->id = null;
        //retourner l'instance courante pour permettre le chaînage des méthodes
        return $this;
    }
}
