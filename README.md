# Page de Quiz en PHP

## Membres
- Muhamad Zaiinizee BIN DAIVIN  
- Raphael Cochet  
- Amin EL-MELLOUKI  

## Instructions pour lancer l'application

1. Naviguez jusqu'au dossier `public` de votre projet.  
2. Exécutez la commande suivante dans un terminal :  
   ```bash
   php -S localhost:8000

## Fonctionnalités

1. **Organisation du code**  
   - Structure organisée et arborescence cohérente pour une gestion claire du projet.

2. **Utilisation des namespaces**  
   - Simplifie la gestion des classes et évite les conflits de noms.

3. **Chargement des questions et réponses**  
   - Un provider dédié permet de charger un fichier JSON contenant les questions et leurs réponses.

4. **Chargement automatique des classes**  
   - Utilisation d’un autoloader pour inclure automatiquement toutes les classes nécessaires.

5. **Gestion des sessions**  
   - Les réponses des utilisateurs sont enregistrées dans des sessions pour permettre le calcul des scores en temps réel.

6. **Programmation orientée objet (POO)**  
   - Utilisation de classes PHP pour un code modulaire, réutilisable et facile à maintenir.

7. **Contrôleur avec GET['action']**  
   - L'application est pilotée par un contrôleur dans `index.php`, utilisant le paramètre `GET['action']` pour déterminer les actions.

8. **Stockage des scores avec PDO et SQLite**  
   - Les scores et noms des joueurs sont stockés dans une base de données SQLite avec une gestion sécurisée via PDO.

9. **Système de login et gestion des utilisateurs (optionnel)**  
   - Une fonctionnalité additionnelle pour permettre la gestion des utilisateurs, incluant un système de connexion sécurisé.
