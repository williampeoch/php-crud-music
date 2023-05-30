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

    private function __construct()
    {
    }

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

    public function delete(): Artist
    {
        //supprimer la ligne correspondante à l'« id » dans la base de données
        $stmt = MyPdo::getInstance()->prepare(
            <<<SQL
            DELETE FROM artist
            WHERE id = ?
        SQL
        );
        $stmt->execute([$this->id]);
        //mettre « null » dans la propriété « id » de l'instance
        $this->id = null;
        //retourner l'instance courante pour permettre le chaînage des méthodes
        return $this;
    }

    public function save(): Artist
    {
        if ($this->id == null) {
            $this->insert();
        } else {
            $this->update();
        }
        return $this;
    }

    protected function update(): Artist
    {
        //mettre à jour le « name » de la table « artist » pour la ligne dont l'« id » est celui de l'instance courante
        $stmt = MyPdo::getInstance()->prepare(
            <<<SQL
            UPDATE artist
            SET name = :nom
            WHERE id = :id
        SQL
        );
        $stmt->execute([':nom' => $this->name,
                        ':id' => $this->id]);

        return $this;
    }

    protected function insert(): Artist
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<SQL
        INSERT INTO artist (name)
        VALUES (:name)
    SQL
        );
        $stmt->execute([':name' => $this->name]);
        $this->id = (int)MyPdo::getInstance()->lastInsertId();

        return $this;
    }



    public static function create(string $name, ?int $id = null): Artist
    {
        $artiste = new Artist();
        $artiste->setId($id);
        $artiste->setName($name);
        return $artiste;
    }
}
