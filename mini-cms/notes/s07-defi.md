# Session 07 - Défi : articles de la même catégorie

La section « Dans la même catégorie » apparaît sous un article publié qui a une catégorie : oui / non
oui

L'article affiché n'apparaît pas dans sa propre section : oui / non
oui

Un brouillon de la même catégorie n'apparaît pas : oui / non
oui

La page s'ouvre sans LazyLoadingViolationException : oui / non
oui

Le nouveau test passe et php artisan test est vert : oui / non
oui

Combien de requêtes SQL charge la section, et pourquoi pas une par carte ?
 La liste est chargée une fois dans le contrôleur, puis la vue boucle sur la collection déjà en mémoire : donc pas une requête par carte.