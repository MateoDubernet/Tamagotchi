# Tamagotchi

## Contexte

### Description
Ceci est un projet réaliser en groupe dans le cadre d'un devoir maison, il s'agit d'une implémentation en PHP d'un système de **Tamagotchi virtuel**.  
Chaque utilisateur peut créer, gérer et interagir avec son Tamagotchi qui possède différents états.

---

## Prérequis

- Php
- Composer
- MySQL

---

## Installation et Lancement

### 1. Cloner le projet
```bash
   git clone https://github.com/MateoDubernet/Tamagotchi.git
```

### 2. Aller sur le projet
```bash
   cd Tamagotchi
```

### 3. Installer les dépendances
```bash
    composer install
```

### 4. Configuration
Dans le fichier database/database.php ($config) changer les informations de connexions à la base de données avec celles adapter

### 5. Lancement
```bash
    php -S localhost:8000 -t .
```

Une fois le projet lancer, entrer dans le navigateur l'adresse suivante : localhost:8000

---

## Fonctionnalités

### 1. Authentification
Un utilisateur doit s’authentifier pour pouvoir créer ou interagir avec un Tamagotchi.

- Inscription : via register.php
- Connexion : via login.php

Les données sont stockées dans la table users.

### 2. Gestion des tamagotchis
- Un utilisateur peut créer un tamagotchi en appuyant sur "créer un tamago", cela va créer automatiquement un tamago et rediriger l'utilisateur vers la liste de c'est tamagotchi.
- Après 9 actions, un Tamagotchi monte de 1 niveau et le compteur repart à zéro.
- Si un besoin tombe à 0 (faim, soif, sommeil, ennui), le Tamagotchi passe en état mort.
