# ProjetWeb
Pour lancer le projet, il faut installer wamp 64, puis mettre le dossier comme source dans /wamp64/www.
Il faut ensuite lancer phpmyadmin, y créer la database planning_db, puis lancer dans cette base de données les lignes suivantes en raw sql :
<br>
CREATE TABLE IF NOT EXISTS `ci_sessions` (
        `id` varchar(128) NOT NULL,
        `ip_address` varchar(45) NOT NULL,
        `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
        `data` blob NOT NULL,
        KEY `ci_sessions_timestamp` (`timestamp`)
        );
