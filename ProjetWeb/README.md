# ProjetWeb
Pour lancer le projet, il faut installer wamp 64, puis mettre le dossier comme source dans /wamp64/www.<br>
Il faut ensuite lancer phpmyadmin, y créer la database planning_db, puis lancer dans cette base de données les lignes suivantes en raw sql :
<br>
CREATE TABLE IF NOT EXISTS `ci_sessions` (<br>
        `id` varchar(128) NOT NULL,<br>
        `ip_address` varchar(45) NOT NULL,<br>
        `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,<br>
        `data` blob NOT NULL,<br>
        KEY `ci_sessions_timestamp` (`timestamp`)<br>
        );<br>
