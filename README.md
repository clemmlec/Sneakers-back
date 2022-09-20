# Sneakers-back

Api REST en Symfony 6 pour un projet de formation

![GitHub top language](https://img.shields.io/github/languages/top/clemmlec/Sneakers-back)
![GitHub language count](https://img.shields.io/github/languages/count/clemmlec/Sneakers-back)

Prérequi 

  - PHP Version 8.1 Installé en local
  - MySQL Installé en local
  - Installer Composer
  - Installer Yarn
  
 Installation
 
  Après avoir cloné le projet éxécutez les commandes suivante dans un terminal à la racine du dossier : 

    composer install  ( installer les dépendances composer du projet )

    yarn install      ( installer les dépendances yarn du projet )

  Ensuite installer la base de donnée MySQL et paramétrer la création de votre base de donné :
  
  - dans le fichier .env du projet modifier la variable d'environnement selon vos paramètres :
    
      DATABASE_URL="mysql://root:root@127.0.0.1:3307/api_images?serverVersion=5.7&charset=utf8mb4"

  Puis créer de la base de donnée avec la commande : 
  
    php bin/console doctrine:database:create

  Exécuter la migration en base de donnée : 
    
    php bin/console doctrine:migration:migrate

Pour lancer le server local :

    symfony server:start
  
Les différentes routes :

  méthode GET
  
    - https//127.0.0.1:3307/sneakers
      -> renvoie un tableau de tous les articles
      
    - https//127.0.0.1:3307/sneakers/id
      -> renvoie l'article selectioné 
      
  méthode POST
  
    - https//127.0.0.1:3307/sneakers
      -> crée un nouvel article
   
  méthode PUT
  
    - https//127.0.0.1:3307/sneakers/id
      -> modifie l'article selectioné 
  
  méthode DELETE
  
    - https//127.0.0.1:3307/sneakers/id
      -> supprime l'article selectioné 
      
      
