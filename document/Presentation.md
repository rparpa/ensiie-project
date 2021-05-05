Projet web ENSIIE 2021
======

Objectif pédagogique
----------

>Apprendre à concevoir et développer des applications web utilisant un serveur de bases de données.
>Prendre conscience des problématiques d’organisation d’équipes et de répartition des tâches.


Les sujets
------------

Nous proposons trois sujets qui seront détaillés ultérieurement et présentés lors de la première séance :

* [Agenda des associations](sujets/agenda-des-associations.md)
* [Accueil des nouveaux arrivants](/sujets/accueil-des-nouveaux-arrivants.md)
* [Le twitter de l’ENSIIE](sujets/twittiie-le-twitter-de-ensiie.md)

PROJET LIBRE
-----

>Vous pouvez également proposer votre propre sujet. Celui-ci devra être défini, au plus tard, à la fin de la première séance et devra être validé.

Soyez imaginatifs ! Mais veillez, tout de même, à respecter les contraintes présentées ci-dessous. N’hésitez pas à imaginer des sujets qui pourraient vous servir (ou vos associations) au quotidien. Nous serons là pour vous accompagner au cours de la réalisation de ce projet, alors profitez-en !

Must have
-------

### Les sujets devront tous proposer **au minimum**

> * POO (design pattern, héritage)
> * Une authentification
> * Un compte administrateur donnant les droits à certaines fonctionnalités (au choix)
> * Un profil utilisateur éditable
> * Une base de données relationnelle :
> * au moins 3 tables
> * au moins une table de jointure ( n…n)
> * au moins une jointure dans une requête
> * des INSERT, DELETE, UPDATE, SELECT
> * Un CRUD (Create Read Update Delete)
> * Du javascript client (au minimum validation JS des formulaires)

Nous attendons de la part des élèves une véritable appropriation du sujet. Il ne suffira pas de remplir des cases à cocher pour avoir la moyenne, nous voulons voir une démarche d’ingénieur, pas d’exécutant.

### Les technologies

#### On oblige

> * PHP 7+ ou node 14
> * PostgreSQL
> * JavaScript client

#### On aimera

> * Toutes les bonnes pratiques citées sur http://www.phptherightway.com/
> * PHP 8.0+
> * Les tests automatisés (unitaires, fonctionnels, de sécurité, de performance, …)
> * Une API REST bien faite
> * Les animations CSS parcimonieuses qui profitent à l’UX

#### On n’aimera pas

* Le XML
* jQuery utilisé n’importe comment
* HTML5 utilisé n’importe comment

### Séances

> * **06 mai** : choix du sujet, début des projets, présentation de la stack
> * **20 mai** : point d’avancement, échange sur les bonnes pratiques, analyse du code
> * **3 juin** : point d’avancement, échange sur les bonnes pratiques, analyse du code
> * **18 juin** : soutenance, livraison des sources

### La notation

Une partie de la note sera attribuée par groupe, une autre réservée à l’investissement personnel.

> Les points auxquels nous ferons attention lors de la notation :
> * La méthodologie, quels vont être vos choix d’organisation ?
> * La participation au sein de l’équipe, on attend que vous soyez moteur et que vous soyez force de proposition.
> * La qualité technique du projet, nous voulons pouvoir comprendre votre code sans nous arracher les cheveux. Préférez peu de code bien fait avec des fonctionnalités complètes à une grosse quantité de code illisible, avec beaucoup de fonctionnalités copiées collées et/ou à moitié terminées.
> * La soutenance du projet, nous souhaitons voir une soutenance dynamique. Pas de présentation point par point afin de vérifier que oui il y a bien une inscription et ou un CRUD. On veut voir que ça marche, on veut être convaincu et on veut se l’arracher votre projet. Encore moins une lecture de votre rapport.
> * Le rapport du projet a un but complètement différent de la soutenance. La soutenance nous permet de voir le produit tel que vous avez imaginé son utilisation, le rapport nous permet de comprendre la partie interne du fonctionnement de votre groupe. Il est très important pour nous de bien comprendre quels ont été les enjeux de chaque groupe, quelles ont été les difficultés rencontrées et surtout quelles ont été les solutions trouvées pour les contourner.

### L’environnement de développement

Afin de s’affranchir de problème d’infrastructure, nous vous mettons à disposition un environnement de développement pour ce projet.
>Lors du premier cours nous vous présenterons l'utilisation du git que nous avons mis à votre disposition ainsi que le fonctionnement d'un Docker entièrement configuré et prêt à être utilisé pour développer votre projet.

### Le rendu des sources et du rapport

Une pull request devra être créée sur ce [repository git](https://github.com/rparpa/ensiie-project).

Aide : https://help.github.com/en/github/collaborating-with-issues-and-pull-requests/creating-a-pull-request

**ATTENTION**: ce repo git n'a pas pour but d'être utilisé pendant le développement. Il s'agit de notre outil pour récupérer vos projets et pouvoir les utiliser. L'utilisation d'un git au cours du développement n'est pas obligatoire, mais nous vous encourageons à en utiliser un (github, arise, ensiie, bitbucket, gitlab etc)/

> Le rapport doit être inclus dans les sources du projet, à la racine: ```/rapport.pdf```

Toutefois, il serait dommage de rester bloquer sur le rendu donc préparez-vous avant et contactez nous le plus tôt possible en cas de problème.

#### Le rapport

> * Faire 10 pages maximum pour refléter le monde de l’entreprise où la concision est une qualité
> * Expliquer l’approche mise en place, les problématiques rencontrées (techniques comme méthodes) et les solutions apportées
> * Expliquer la répartition des rôles au sein de l’équipe
> * La problématique à laquelle il répond.

#### La soutenance

Nous souhaitons simuler une séance plénière devant des investisseurs. Nous voulons que vous vous mettiez dans la peau d’une jeune startup devant vendre sa toute nouvelle application à un public d’investisseurs intéressés.
Ce format de soutenance sera aussi une bonne occasion de se faire une première expérience de communication autour d’un projet.

> * Présentation plénière (tous les groupes devant tout le monde)
> * 8 minutes par groupe, pas une minute de plus
> * Pure démo de l’application, pas de questions

L’objectif est de vendre l’application aux personnes dans la salle, mode start-up **ACTIVÉ**
La note de soutenance ne sera pas donnée le jour même

> **Tout le monde doit être présent lors des soutenances.**

Aussi, n’oubliez pas qu’on est là pour passer un bon moment, pas de lynchage, uniquement des critiques constructives. Nous comprenons également que le facteur stress peut jouer en votre défaveur en fonction de votre personnalité, aussi ne vous inquiétez pas car nous sommes conscients de cela et nous sommes là pour noter l’adéquation de chacun avec les attentes d’un ingénieur:

> * Méthode
> * Apprentissage
> * Qualité du travail rendu
> * Expression
> * Adaptabilité

### Présentation

* Remi Parpaillon : Back-end engineer chez Tenable / Alsid

### Comment nous contacter

* remi.parpaillon@protonmail.ch
