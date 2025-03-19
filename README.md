# Rapport de Validation et Tests d'une Application de Gestion de Tâches

## 1. Introduction

L'application testée est une application de gestion de tâches permettant à un utilisateur d'ajouter des tâches, de les visualiser et les supprimer.

Les outils utilisés pour les tests sont les suivants :

- **PHPUnit** pour les tests unitaires et fonctionnels.
- **Selenium** pour les tests end-to-end (E2E).
- **K6** pour les tests de performance.
- **Docker** pour la gestion des environnements de développement et des tests.

L’objectif de ce rapport est de documenter les tests effectués sur l’application. Les différents types de tests réalisés sont :

- **Tests fonctionnels** : Tests unitaires pour vérifier que les fonctions de base du système fonctionnent comme prévu.
- **Tests E2E** : Tests simulant l’interaction d’un utilisateur avec l’application.
- **Tests de non-régression** : Vérification que les nouvelles modifications n’ont pas impacté les fonctionnalités existantes.
- **Tests de performance** : Tests pour mesurer la capacité de l’application à supporter un nombre d’utilisateurs élevé.

## 2. Résultats des Tests

### 2.1 Tests Fonctionnels (PHPUnit)

Les tests fonctionnels ont été réalisés en utilisant PHPUnit pour tester les différentes fonctions de l’application.

#### Tableau des résultats des tests unitaires :

| Test | Résultat |
|------|----------|
| TestRemoveTask() | Succès |
| TestGetTasks() | Succès |
| TestGetTask() | Succès |
| TestAddTask() | Succès |
| TestRemoveInvalidIndexThrowsException() | Succès |
| TestGetInvalidIndexThrowsException() | Succès |
| TestTaskOrderAfterRemoval() | Succès |

### 2.2 Tests End-to-End (E2E) avec Selenium

Le scénario testé consiste à ajouter une tâche, à afficher les tâches, et à les supprimer.

#### Tableau des résultats des tests E2E :

| Étape | Résultat |
|-------|----------|
| Add task | Succès |
| Show added tasks | Succès |
| Delete task | Succès |

### 2.3 Tests de Non-Régression

Les tests de non-régression ont été effectués après l'ajout d'une nouvelle fonctionnalité, à savoir la possibilité d'ajouter une date de publication lors de l'ajout d'un livre.

#### Tableau des résultats des tests de non-régression :

| Fonctionnalité | Avant modification | Après modification |
|----------------|--------------------|--------------------|
| Add task | OK | OK |
| Show added tasks | OK | OK |
| Delete task | OK | OK |

#### Analyse des régressions :

Aucune régression n’a été détectée dans les fonctionnalités existantes après la modification. Toutes les fonctionnalités ont été vérifiées et fonctionnent comme prévu.

### 2.4 Tests de Performance avec k6

Un test de charge a été effectué pour simuler l’ajout et la suppression par 50 utilisateurs simultanés pendant une durée de 5 minutes.

#### Tableau des résultats des tests de performance :

Graphiques des performances :

(Insérer ici les graphiques ou résultats de performance obtenus)

#### Analyse des performances :

Le temps de réponse moyen est moyen (3.15 ms), mais quelques erreurs de timeout (0.44%) et des pics de latence élevés (jusqu'à 39.31 ms) ont été observés.

## 3. Problèmes détectés et solutions proposées

### Problème 1 :

Des erreurs i/o timeout ont été observées, indiquant que certaines requêtes vers http://host.docker.internal:8000/ ont échoué.

### Solution proposée :

Nous allons limiter le nombre d'utilisateurs simultanés lorsque la réponse de la requête renvoie un code différent de 200, afin de réduire la surcharge et éviter les timeouts.

## 4. Conclusion

En conclusion, les tests effectués sur l'application de gestion de tâches ont permis de valider son bon fonctionnement sur plusieurs aspects essentiels. Les tests fonctionnels, E2E et de non-régression ont confirmé que toutes les fonctionnalités principales de l'application, telles que l'ajout, la suppression et l'affichage des tâches, sont bien opérationnelles. En revanche, des problèmes de performance ont été observés, notamment des erreurs de timeout liées à la surcharge du serveur. Afin d'améliorer la stabilité de l'application sous une forte charge, des ajustements seront nécessaires sur la gestion des connexions et l'analyse des requêtes lentes.

---

**Réalisé par :** Nora Boudarbala  
**Date :** 19/03/2025
