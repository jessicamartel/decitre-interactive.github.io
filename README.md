# tech.decitre.fr

## Init

`make docker-up`

## Accès à l'environnement de développement

`make docker-bash` pour le lancer
`make install` pour installer les dépendances


# Générer les visuels des articles

À partir de l'environnement de développement lancer `php tools/generate_visual.php`.
La commande va générer les visuels et afficher la sortie HTML à intégrer dans le blog.

Par praticité, on commite les visuels originaux.

Exemple :

```
 php tools/generate_visual.php assets/posts/mise-en-place-borne-magasin/support-tablette.jpg  600
```
