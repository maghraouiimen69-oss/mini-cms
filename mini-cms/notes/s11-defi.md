# Session 11 - Défi

/mes-articles ne montre que mes articles, brouillons compris : oui / non
oui
Un visiteur qui ouvre /mes-articles arrive sur /connexion : oui / non
oui
Le cookie remember_web_ apparaît quand la case est cochée : oui / non
oui
Les deux nouveaux tests passent et php artisan test est vert : oui / non
oui

Pourquoi partir de $request->user()->posts() plutôt que de Post::where('user_id', $request->user()->id) ?
 Parce que la relation posts() connaît déjà la bonne clé étrangère et sert de source unique de vérité, ce qui évite de se tromper de colonne dans un where manuel.

Pourquoi la case remember ne doit-elle pas être dans le tableau passé à Auth::attempt() ?
 Parce que chaque clé de ce tableau devient une condition SQL de recherche de l'utilisateur, donc remember ferait chercher une colonne inexistante et échouer toute connexion : la case se transmet en deuxième argument de attempt().