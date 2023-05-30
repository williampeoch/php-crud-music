<?php

declare(strict_types=1);

namespace Entity;

class ArtistForm extends Artist
{
    private ?Artist $artist;

    /**
     * @param Artist|null $artist
     */
    public function __construct(?Artist $artist = null)
    {
        $this->artist = $artist;
    }

    /**
     * @return Artist|null
     */
    public function getArtist(): ?Artist
    {
        return $this->artist;
    }

    public function getHtmlForm(string $action) : string
    {
        $name = $this->getName();
        $html = <<<HTML
    <form action="$action" method="post">
        <input type="text" name="id" hidden>
        <label for="$name"></label>
        <input type="text" name="$name" required>
        <button type="submit">Enregistrer</button>
    </form>
    HTML;

        return $html;

    }


}