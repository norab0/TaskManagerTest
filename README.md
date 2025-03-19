# Gestion de Tâches - Application

## Description

Ce projet est une application de gestion de tâches permettant à un utilisateur d'ajouter, afficher et supprimer des tâches. L'application inclut un ensemble complet de tests pour valider son bon fonctionnement, y compris des tests unitaires, des tests end-to-end (E2E), des tests de performance et des tests de non-régression.

## Outils Utilisés

Les tests pour cette application ont été réalisés en utilisant les outils suivants :

- **PHPUnit** : Utilisé pour les tests unitaires et fonctionnels.
- **Selenium** : Utilisé pour les tests de bout en bout (E2E), simulant l'interaction d'un utilisateur avec l'application.
- **K6** : Outil de test de performance pour simuler des charges d'utilisateurs et analyser les performances de l'application.
- **Docker** : Utilisé pour gérer les environnements de développement et de test de manière isolée.

## Installation

### Prérequis

Avant d'exécuter l'application, assurez-vous d'avoir installé les outils suivants :

- [Docker](https://www.docker.com/) pour la gestion des environnements.
- [PHP](https://www.php.net/) pour exécuter PHPUnit.
- [Composer](https://getcomposer.org/) pour gérer les dépendances PHP.
- [K6](https://k6.io/) pour les tests de performance.
- [Selenium](https://www.selenium.dev/) pour exécuter les tests end-to-end.

### Étapes d'Installation

1. **Cloner le dépôt**

   Clonez le projet en utilisant Git :

   ```bash
   git clone https://github.com/norab0/TaskManagerTest.git
   cd TaskManagerTest
