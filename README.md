# README - Projet BTS SIO Hackathon

Bienvenue sur le projet Hackathon du BTS SIO. Ce projet utilise le framework Laravel en suivant le modèle MVC pour créer un site web interactif qui exploite les données Open Data du gouvernement relatives aux délits par département. L'objectif principal est de fournir des statistiques visuelles sur ces délits en utilisant la librairie Chart.js pour les graphiques et la librairie Leaflet.js pour la sélection des départements.

## Prérequis

Avant de commencer, assurez-vous d'avoir les éléments suivants installés :

- PHP
- Composer
- Node.js
- NPM

## Installation

1. Clonez ce dépôt sur votre machine locale :

   ```bash
   git clone https://github.com/votre-utilisateur/nom-du-projet.git

    Installez les dépendances PHP via Composer :

    bash

composer install

Installez les dépendances JavaScript via NPM :

bash

npm install

Renommez le fichier .env.example en .env et configurez les informations de base de données ainsi que d'autres variables d'environnement selon vos besoins.

Générez une clé d'application Laravel :

bash

php artisan key:generate

Exécutez les migrations pour créer les tables de base de données :

bash

php artisan migrate

Compilez les ressources frontales :

bash

    npm run dev

Utilisation

Une fois que vous avez terminé l'installation, vous pouvez démarrer le serveur de développement en utilisant la commande :

bash

php artisan serve

Cela démarrera un serveur local à l'adresse http://localhost:8000.
Fonctionnalités

    Visualisation des statistiques : Le site affiche des graphiques interactifs basés sur les données des délits par département, permettant aux utilisateurs de comprendre rapidement les tendances et les différences entre les régions.

    Sélection des départements : Les utilisateurs peuvent sélectionner un département spécifique sur une carte interactive générée par Leaflet.js, ce qui leur permet de voir les statistiques détaillées pour ce département.

Contribution

Si vous souhaitez contribuer à ce projet, n'hésitez pas à soumettre des pull requests ou à ouvrir des issues pour signaler des problèmes ou suggérer des améliorations.
Auteurs

Ce projet a été développé dans le cadre du BTS SIO Hackathon par Votre Nom et Autre Auteur.
