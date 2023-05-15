<?php

declare(strict_types=1);

namespace Html;

class AppWebPage extends WebPage
{
    public function __construct(string $title = "")
    {
        parent::__construct($title);
        $this->appendCssUrl('css/style.css');
    }

    public function toHTML(): string
    {
        $html = <<<HTML
        <!DOCTYPE html>
        <html lang='fr'>
        <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        HTML;

        $html .= "<title>". parent::getTitle() ."</title>\n";
        $html .= parent::getHead();

        $html .= <<<HTML
        </head>
        <body>
        <header class='header'>
        HTML;

        $html .= "\n<h1>" . parent::getTitle() . "</h1>\n";
        $html .= <<<HTML
        </header>
        HTML;
        $html .= "\n<main class='content'>\n" . parent::getBody() . "</main>\n";

        $html .= "<footer class='footer'>". parent::getLastModification() ."</footer>";

        $html .= <<<HTML
        </body>
        </html>
        HTML;

        return $html;
    }
}
