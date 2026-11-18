# Session 10 - Robustesse

TagAdminTest contient 5 tests verts : oui / non
oui

/posts/categorie/inconnue affiche Catégorie introuvable avec le statut 404 : oui / non
oui

php artisan test est vert : oui / non
oui

1. Pourquoi le message de messages() l'emporte-t-il sur celui de lang/fr/validation.php ?
Laravel cherche d'abord un message écrit pour cette règle de ce champ précis, dans la Form Request ; il ne lit le fichier de langue que si la Form Request n'en donne pas. Le message le plus précis l'emporte donc sur le message général de la règle.

2. Pourquoi phpunit.xml fixe-t-il APP_LOCALE ?
Les tests comparent maintenant des textes français. Les valeurs de phpunit.xml s'appliquent avant celles de .env : les tests donnent le même résultat sur chaque poste et sur un clone propre, quelle que soit la locale de .env.

3. Pourquoi CategoryController n'a-t-il besoin d'aucun try/catch ?
Rien dans ses actions ne peut échouer d'une manière qu'il saurait réparer : la Form Request renvoie les données invalides au formulaire avant l'appel, la liaison de modèle répond 404 pour une catégorie inconnue, le middleware répond 503 en lecture seule, et le gestionnaire d'exceptions transforme ces erreurs en pages. Un try/catch ne ferait que cacher ces réponses.