# S01 — Cycle de vie d'une requête (Laravel 13)

## Fichiers traversés par une requête, dans l'ordre

1. `public/index.php` — seul point d'entrée web ; charge l'autoloader Composer (`vendor/autoload.php`).
2. `bootstrap/app.php` — crée l'application, déclare les fichiers de routes, le middleware et la gestion des exceptions.
3. `routes/web.php` — le routeur cherche une route correspondant à la méthode HTTP et à l'URL (sinon 404).
4. Closure (S01) ou contrôleur (`app/Http/Controllers/…`, S03) — exécute le code.
5. Vue Blade (optionnelle, `resources/views/*.blade.php`) — compilée en HTML.
6. Réponse HTTP — renvoyée au navigateur.

Moyen mnémotechnique : « la requête entre par l'**index**, chausse ses **boots**, suit la **route**, passe chez le **c**ontrôleur, admire la **v**ue, repart avec une **r**éponse » (I-B-R-C-V-R).

## Comparaison avec le schéma « Concepts clés »

Ordre identique au schéma du cours. Trois points d'attention vérifiés :

- `vendor/autoload.php` n'est pas une étape séparée : il est chargé *à l'intérieur* de `public/index.php`.
- `routes/web.php` vient *après* `bootstrap/app.php`, car c'est bootstrap qui déclare quels fichiers de routes l'application lit.
- La vue est optionnelle : une closure peut renvoyer une simple chaîne (`/bonjour`), qui devient le corps de la réponse.

## Pourquoi `app/Http/Kernel.php` et `routes/api.php` n'existent pas

Depuis Laravel 11 (ici Laravel 13), le squelette du projet est allégé : le middleware et les exceptions se configurent dans `bootstrap/app.php`, et `routes/api.php` n'apparaît qu'après `php artisan install:api`. Les tutoriels antérieurs à Laravel 11 (Kernel.php, RouteServiceProvider, Breeze) ne s'appliquent pas.

## MVC dans ce projet

- Modèle : `app/Models` (S05) — données et règles métier.
- Vue : `resources/views/*.blade.php` — présentation (ex. `bienvenue.blade.php`).
- Contrôleur : `app/Http/Controllers` (S03) ; en S01, ce rôle est joué par les closures de `routes/web.php`.

## D4 — Chemin d'une requête vers `/heure`, dans l'ordre

Le navigateur envoie `GET /heure`. La requête entre par **`public/index.php`**, seul point d'entrée web, qui charge l'autoloader Composer (`vendor/autoload.php`) ; puis **`bootstrap/app.php`** crée l'application et déclare les fichiers de routes, dont **`routes/web.php`**. Le routeur y trouve la route `/heure` et exécute sa closure ; celle-ci renvoie la vue **`resources/views/heure.blade.php`** (via `view('heure', ['maintenant' => now()])`), compilée en HTML — heure au format `H:i` et date au format `d/m/Y`, dans le fuseau `Africa/Tunis` défini dans `config/app.php` — et Laravel renvoie cette réponse au navigateur.

Comparaison avec le corrigé : même ordre et mêmes fichiers (`public/index.php` → `bootstrap/app.php` → `routes/web.php` → closure → `resources/views/heure.blade.php` → réponse). Notre description nomme en plus l'autoloader et la donnée passée à la vue, sans contredire le corrigé.

## Vérifications effectuées

- `php -v` → PHP 8.5.0 ; `php artisan --version` → Laravel Framework 13.x.
- `php artisan about` → Database : sqlite.
- `php artisan route:list` → `/`, `up`, `bonjour`, `bonjour-court`, `bienvenue`, `version`, `heure`.
- `/heure` affiche l'heure (`H:i`) et la date (`d/m/Y`) via la vue `heure.blade.php`, fuseau `Africa/Tunis` défini dans `config/app.php`.

## Étape 8 — Quiz Git (mes réponses, écrites avant de regarder le corrigé)

1. **Du répertoire de travail à l'index, puis de l'index au dépôt local**
   - `git add <fichier>` fait passer le fichier du répertoire de travail à l'index (zone de préparation).
   - `git commit` enregistre le contenu de l'index dans le dépôt local, sous forme d'un nouveau commit.

2. **Différence entre une branche et un tag**
   - Une branche est un pointeur **mobile** : elle avance automatiquement à chaque nouveau commit créé sur elle (c'est une ligne de travail qui continue).
   - Un tag est un pointeur **fixe et immuable** vers un commit précis (un repère de version, ex. `lab-01`) ; il ne bouge plus, même si d'autres commits sont créés ensuite.

3. **Pourquoi `.env` ne doit jamais être poussé, et comment un autre développeur obtient le sien**
   - `.env` contient des secrets (`APP_KEY`, mots de passe BDD, clés API…) et des réglages propres à une machine : le pousser exposerait ces secrets à toute personne pouvant lire le dépôt, et imposerait ma configuration aux autres.
   - Un autre développeur crée son propre `.env` en copiant le modèle versionné : `cp .env.example .env`, puis il remplit ses valeurs à lui. `.env.example` est versionné car il ne contient aucun secret, seulement la liste des variables attendues ; `.gitignore` exclut `.env`.

4. **Pourquoi `vendor/` n'est pas versionné, et comment le reconstruire à l'identique**
   - `vendor/` contient les dépendances tierces téléchargées par Composer : c'est lourd, régénérable, et parfois spécifique à une plateforme ; le versionner alourdirait le dépôt et créerait des conflits inutiles.
   - On le reconstruit à l'identique avec `composer install`, qui s'appuie sur **`composer.lock`** : ce fichier (lui, versionné) fige la version exacte de chaque dépendance.

5. **Où Git Credential Manager range le jeton GitHub, et quand le supprimer**
   - Sous Windows, GCM range le jeton dans le **Gestionnaire d'identification Windows** (Panneau de configuration → Comptes d'utilisateurs → Gestionnaire d'identification → « Informations d'identification Windows », entrée de type `git:https://github.com`), c'est-à-dire dans le coffre Windows lié à la session.
   - Il faut le supprimer en fin de séance sur un **poste partagé** (PC de laboratoire) : sinon, la personne suivante qui s'assoit peut pousser sur GitHub en tant que moi, sans rien saisir.
