# Application Web - Convocations sportives

Ceci est une application créée par deux étudiants de l'université d'Angers, dans le cadre de l'UE Développement Web.

Cette application est destinée à la gestion d'un club sportif, que cela soit la gestion des joueurs et de leurs absences, des matchs à suivre, ou encore des convocations. Celle-ci s'appuie sur un calendrier des rencontres, un effectif des joueurs ainsi qu'un planning d'absences.

Langages et bibliothèques utilisés : PHP, Javascript, Ajax, MySQL

### Pré-requis

Vous aurez plusieurs choses à installer et à prévoir...

- Un serveur local (WAMP/MAMP/LAMP) ou un serveur web HTTP quelconque
- Avoir une version PHP supérieure à la 7.4
- Un outil de bases de données (phpMyAdmin, MySQL...)
- Privilégiez Google Chrome ou Firefox



### Comment bien installer l'application ?

1. Installez votre serveur Web
2. Dans les fichiers sources de votre serveur, importez le dossier AppWeb
3. Accedez à votre base de données de votre serveur web (login/mot de passe par défaut pour phpMyAdmin : root/root)
Dans le cas où root n'est pas votre identifiant, pensez à changer le login ainsi que le mot de passe dans le fichier source `AppWeb/models/Model.php`, sinon, les différentes requêtes de l'application ne fonctionneront pas.
4. Importez le script sql `creation_db` situé dans le dossier `AppWeb/scripts_sql` afin de créer la base de données et les tables associées. Si tout se passe bien, vous ne devriez voir que des cadres verts indiquants que chaque requête a été correctement exécutée.
5. Vous pouvez commencer à créer un rôle administrateur pour vous ou pour une autre personne
6. Le fichier `AppWeb/admin/crypter.php` vous permet de créer un utilisateur avec au choix un rôle (Entraîneur/Secrétaire) mais deux identifiants ont déjà été créés : `entraineur/entraineur` et `secretaire/secretaire`
7. Vous pouvez donc accéder à l'application via le fichier index.php (ou en tapant AppWeb/ dans la barre d'adresse depuis votre serveur)
8. Vous avez sur la page d'accueil les formulaires créés (ici il n'y en a pas étant donné que vous venez d'installer l'application...) et vous avez un espace de connexion pour accéder aux différentes bases de données (Effectifs, Matchs, Convocations, Absences à un match...)
9. Vous pouvez donc d'ores-et-déjà ajouter et/ou supprimer des données (l'actualisation des données se fait de manière automatique)

A vous de jouer !


### Versions

La dernière version disponible : **1.0**


### Auteurs

> Les auteurs de ce projet sont **Jérôme URCUN** et **Jack HOGG**, de l'Université d'Angers
>
> Les personnes ayant contribués à ce projet : 
> - Martin DIEGUEZ (Enseignant-chercheur à l'université d'Angers), contribution de ressources bibliographiques


#### Lien du GitHub : https://github.com/Phaeon/App-Web/
