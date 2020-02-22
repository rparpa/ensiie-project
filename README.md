# Park-ton-char

> Un site web pour localiser toutes les places de stationnement  autour de vous ou à une adresse donnée  

Il fonctionne dans tout Paris et sera étendu dans d'autres villes prochainement :)

Il vous permet de rechercher un emplacement selon le gabarit de votre véhicule, 
de le visualiser et de lancer la navigation pour vous y rendre avec votre application
GPS favorite.

Ce site utilise les [données ouvertes de la ville de Paris](https://opendata.paris.fr)

## Usage
### Mise a jour des variables d'environnement
A la racine du projet vous trouverez le fichier .env contenant la déclaration des variables 
d'environnement nécessaires au projet. 

Editer le fichier .env

Mettre à jour les variables **DOCKER_USER_ID** et **REMOTE_HOST**

### Installation

Pour construire les images Docker et les lancer, taper la commande:

`make install`

### Actions possibles avec le Makefile 

- `make help` : Affiche l'aide du Makefile
- `make install` : Construit les Docker et installe et lance l'application
- `make uninstall` : Supprime les Docker et désinstalle l'application
- `make reinstall` : Réinstalle l'application
- `make start` : Lance les Docker s'ils existent déjà
- `make stop` : Arrête et supprime les Docker
- `make npm.install` : Installe les dépendances javascript nécessaires au projet
- `make npm.uninstall` : Supprime les dépendances javascript
- `make db.connect` : Se connecte au Docker de la base de données

### Stack technique
- Côté Back:
    + Express
    + Postgresql
    
- Côté Front:
    + Vue.js
    + Mapbox
    + Bootstrap

### Licence
Copyright 2020 - Adelino ARAUJO, Geoffrey DELVAL, Rémi GUIJARRO-ESPINOZA, François SAINTIER

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
