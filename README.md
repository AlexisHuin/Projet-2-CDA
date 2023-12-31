# Projet réalisé dans le cadre de la formation Concepteur développeur d'apliquation au CCI Campus à Blois
-Durée 8 semaines

## Objectifs 
-Découvrir le MVC, la programmation orienté Objets et PHP
-Utiliser Docker

# Docker 
-La liste des commandes
docker compose up -d

Pour récupéré les librairies/dépendances, clic sur l'extension docker de VSCode, trouver l'image du module PHP pour accéder a son shell

composer i

Permet de récupéré toutes les dépendances

# Convention et nomage

## Pour les tables

- nom de la table avec premier mot en majuscule, exemple : "TypeProduit"
- nom des champs de la table incluent TOUS sans exception le nom de la table dans laquelle ils se trouvent, exemple : "TypeProduitProduit"

## Pour les fichiers dans le site :

- Chaque nom de fichier contenant une classe et le nom de la classe qu'il contient doit commencer par une majuscule. Exemple : "UserController --- `Class UserController`" (Sauf ExceptionHandler)
- Les fichiers dans les dossiers Controllers, Models et View doivent contenir le nom du dossier dans lequel ils se trouvent à la fin. Exemple : "UserController, UserModel, UserView"
- Les fonctions à l'intèrieur des classes doivent avoir chaque première lettre du mot en majuscule. Exemple : `public function ConnectionVerify`

### Pour ce qui est de l'organisation :

- Mise en place d'un tableau blanc/Trello afin qu'une personne travaille sur un fichier.
- Avant chaque commit, assurez-vous de n'avoir modifié que les fichiers qui vous étaient attribués. Si vous en avez modifié d'autres, assurez-vous que vous ête le seul à l'avoir modifié.
- Il sera important de définir l'ensemble des routes en AMONT du développement afin de ne plus toucher à ce fichier.
- De cette façon, on pourra tous s'assigner une paire de Controller, Model et View et configurer l'ensemble de leur fonctionnalités.

### Commentaires :

Installer BetterComments
Editer les paramètres de l'extension selon ceux fournis

// * = Remarques non importante. ex: ``//* Peut-être optimiser cette section``
###
//* = Question. ex: ``//* Eventuelle amélioration`` / ``Compatible Windows et linux server ?``
###
//! = Remarque importante. ex: ``//! Ne pas bouger la balise script dans le header !``
###
//FIX = Problème important. ex: ``//FIX Problèmes de foreign key lors de la suppression``
###
//TODO = Tâche non finie ou prévue. ex: ``//TODO Commenter le code``
###
//NOTICE = Instruction/Référence. ex: ``//NOTICE (lien vers documentation)`` / ``Voir fichier config pour explications``

https://trello.com/b/AyHm3OYP/pt1

Travail effectué avec une équipe de 4 personnes, 
2 pour le dev
2 pour la gestion cachier des charges/soutenances