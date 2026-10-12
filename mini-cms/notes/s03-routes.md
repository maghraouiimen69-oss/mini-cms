# Session 03 - Routes, contrôleurs et layout

## Défi

URL produite par route('about') : route('about') → http://localhost:8000/a-propos : une URL absolue composée de APP_URL (dans .env) et du chemin de la route nommée about.

URL produite par route('posts.show', 'routes-et-controleurs') : route('posts.show', 'routes-et-controleurs') → http://localhost:8000/posts/routes-et-controleurs : le paramètre passé remplace le segment {slug} de l'URI.

URL produite par route('posts.archive', 2025) :route('posts.archive', 2025) → http://localhost:8000/posts/archive/2025 : même principe, 2025 remplace {year}.

Pourquoi /posts/archive/abc et /posts/article-inconnu répondent toutes deux 404, et quelle ligne de code en est responsable dans chaque cas ? 

/posts/archive/abc est rejetée par le routeur car ->whereNumber('year') (web.php:34) refuse un year non numérique, tandis que /posts/article-inconnu correspond à une route mais est rejetée par le contrôleur via abort(404) (PostController.php:54) puisque l'article n'existe pas.

Que se passe-t-il si une vue appelle route('posts.show') sans paramètre ?  

route('posts.show') sans paramètre : lève une UrlGenerationException (« Missing required parameter: slug ») et affiche une erreur 500, car Laravel refuse de fabriquer une URL incomplète.