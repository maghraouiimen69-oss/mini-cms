# Session 08 - Défi

La route posts.tag utilise {tag:slug} : oui / non
oui

La page d'un tag n'affiche ni brouillon ni article d'un autre tag : oui / non
oui

Les tags des cartes sont des liens : oui / non
oui

L'accueil n'affiche que les tags qui ont au moins un article publié : oui / non
oui

Les trois nouveaux tests passent et php artisan test est vert : oui / non
oui


Pourquoi filtrer les tags vides après get() plutôt que d'afficher (0) ?
 On filtre après get() pour cacher les tags sans article publié, car afficher « (0) » n'apporterait rien au lecteur.

Combien de requêtes ajoute la liste des tags populaires, et pourquoi pas une par tag ?
La liste ajoute une seule requête SQL, car withCount compte les articles de tous les tags dans le même SELECT au lieu de faire une requête par tag.