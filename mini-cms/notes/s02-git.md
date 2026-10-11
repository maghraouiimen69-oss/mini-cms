# Séance 02 - Git et GitHub

Réponses rédigées avec mes propres mots, puis comparées au corrigé de la page.

## 1. Index et commit

Réaction : `git add` (du répertoire de travail vers l'index/zone de transit), `git commit` (de l'index vers le dépôt local), `git push` (du dépôt local vers GitHub). ## 2. Branche et tag

En réponse : une branche avance à chaque commit, tandis qu'un tag reste figé sur un commit précis (par exemple, `lab-01` indique toujours la fin de la séance 01).

## 3. Le fichier d'environnement

La réponse est que `.env` contient `APP_KEY` et les configurations spécifiques au déploiement (ainsi que les secrets de production). ## 4. Le dossier `vendor` (généré après copie de `.env.example` et exécution de `php artisan key:generate`). ## 5. Gestionnaire d'identifiants pour Git

Réponse : Dans le système de gestion des identités Windows (entrer `git: https://github.com`). Il est lié au poste de travail, car la personne suivante pourrait utiliser votre nom ; il est stocké sur l'ordinateur de l'employé.

## 6. Depuis `lab-01`

Nombre de commits depuis `lab-01` : Cinq avant le commit le plus récent.

Les cinq fichiers => `notes/s02-git.md`, `routes/web.php`, `resources/views/a-propos.blade.php`, `screenshots/s02-a-propos.png`, `README.md` ont été modifiés depuis `lab-01`.

