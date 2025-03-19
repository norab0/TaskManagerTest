# Gestion de Tâches - Application

## Description

Ce projet est une application de gestion de tâches permettant à un utilisateur d'ajouter, afficher et supprimer des tâches. L'application inclut un ensemble complet de tests pour valider son bon fonctionnement, y compris des tests unitaires, des tests end-to-end (E2E), des tests de performance et des tests de non-régression.

## Outils Utilisés

Les tests pour cette application ont été réalisés en utilisant les outils suivants :

- **PHPUnit** : Utilisé pour les tests unitaires et fonctionnels.
- **Selenium** : Utilisé pour les tests de bout en bout (E2E), simulant l'interaction d'un utilisateur avec l'application.
- **K6** : Outil de test de performance pour simuler des charges d'utilisateurs et analyser les performances de l'application.
- **Docker** : Utilisé pour gérer les environnements de développement et de test de manière isolée.

## Prérequis

Avant d'exécuter l'application, assurez-vous d'avoir installé les outils suivants :

- [Docker](https://www.docker.com/) pour la gestion des environnements.
- [PHP](https://www.php.net/) pour exécuter PHPUnit.
- [Composer](https://getcomposer.org/) pour gérer les dépendances PHP.
- [K6](https://k6.io/) pour les tests de performance.
- [Selenium](https://www.selenium.dev/) pour exécuter les tests end-to-end.

## Installation et Exécution

### Lancer l'Environnement Docker

Pour configurer l'environnement nécessaire à l'exécution des tests et de l'application avec Docker, exécutez la commande suivante :

```bash
docker-compose up --build
```

Cette commande lance tous les services nécessaires à l'application et aux tests, en créant des conteneurs isolés pour chaque service.

### Installer les Dépendances PHP

Si vous n'utilisez pas Docker pour PHP, installez les dépendances PHP manuellement via Composer :

```bash
composer install
```

### Exécuter l'Application

Démarrez l'application sur votre serveur local en suivant les instructions spécifiques à votre environnement.

## Exécution des Tests

### 1. Tests Fonctionnels (PHPUnit)

Les tests unitaires vérifient que les fonctions de base de l'application fonctionnent comme prévu, notamment l'ajout, l'affichage, la suppression de tâches, et la gestion des erreurs.

Exécutez les tests unitaires avec PHPUnit :

```bash
phpunit --configuration phpunit.xml
```

### 2. Tests End-to-End (E2E) avec Selenium

Les tests E2E simulent des interactions réelles d'un utilisateur avec l'application pour valider les principaux flux utilisateurs.

### 3. Tests de Performance avec K6

Un test de charge simule l'ajout et la suppression de tâches par 50 utilisateurs simultanés pendant 5 minutes pour tester la capacité de l'application à supporter une charge élevée.

#### Exécution avec Docker

Voici le `Dockerfile` pour exécuter les tests de performance avec K6 dans un environnement Docker :

```dockerfile
# Utiliser l'image officielle de k6
FROM grafana/k6

# Définir le répertoire de travail
WORKDIR /usr/src/app

# Copier le script de test dans le conteneur
COPY . .

# Exécuter k6 avec le script de test
ENTRYPOINT ["k6", "run", "/usr/src/app/test.js"]
```

#### Script de Test K6

Le fichier `test.js` contient le script de test pour simuler des requêtes HTTP vers l'application. Voici un exemple :

```javascript
import http from "k6/http";
import { check, sleep } from "k6";

// Configuration du test
export const options = {
  thresholds: {
    // Vérifier que 99% des requêtes prennent moins de 3s
    http_req_duration: ["p(99) < 3000"],
  },
  stages: [
    { duration: "30s", target: 50 }, // Monter à 50 utilisateurs en 30s
    { duration: "1m", target: 50 },  // Maintenir 50 utilisateurs pendant 1 minute
    { duration: "20s", target: 0 },  // Redescendre à 0 en 20s
  ],
};

// Comportement simulé des utilisateurs
export default function () {
  let res = http.get("http://host.docker.internal:8000/");  // Utiliser l'URL de l'hôte pour accéder à l'application

  // Vérification du statut HTTP
  check(res, { "status was 200": (r) => r.status === 200 });
  
  sleep(1); // Pause entre chaque requête
}
```

#### Exécution du Test de Performance

Pour exécuter le test de performance avec K6, utilisez les commandes suivantes :

```bash
docker build -t k6-test .
docker run k6-test
```

### 4. Tests de Non-Régression

Les tests de non-régression garantissent que les nouvelles fonctionnalités n'ont pas causé de régressions dans les fonctionnalités existantes. Ces tests sont effectués après chaque ajout ou modification majeure.

## Conclusion

Les tests effectués sur l'application ont validé son bon fonctionnement sur plusieurs aspects essentiels. Les tests fonctionnels, E2E et de non-régression ont confirmé que toutes les fonctionnalités principales sont bien opérationnelles. Les tests de performance ont montré que l'application peut supporter un grand nombre d'utilisateurs, mais des ajustements sont nécessaires pour améliorer la gestion des connexions et réduire les erreurs de timeout.

---

**Réalisé par :** Nora Boudarbala  
**Date :** 19/03/2025

