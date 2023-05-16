<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;

class Cover
{
    private int $id;
    private string $jpeg;

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
    public function getJpeg(): string
    {
        return $this->jpeg;
    }

    public static function findById(int $id): Cover
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<SQL
            SELECT id
            FROM cover
            WHERE id = ?
        SQL
        );

        $stmt->execute([$id]);
        $ligne = $stmt->fetchObject(Cover::class);
        if (!$ligne) {
            throw new EntityNotFoundException('Cover introuvable');
        }
        return $ligne;
    }
}