# Session 05 - Défi : articles récents sur l'accueil

latestPosts contient au plus 3 articles : oui / non
oui

Seuls les articles publiés sont transmis à la vue : oui / non
oui

home.blade.php utilise x-post-card et @forelse : oui / non
 oui

Le nouveau test passe et php artisan test est vert : oui / non
oui

Pourquoi get() et pas paginate(3) sur la page d'accueil ?
parce que l'accueil affiche un simple bloc fixe de 3 articles récents, sans navigation entre pages : paginate() sert à découper une longue liste en pages numérotées avec liens, ce qui n'a aucun sens ici, alors que take(3)->get() suffit.