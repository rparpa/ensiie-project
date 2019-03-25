![matters](https://cdn-images-1.medium.com/max/2000/1*Pl-fB1X01RfcEbPP-FVlew.jpeg)

Twitiie le twitter de l'ENSIIE
=====

Contexte du projet
-------

Twitter ne pourra pas toujours conserver son statut de leader du marché en termes de communication sociale. Il est temps de mettre fin à ce monopole.
Je vous présente TwittIIe, l’application qui copie tout de twitter et qui va leur voler tout le marché.

### Pré-requis

Comme pour tous les sujets, on devra au moins retrouver dans l’application finale les parties suivantes :

> * Une authentification
> * Un compte administrateur donnant les droits à certaines fonctionnalités (au choix)
> * Un profil utilisateur éditable
> * Une base de données relationnelle :
> * au moins 3 tables
> * au moins une table de jointure ( n…n)
> * au moins une jointure dans une requête
> * des INSERT, DELETE, UPDATE, SELECT
> * Un CRUD (Create Read Update Delete)
> * Du javascript (au minimum validation JS des formulaires)

Nous attendons de la part des élèves une véritable appropriation du sujet. Il ne suffira pas de remplir des cases à cocher pour avoir la moyenne, nous voulons voir une démarche d’ingénieur, pas d’exécutant.

### Objectifs

Proposer une application qui va permettre aux utilisateurs de communiquer via des messages augmentés.

Dans ce projet il va falloir gérer, les élèves, les publications, les hashtags etc
Les utilisateurs auront un feed d’activité et un feed de leur propre activité (mur perso etc).

> * Les utilisateurs inscrits ont le droit de diffuser du contenu (limité en caractères, et avec un langage augmenté, émoticon, @, # ou autre)
> * Les utilisateurs inscrits peuvent s’abonner aux contenu d’autres utilisateurs. Ce contenu apparaîtra alors dans leur feed d’activité.
> * Les hashtag et les noms d’utilisateurs devront être cliquables afin de voir leur flux d’activité respectifs.
> * Les administrateurs peuvent supprimer les publications. Les utilisateurs doivent faire une demande de suppression qui s’affichera dans une notification pour les administrateurs (tant qu’elle n’a pas été supprimée).
> * Les utilisateurs peuvent ‘liker’ un message. Un contenu automatique pourrait alors être diffusé (tel utilisateur a ‘liké’ ce message, à diffuser sur le mur perso par exemple, ou sur une page dédiée).
> * Les utilisateurs peuvent répondre à un message (et répondre à la réponse etc).

Ce sont ici les features minimales que nous avons sélectionnées pour que le projet soit fonctionnel. Il conviendra de les adapter en fonction de la direction que vous souhaitez donner à votre projet.

### Les difficultés du projet

La première difficulté relative à ce sujet concernera évidement le parsing des messages afin de pouvoir rajouter des liens rapides vers les utilisateurs ou hastag. Attention à l’architecture de vos outils pour que le code soit propre.
Enfin, dans ce genre de projet à but social il y a beaucoup d’écrans qui présentent la même donnée mais agencée de différentes façons. Avoir un bon modèle relationnel vous aidera à manipuler la données facilement. Essayez de prévoir !

### Propositions de features

Comme pour tous les projets, vous pouvez choisir de l’adapter / de l’étoffer tant que tous les pré-requis sont remplis. Vous pouvez choisir de faire un agenda sportif pour l’AS, un agenda des soirées etc.

Voici en exemple une petite liste de fonctionnalités qui pourraient être implémentées dans le cadre du projet :

> * Du contenu automatique pourrait être proposé aux nouveaux utilisateurs en fonction de leur goût (ou n’importe quel autre critère).
> * La possibilité de partager le message de quelqu’un d’autre
> * La possibilité d’envoyer un message privée à quelqu’un. En réponse d’un autre message par exemple.
> * La possibilité de poster un message dans le futur. Ceci implique donc une bonne gestion des dates ainsi qu’une automatisation de l’envoi d’un post et d’une gestion de statut des messages.
> * La possibilité d’afficher du contenu d’un autre format, comme des gifs ou des vidéos.
> * Des accès rapides aux trendings topics (les hashtags sur lesquels il y a le plus d’activités).
> * Une suggestion automatique des utilisateurs lorsqu’on écrit un @ et/ou des hashtag lorsqu’on a un # qui s’adapte à ce que l’utilisateur écrit.
> * Ce sont ici bien évidemment des propositions de fonctionnalités supplémentaires, il y en a beaucoup d’autres qui pourraient être pertinentes dans le cadre du projet. Ces fonctionnalités dépendront des objectifs que vous souhaiterez donner à votre projet.

Ce sont ici bien évidemment des propositions de fonctionnalités supplémentaires, il y en a beaucoup d’autres qui pourraient être pertinentes dans le cadre du projet. Ces fonctionnalités dépendront des objectifs que vous souhaiterez donner à votre projet.

**Bon courage.**