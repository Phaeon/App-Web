<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="views/stylesheets/style.css" />
        <title><?= $title ?></title>
        <script src="views/scripts_js/match.js" defer></script>
        <?= $scripts ?>

    </head>
    <body>

        <div id="global">
            <?= $content ?>
        </div>
    </body>
</html>