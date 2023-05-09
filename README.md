# App web music
## William PEOC'H
## Installation configuration

Lancer serveur 

    php -d display_errors -S localhost:8000 -t public/

ou

    composer linux:start

### Style de codage

Recherche « fixer » dans les paquets Composer

    composer search fixer

Demande la dépendance de développement sur « friendsofphp/php-cs-fixer »

    composer require friendsofphp/php-cs-fixer --dev

Vérification du bon fonctionnement de PHP CS Fixer

    php vendor/bin/php-cs-fixer

Test à blanc de php cs fixer

    php vendor/bin/php-cs-fixer fix --dry-run

ou

    composer test:cs

Vérification différence entre les lignes actuellement mauvaise et les lignes corrigés 

    php vendor/bin/php-cs-fixer fix --dry-run --diff

Correction des lignes

    php vendor/bin/php-cs-fixer fix

ou

    composer fix:cs


### Configuration de la base de données

Utilisation du fichier .mypdo.ini ou sont enregistrer les informations nécessaires à la connexion à la base de données

### Tests

Test Crud

    composer test:crud

Lancer l'ensemble des tests de Codeception

    composer test:codecept

Lancer les tests de correction de lignes et ceux de Codeception

    composer test

