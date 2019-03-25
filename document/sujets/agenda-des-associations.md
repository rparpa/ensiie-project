![matters](https://cdn-images-1.medium.com/max/2000/1*Pl-fB1X01RfcEbPP-FVlew.jpeg)

Agenda des associations
=====

Contexte du projet
-----

Les associations à l’écoles, ça nous connait. Le BdE, le bar, LudIIe, l’AS, ForumIIe, GalaxIIe etc. Et forcément, quand on est dans une association, on a besoin d’échanger de s’organiser et de se réunir.

Etant donné que beaucoup d’élèves sont de petits cumulars et il est parfois difficile d’organiser des réunions où tout le monde pourra être présent (et encore, sans compter la multitude de raisons personnelles qu’il peut y avoir).
Heureusement, l’agenda des associations sera bientôt là pour vous faciliter la vie. Grâce à cet agenda dédié aux associations vous pourrez savoir et gérer qui sera présent lors des réunions.

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

Proposer une application qui va permettre d’organiser les réunions / événements associatifs.

Dans ce projet il va falloir gérer, les élèves, les associations, les réunions et la participation des élèves à ces réunions.
Les associations auront des adhérents qui pourront être soit des membres soit des administrateurs. Nous vous laissons le soin de mettre en place le modèle relationnel de données.

Chaque élève pourra appartenir à une ou plusieurs associations, avec des rôles différents.

Chaque élève aura un agenda personnalisé de ses réunions / événements à venir.

> * Seuls les administrateurs des associations pourront créer des réunions
> * Les élèves pourront dire s’ils participent à une réunion.
> * Les status possibles des réunions seront Oui, Non, En attente de réponse.
> * Les élèves seront notifiés des nouvelles réunions auxquelles ils doivent répondre.

Si un élève a déjà une réunion à ce moment là, il en sera notifié (et ne pourra pas répondre présent aux deux réunions).

### Les difficultés du projet

La gestion des dates pourra aussi s’avérer être un challenge technique. Faites bien attention aux formats de dates que vous allez utiliser. Nous vous renvoyons vers PhpTheRightWay pour un premier aperçu de la gestion des dates en PHP.

Il faudra aussi penser un affichage propre de l’agenda.
Enfin, la gestion des statuts pourra s’avérer être un problème. Cela implique une gestion de droit au niveau de la participation aux réunions (qui peut être invité ?), mais aussi au niveau des administrateurs des associations qui seront les seuls à pouvoir créer des réunions ou événements.

### Propositions de features

Comme pour tous les projets, vous pouvez choisir de l’adapter / de l’étoffer tant que tous les pré-requis sont remplis. Vous pouvez choisir de faire un agenda sportif pour l’AS, un agenda des soirées etc.

Voici en exemple une petite liste de fonctionnalités qui pourraient être implémentées dans le cadre du projet :

> * Les administrateurs pourront voir l’agenda des réunions de toutes les associations.
> * Lorsqu’un administrateur crée une réunion, l’agenda lui propose les créneaux où > tous les membres de l’association sont disponibles.
> * Un système de notifications pour que les administrateurs soient au courant des > réponses de participation.
> * Un envoi de mail automatique avant une réunion pour un rappel.
> * Un mode réunion privée / réunion publique. En réunion privée, seuls les membres > pourront voir la réunion dans l’agenda, tandis que lors d’une réunion publique, tous > les élèves seront invités à participer (mais seuls les membres pourront répondre > présent ou non).
> * Un mode d’annulation automatique des réunions 24h avant si moins de X personnes > répondent présent.
> * Une synchronisation avec d’autres calendrier en ligne.

Ce sont ici bien évidemment des propositions de fonctionnalités supplémentaires, il y en a beaucoup d’autres qui pourraient être pertinentes dans le cadre du projet. Ces fonctionnalités dépendront des objectifs que vous souhaiterez donner à votre projet.

**Bon courage.**