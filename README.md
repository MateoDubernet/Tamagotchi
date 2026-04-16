# Tamagotchi

## Présentation
Ceci est un projet réaliser en groupe dans le cadre d'un devoir maison, il s'agit d'une implémentation d'un système de **Tamagotchi virtuel**.
Chaque utilisateur peut créer, gérer et interagir avec son Tamagotchi qui possède différents états.

### Stack Technique
- **PHP**
- **Docker**

---

## Installation et Lancement
### 1. Clonage du dépôt
```bash
   git clone https://github.com/MateoDubernet/Tamagotchi.git
```

### 2. Lancement (Docker)
**Prérequis :** [Docker Desktop](https://www.docker.com/products/docker-desktop) installé et lancé.

[!IMPORTANT]
Assurez-vous que le port 80 n'est pas déjà utilisé par une autre application sur votre machine avant de lancer le conteneur.

```bash
    cd ./Tamagotchi
    docker-compose up --build
```

### 3. Accès
Ouvrir un navigateur web et aller à l'adresse: http://localhost

---

## Fonctionnalités
1. Authentification

2. Un utilisateur peut créer un tamagotchi en appuyant sur "créer un tamago", cela va créer automatiquement un tamago et rediriger l'utilisateur vers la liste de c'est tamagotchi.

3. Après 9 actions, un Tamagotchi monte de 1 niveau et le compteur repart à zéro.

4. Si un besoin tombe à 0 (faim, soif, sommeil, ennui), le Tamagotchi passe en état mort.
