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


https://trello.com/b/AyHm3OYP/pt1
