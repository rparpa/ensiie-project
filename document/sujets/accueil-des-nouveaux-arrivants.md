![matters](https://cdn-images-1.medium.com/max/2000/1*Pl-fB1X01RfcEbPP-FVlew.jpeg)

Accueil des petits nouveaux
======

Contexte du projet
-----

Les premiers jours à Evry, c’est pas toujours facile. On arrive dans une toute nouvelle ville, on ne connait personne, et la seule chose que l’on a à faire c’est d’aller à l’école.

La vie serait tellement plus simple si les élèves s’entraidaient un peu plus pour échanger sur tout ce qu’il y a à savoir. Connaître les endroits importants dans la ville, connaître la répartition des salles de l’école, qui contacter lorsqu’on a tel ou tel problème, où retrouver le planning de l’école, comment fonctionne le bar, etc.

### Pré-requis
Comme pour tous les sujets, on devra au moins retrouver dans l’application finale les parties suivantes :

> * Une authentification
> * Un compte administrateur donnant les droits à certaines > * fonctionnalités (au choix)
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

Proposer une application qui va permettre d’assigner des élèves comme tuteurs d’autres nouveaux élèves et suivre leur découverte de la ville d’Evry et du fonctionnement de l’école.

L’application devra donc gérer, un ensemble d’élèves, d’achievement, de types d’élèves, de types d’achievement.
Les élèves pourront être des nouveaux arrivants, des administrateurs ou des tuteurs.
Pour qu’un élève soit tuteur, il faut qu’il ait déjà été onboardé par d’autres tuteurs.

Les administrateurs pourront désigner des élèves comme étant des tuteurs (pour l’initialisation principalement).
Lorsqu’un nouvel arrivant s’inscrit, une liste d’achievement lui est automatiquement assignée ainsi que plusieurs tuteurs.

Les nouveaux arrivants pourront attribuer un status à unachievement.
Une fois que la liste d’achievement est complètement finie, le nouvel arrivant se voit promu au rang de tuteur et pourra être assigné à l’accueil d’un autre élève.
Comme les nouveaux arrivants arrivent en masse, il faudra prévoir un système permettant d’importer une liste d’élèves (leur assigner un mot de passe, les achievement, les tuteurs).

Certains achievement devront nécessiter des compétences spécifiques afin de pouvoir être faites (la présentation arise par exemple). Les tuteurs auront donc des compétences qui leur permettront de faire réaliser certains achievement avec les nouveaux arrivants. La validation d’un achievement nécessitant des compétences particulières n’est possible que si au moins 1 un des tuteurs possède cette compétence.

### Les difficultés du projet

Une gestion propre des status des élèves et des achievement nous permettra de voir clair dans les intentions que vous allez donner à ce projet. Faites bien attention à la syntaxe des status et soyez stratégique dans votre implémentation afin d’avoir un code propre. On se mêle rapidement les pinceaux.

La gestion de déclenchement automatique peut s’avérer un problème. Il faudra bien vous mettre d’accord sur ce qui se passe et à quel moment.
Si l’algorithme d’attribution automatique d’achievement n’est pas extrêmement complexe, l’attribution automatique des tuteurs tout en gérant les compétences requises pour la réalisation des achievement pourra s’avérer être un exercice plus difficile. Attention ici à bien faire les choses dans l’ordre (et proprement :)).

### Propositions de features

Comme pour tous les projets, vous pouvez choisir de l’adapter / de l’étoffer tant que tous les pré-requis sont remplis.

Voici en exemple une petite liste de fonctionnalités qui pourraient être implémentées dans le cadre du projet :

> * La gestion des compétences des étudiants par les administrateurs / autres tuteurs.
> * La possibilité d’avoir différentes listes d’achievements initiaux en fonction de l’élève. Peut-être y aura-t-il différente chose à faire pour accueillir un élève en milieu d’année qu’en début d’année. Ou il y aura d’autres choses à montrer aux arrivants étrangers, aux FIPAS etc.
> * La gestion des promotions. Les étudiants appartiennent à une promotion. Gérer les changements de promo.
> * Le suivi de l’avancée de l’accueil d’une promo. Une page permettant de savoir quels élèves ont quels tuteurs et où ils en sont de l’avancée de leur onboarding.
> * Ce sont ici bien évidemment des propositions de fonctionnalités supplémentaires, il y en a beaucoup d’autres qui pourraient être pertinentes dans le cadre du projet. Ces fonctionnalités dépendront des objectifs que vous souhaiterez donner à votre projet.

**Bon courage.**
