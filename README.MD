# Blog en PHP  OpenClassrooms
![Logo](https://user.oc-static.com/upload/2016/11/17/1479381549985_shutterstock_385167373.jpg)
## Description du projet 
Projet n°5 de la formation [Développeur d'application - PHP / Symfony](https://openclassrooms.com/fr/paths/500-developpeur-dapplication-php-symfony#path-tabs).
## Description du besoin
Voici la liste des pages qui devront être accessibles depuis votre site web :
   - la page d'accueil 
   - la page listant l’ensemble des blog posts 
   - la page affichant un blog post 
   - la page permettant d’ajouter un blog post 
   - la page permettant de modifier un blog post 
   - les pages permettant de modifier/supprimer un blog post 
   - les pages de connexion/enregistrement des utilisateurs.
Vous développerez une partie administration qui devra être accessible uniquement aux utilisateurs inscrits et validés.

   Sur la page d’accueil, il faudra présenter les informations suivantes :
   -  votre nom et votre prénom ;
   -  une photo et/ou un logo ;
   -  une phrase d’accroche qui vous ressemble  ;
   -  un menu permettant de naviguer parmi l’ensemble des pages de votre site web ;
   -  un formulaire de contact (à la soumission de ce formulaire, un e-mail avec toutes ces informations vous sera envoyé) avec les champs suivants :
   nom/prénom,
   e-mail de contact,
   message,
   -  un lien vers votre CV au format PDF ;
   -  et l’ensemble des liens vers les réseaux sociaux où l’on peut vous suivre (GitHub, LinkedIn, Twitter…).
Sur la page listant tous les blogs posts (du plus récent au plus ancien), il faut afficher les informations suivantes pour chaque blog post :
   - le titre ;
   - la date de dernière modification ;
   - le chapô ;
   - et un lien vers le blog post.Sur la page présentant le détail d’un blog post, il faut afficher les informations suivantes :
   - le titre ;
   - le chapô ;
   - le contenu ;
   - l’auteur ;
   - la date de dernière mise à jour ;
   - le formulaire permettant d’ajouter un commentaire (soumis pour validation) ;
   - les listes des commentaires validés et publiés.

Sur la page permettant de modifier un blog post, l’utilisateur a la possibilité de modifier les champs titre, chapô, auteur et contenu.

Dans le footer menu, il doit figurer un lien pour accéder à l’administration du blog.
## Installation du projet
**Etape 1 : Cloner le Repository sur votre serveur.**

**Etape 2 : Créer Une base de données et importer le fichier "01blogoc.sql" qui se trouve a la racine du projet .**

**Etape 3 : Changer les informations de  connexion a la base de données .** 
```http 
chemin:  Src/DB/Database.php
$db_host = 'localhost';
$db_user = 'root' ;
$db_pass = '' ;
$db_name = '01Blogoc';
```

**Etape 4 : Changer les informations de configuration pour l'envoie de mail .** 
```http 
Src/Mail/Mailer.php
```

**Etape 5 : Créer vous un Compte , depuis votre base de données Changer votre role pour "ROLE_ADMIN" .**
😄 c'est terminer .
## Auteur
- [Darius Yvens ](https://github.com/yd67)

[![portfolio](https://img.shields.io/badge/my_portfolio-000?style=for-the-badge&logo=ko-fi&logoColor=white)](https://www.darius-yvens.com/)

[![linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://fr.linkedin.com/in/yvens-darius)
