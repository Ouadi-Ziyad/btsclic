# 🎲 BTSClic - Plateforme de Paris

## 📖 À propos du projet
**BTSClic** est un projet de développement web "fil rouge" dont l'objectif final est de créer une plateforme où les utilisateurs pourront parier les uns contre les autres en gagnant de la monnaie virtuelle. Ce site complet se construira étape par étape.

Ce dépôt correspond à la toute première étape de l'application (la Mission 2.1) : la mise en place d'un système de comptes et de connexion sécurisé. C'est la fondation indispensable avant de pouvoir gérer l'argent virtuel et les paris.

## ✨ Fonctionnalités actuelles
Pour le moment, l'application se concentre sur l'accueil et l'identification des joueurs :
* **Création de compte :** Les nouveaux visiteurs peuvent s'inscrire en choisissant un nom d'utilisateur et un mot de passe.
* **Sécurité des données :** Les mots de passe sont protégés et cryptés (hachés) avant d'être sauvegardés, garantissant la confidentialité des joueurs.
* **Connexion intelligente :** Une fois connectés, le site reconnait les utilisateurs grâce à un système de "sessions", leur évitant de devoir retaper leurs identifiants à chaque action.
* **Annuaire communautaire :** Un espace permet de voir la liste de tous les utilisateurs déjà inscrits sur la plateforme.

## 🎓 Contexte académique
Ce projet est développé dans le cadre de ma première année de **BTS SIO (Services Informatiques aux Organisations) - spécialité SLAM** (Solutions Logicielles et Applications Métiers). 

Cette mission spécifique a pour but de valider des compétences techniques concrètes :
* La maîtrise du langage de programmation PHP.
* La manipulation sécurisée d'une base de données SQL.
* La gestion des sessions utilisateurs sur le web.

## 🛠️ Comment tester le projet chez vous ?
*Note : Ce projet nécessite un environnement de développement web local pour fonctionner (nous recommandons Laragon, qui est particulièrement adapté et facile à configurer).*

1. **Téléchargez ou clonez** le code source de ce dépôt.
2. **Placez** le dossier du projet dans le répertoire racine de votre serveur local (par exemple, le dossier `www` si vous utilisez Laragon).
3. **Préparez la base de données :** Ouvrez votre gestionnaire de base de données, créez une base nommée `btsclic` et exécutez le code SQL fourni dans le projet pour initialiser la table des utilisateurs.
4. **Lancez le projet :** Ouvrez votre navigateur et accédez à l'adresse locale du projet (par exemple, `http://btsclic.test`). Vous pouvez maintenant créer un compte !
