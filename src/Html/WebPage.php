<?php

declare(strict_types=1);

namespace Html;

class WebPage
{
    private string $head = "";
    private string $title = "";
    private string $body = "";

    public function __construct(string $title = "")
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getHead(): string
    {
        return $this->head;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Ajouter un contenu dans $this->head.
     *
     * @param string $content
     * @return void
     */
    public function appendToHead(string $content): void
    {
        $this->head .= $content;
    }

    /**
     * Ajouter un contenu CSS dans $this->head.
     *
     * @param string $css
     * @return void
     */
    public function appendCss(string $css): void
    {
        $this->head .= "<style>\n" . $css . "\n</style>\n";
    }

    /**
     * Ajouter l'URL d'un script CSS dans $this->head.
     *
     * @param string $url
     * @return void
     */
    public function appendCssUrl(string $url): void
    {
        $this->head .= "<link rel='stylesheet' href='" . $url . "'>\n";
    }

    /**
     * Ajouter un contenu JavaScript dans $this->head.
     *
     * @param string $js
     * @return void
     */
    public function appendJs(string $js): void
    {
        $this->head .= "<script>\n" . $js . "\n</script>\n";
    }

    /**
     * Ajouter l'URL d'un script JavaScript dans $this->head.
     *
     * @param string $url
     * @return void
     */
    public function appendJsUrl(string $url): void
    {
        $this->head .= "<script src='" . $url . "'></script>\n";
    }

    /**
     * Ajouter un contenu dans $this->body.
     *
     * @param string $content
     * @return void
     */
    public function appendContent(string $content): void
    {
        $this->body .= $content;
    }

    /**
     * Produire la page Web complète.
     *
     * @return string
     */
    public function toHTML(): string
    {
        return "<!DOCTYPE html>\n<html lang=\"fr\">\n<head>\n<meta charset='UTF-8'>\n<meta name='viewport' content='width=device-width, initial-scale=1.0'>\n<title>" . $this->title . "</title>\n" . $this->head . "\n</head>\n<body>\n" . $this->body . "\n</body>\n</html>";
    }

    /**
     * Protéger les caractères spéciaux pouvant dégrader la page Web.
     *
     * @param string $string
     * @return string
     */
    public function escapeString(string $string): string
    {
        return htmlspecialchars($string, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    public function getLastModification(): string
    {
        date_default_timezone_set('Europe/Paris');
        return "Dernière modification : " . date("F d Y H:i:s.", getlastmod());
    }

    public function addKeywords(array $keywords): void
    {
        $chaineKeywords = "";
        foreach ($keywords as $key => $keyword) {
            if ($key == 0) {
                $chaineKeywords .= $keyword;
            } else {
                $chaineKeywords .= ", $keyword";
            }
        }
        $this->appendToHead("<meta name=\"keywords\" content=\"$chaineKeywords\">");
    }

    public function addDescription(string $description): void
    {
        $this->appendToHead("<meta name=\"description\" content=\"$description\">");
    }

    public function addAuthor($auteur): void
    {
        $this->appendToHead("<meta name=\"author\" content=\"$auteur\">");
    }

}
