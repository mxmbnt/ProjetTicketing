<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="style.css" />
        <title>Mon Ticketing</title>
    </head>
    <body>
        <div id="global">
            <header>
                <a href="index.php"><h1 id="titreBlog">Mon Ticketing</h1></a>
                <p>Je vous souhaite la bienvenue sur ce modeste ticketing.</p>
            </header>
            <div id="contenu">
                <?php
                $bdd = new PDO('mysql:host=localhost;dbname=monticketing;charset=utf8',
                        'monticketing', 'password');
                $billets = $bdd->query('select TIC_ID as id, TIC_DATE as date,'
                        . ' TIC_LIB as titre, TIC_DESC as contenu, ET_LIB as etlib from T_TICKET join ETAT on ETAT.ET_ID=T_TICKET.ET_ID'
                        . ' order by TIC_ID desc');
                foreach ($billets as $billet):
                    ?>
                    <article>
                        <header>
                            <h1 class="titreBillet"><?= $billet['titre'] ?></h1>
                            <time><?= $billet['date'] ?></time>
                        </header>
                        <p><?= $billet['contenu'] ?></p>
                        <p><?=$billet['etlib'] ?></p>
                    </article>
                    <hr />
                <?php endforeach; ?>
            </div> <!-- #contenu -->
            <footer id="piedBlog">
                Blog réalisé avec PHP, HTML5 et CSS.
            </footer>
        </div> <!-- #global -->
    </body>
</html>